<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ResetPasswordController extends Controller
{
    public function create(Request $request, string $token): View
    {
        return view('auth.reset-password', [
            'token' => $token,
            'email' => $request->query('email', ''),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

        $status = Password::reset($data, function (User $user, string $password): void {
            $user->forceFill([
                'password' => Hash::make($password),
                'remember_token' => Str::random(60),
                'recovery_code_hash' => null,
                'recovery_code_expires_at' => null,
                'recovery_code_attempts' => 0,
                'recovery_document_secret' => null,
            ])->save();
        });

        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('success', 'Contraseña restablecida correctamente.');
        }

        return back()->withErrors(['email' => __($status)])->withInput($request->only('email'));
    }

    public function recoveryForm(Request $request): View
    {
        abort_unless($request->session()->has('recovery_user_id'), 403);

        return view('auth.recovery-reset');
    }

    public function recoveryUpdate(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'password' => ['required', 'min:8', 'confirmed'],
        ]);
        $user = User::findOrFail($request->session()->pull('recovery_user_id'));

        $user->forceFill([
            'password' => Hash::make($data['password']),
            'remember_token' => Str::random(60),
            'recovery_code_hash' => null,
            'recovery_code_expires_at' => null,
            'recovery_code_attempts' => 0,
            'recovery_document_secret' => null,
        ])->save();

        DB::table(config('auth.passwords.users.table'))
            ->where('email', $user->email)
            ->delete();

        $request->session()->regenerate();

        return redirect()->route('login')->with('success', 'Contraseña restablecida correctamente.');
    }
}
