<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class PatientController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Patient::query()
            ->with('assignedNurse:id,name,role')
            ->where('is_active', true)
            ->orderBy('room')
            ->orderBy('bed')
            ->get());
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate($this->rules());
        $this->ensureBedIsAvailable($data['room'], $data['bed']);
        $patient = Patient::create($this->normalise($data));

        return response()->json(['ok' => true, 'patient' => $patient->load('assignedNurse:id,name,role')], 201);
    }

    public function update(Request $request, Patient $patient): JsonResponse
    {
        $data = $request->validate($this->rules($patient));
        $this->ensureBedIsAvailable($data['room'], $data['bed'], $patient);
        $patient->update($this->normalise($data));

        return response()->json(['ok' => true, 'patient' => $patient->fresh()->load('assignedNurse:id,name,role')]);
    }

    private function rules(?Patient $patient = null): array
    {
        $document = Rule::unique('patients', 'document_id');
        $device = Rule::unique('patients', 'device_id');
        if ($patient) {
            $document->ignore($patient->id);
            $device->ignore($patient->id);
        }

        return [
            'name' => ['required', 'string', 'max:255'],
            'document_id' => ['nullable', 'string', 'max:80', $document],
            'age' => ['nullable', 'integer', 'between:0,120'],
            'blood_type' => ['nullable', 'string', 'max:8'],
            'room' => ['required', 'string', 'max:40'],
            'bed' => ['required', 'string', 'max:20'],
            'diagnosis' => ['nullable', 'string', 'max:255'],
            'conditions' => ['nullable', 'array', 'max:20'],
            'conditions.*' => ['required', 'string', 'max:255'],
            'medications' => ['nullable', 'array', 'max:30'],
            'medications.*.name' => ['required', 'string', 'max:120'],
            'medications.*.dose' => ['nullable', 'string', 'max:80'],
            'medications.*.schedule' => ['nullable', 'string', 'max:120'],
            'admitted_at' => ['nullable', 'date'],
            'assigned_nurse_id' => ['nullable', 'integer', 'exists:users,id'],
            'emergency_contact_name' => ['nullable', 'string', 'max:255'],
            'emergency_contact_phone' => ['nullable', 'string', 'max:40'],
            'device_id' => ['required', 'string', 'max:80', $device],
        ];
    }

    private function ensureBedIsAvailable(string $room, string $bed, ?Patient $patient = null): void
    {
        $occupied = Patient::query()
            ->where('room', $room)
            ->where('bed', $bed)
            ->when($patient, fn ($query) => $query->where('id', '!=', $patient->id))
            ->exists();

        if ($occupied) {
            throw ValidationException::withMessages([
                'bed' => 'Esa habitación y cama ya están asignadas a otro paciente.',
            ]);
        }
    }

    private function normalise(array $data): array
    {
        $data['conditions'] = array_values(array_filter($data['conditions'] ?? [], fn ($value) => trim($value) !== ''));
        $data['medications'] = array_values(array_filter($data['medications'] ?? [], fn ($medication) => trim($medication['name'] ?? '') !== ''));
        $data['diagnosis'] = ($data['diagnosis'] ?? null) ?: ($data['conditions'][0] ?? null);

        return $data;
    }
}
