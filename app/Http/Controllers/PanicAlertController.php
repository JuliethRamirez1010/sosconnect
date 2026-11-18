<?php

namespace App\Http\Controllers;

use App\Models\PanicAlert;
use App\Models\Patient;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PanicAlertController extends Controller
{
    public function receive(Request $request): JsonResponse
    {
        $expectedToken = (string) config('services.esp32.token');
        $providedToken = (string) $request->header('X-Device-Token');

        abort_if($expectedToken === '' || ! hash_equals($expectedToken, $providedToken), 401, 'Dispositivo no autorizado.');

        $data = $request->validate([
            'device_id' => ['required', 'string', 'max:80'],
            'message' => ['nullable', 'string', 'max:255'],
        ]);
        $deviceId = $data['device_id'];
        $patient = Patient::query()->where('device_id', $deviceId)->where('is_active', true)->first();

        $alert = PanicAlert::create([
            'device_id' => $deviceId,
            'patient_id' => $patient?->id,
            'message' => $data['message'] ?? 'Botón de pánico presionado',
            'status' => 'pending',
            'triggered_at' => now(),
        ]);

        return response()->json(['ok' => true, 'id' => $alert->id, 'patient' => $patient?->name], 201);
    }

    public function latest(): JsonResponse
    {
        return response()->json(PanicAlert::query()->with(['patient.assignedNurse', 'attendedBy'])->latest('triggered_at')->limit(100)->get()->map(fn (PanicAlert $alert) => [
            'id' => $alert->id,
            'device_id' => $alert->device_id,
            'message' => $alert->message,
            'status' => $alert->status,
            'patient_name' => $alert->patient?->name ?? 'Pulsador sin paciente asignado',
            'patient_age' => $alert->patient?->age,
            'patient_document' => $alert->patient?->document_id,
            'blood_type' => $alert->patient?->blood_type,
            'conditions' => $alert->patient?->conditions ?? array_filter([$alert->patient?->diagnosis]),
            'medications' => $alert->patient?->medications ?? [],
            'diagnosis' => $alert->patient?->diagnosis,
            'room' => $alert->patient?->room,
            'bed' => $alert->patient?->bed,
            'admitted_at' => $alert->patient?->admitted_at?->format('d/m/Y'),
            'assigned_nurse' => $alert->patient?->assignedNurse?->name,
            'emergency_contact_name' => $alert->patient?->emergency_contact_name,
            'emergency_contact_phone' => $alert->patient?->emergency_contact_phone,
            'attended_by' => $alert->attendedBy?->name,
            'report' => $alert->report,
            'severity' => $alert->severity,
            'symptoms' => $alert->symptoms ?? [],
            'triggered_at' => $alert->triggered_at->toIso8601String(),
            'display_time' => $alert->triggered_at->format('d/m/Y H:i:s'),
            'time' => $alert->triggered_at->format('H:i'),
            'attended_time' => $alert->attended_at?->format('H:i'),
        ]))->header('Cache-Control', 'private, no-store');
    }

    public function report(PanicAlert $panicAlert): Response
    {
        abort_unless(filled($panicAlert->report), 404, 'Esta alerta aún no tiene un reporte guardado.');

        return response()->view('alerts.report', [
            'alert' => $panicAlert->load(['patient', 'attendedBy']),
        ])->header('Cache-Control', 'private, no-store');
    }

    public function attend(PanicAlert $panicAlert, Request $request): JsonResponse
    {
        if ($panicAlert->status === 'completed') {
            return response()->json(['message' => 'Esta alerta ya fue cerrada.'], 409);
        }

        $panicAlert->forceFill([
            'status' => 'attending',
            'attended_by' => $request->user()->id,
            'attended_at' => $panicAlert->attended_at ?? now(),
        ])->save();

        return response()->json(['ok' => true, 'status' => 'attending', 'attended_by' => $request->user()->name]);
    }

    public function complete(PanicAlert $panicAlert, Request $request): JsonResponse
    {
        $data = $request->validate([
            'report' => ['required', 'string', 'max:5000'],
            'severity' => ['required', 'in:stable,moderate,critical'],
            'symptoms' => ['nullable', 'array', 'max:30'],
            'symptoms.*' => ['string', 'max:255'],
        ]);

        if ($panicAlert->status !== 'attending') {
            return response()->json(['message' => 'Primero marca la alerta como atendida.'], 409);
        }

        $panicAlert->forceFill([
            'status' => 'completed',
            'report' => $data['report'],
            'severity' => $data['severity'],
            'symptoms' => array_values($data['symptoms'] ?? []),
            'resolved_at' => now(),
        ])->save();

        return response()->json(['ok' => true, 'status' => 'completed']);
    }
}
