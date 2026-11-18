<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\RecoveryDocumentMail;
use App\Models\User;
use App\Services\RecoveryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

class ForgotPasswordController extends Controller
{
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    public function send(Request $request): RedirectResponse
    {
        $request->validate(['email' => ['required', 'email']]);
        try {
            $status = DB::transaction(fn () => Password::sendResetLink($request->only('email')));
        } catch (TransportExceptionInterface $exception) {
            return $this->mailUnavailable($exception, $request);
        }

        return back()->with('status', __($status));
    }

    public function requestCode(Request $request, RecoveryService $service): RedirectResponse
    {
        $data = $request->validate(['email' => ['required', 'email']]);
        $user = User::where('email', $data['email'])->where('is_active', true)->first();

        if ($user) {
            try {
                DB::transaction(function () use ($user, $service): void {
                    $code = $service->createCode($user);
                    Mail::raw(
                        "Tu código de recuperación es: {$code}. Expira en 10 minutos y permite hasta cinco intentos.",
                        fn ($message) => $message->to($user->email)->subject('Código de recuperación de cuenta'),
                    );
                });
            } catch (TransportExceptionInterface $exception) {
                return $this->mailUnavailable($exception, $request);
            }
        }

        $request->session()->put('recovery_email', $data['email']);

        return back()->with('status', 'Si la cuenta existe, se envió un código de recuperación.');
    }

    public function requestDocument(Request $request, RecoveryService $service): RedirectResponse
    {
        $data = $request->validate(['email' => ['required', 'email']]);
        $user = User::where('email', $data['email'])->where('is_active', true)->first();

        if ($user) {
            try {
                DB::transaction(function () use ($user, $service): void {
                    $contents = $service->createRecoveryDocument($user);
                    Mail::to($user->email)->send(new RecoveryDocumentMail($contents));
                });
            } catch (TransportExceptionInterface $exception) {
                return $this->mailUnavailable($exception, $request);
            }
        }

        $request->session()->put('recovery_email', $data['email']);

        return redirect()->route('recovery.document.form')->with('status', 'Si la cuenta existe, enviamos el archivo de recuperación a su correo.');
    }

    private function mailUnavailable(TransportExceptionInterface $exception, Request $request): RedirectResponse
    {
        report($exception);

        return back()->withErrors([
            'email' => 'No pudimos enviar el correo de recuperación. Comprueba la conexión a Internet del servidor e inténtalo de nuevo. Si el problema continúa, contacta al administrador.',
        ])->withInput($request->only('email'));
    }

    public function codeForm(): View
    {
        return view('auth.recovery-code', ['email' => session('recovery_email', '')]);
    }

    public function verifyCode(Request $request, RecoveryService $service): RedirectResponse
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'code' => ['required', 'digits:6'],
        ]);
        $user = User::where('email', $data['email'])->where('is_active', true)->first();

        if (! $user || ! $service->verifyCode($user, $data['code'])) {
            return back()->withErrors(['code' => 'Código inválido, expirado o agotado.'])->withInput($request->only('email'));
        }

        $request->session()->regenerate();
        $request->session()->forget('recovery_email');
        $request->session()->put('recovery_user_id', $user->id);

        return redirect()->route('password.recovery.form');
    }

    public function documentForm(): View
    {
        return view('auth.recovery-document');
    }

    public function verifyDocument(Request $request, RecoveryService $service): RedirectResponse
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'document' => ['required', 'file', 'mimes:txt', 'max:1024'],
        ]);
        $user = $service->verifyDocument($data['email'], file_get_contents($data['document']->getRealPath()));

        if (! $user) {
            return back()->withErrors(['document' => 'El archivo no es válido, ya fue usado o no corresponde a esta cuenta.'])->withInput($request->only('email'));
        }

        $request->session()->regenerate();
        $request->session()->put('recovery_user_id', $user->id);

        return redirect()->route('password.recovery.form');
    }
}
