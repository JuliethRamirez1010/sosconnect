<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

class RecoveryService
{
    public function createCode(User $user): string
    {
        $code = (string) random_int(100000, 999999);
        $user->forceFill([
            'recovery_code_hash' => hash('sha256', $code),
            'recovery_code_expires_at' => now()->addMinutes(10),
            'recovery_code_attempts' => 0,
        ])->save();
        return $code;
    }

    public function verifyCode(User $user, string $code): bool
    {
        if (!$user->recovery_code_hash || !$user->recovery_code_expires_at || now()->greaterThan($user->recovery_code_expires_at)) return false;
        if ($user->recovery_code_attempts >= 5) return false;
        $user->increment('recovery_code_attempts');
        if (!hash_equals($user->recovery_code_hash, hash('sha256', $code))) return false;
        $user->forceFill(['recovery_code_hash'=>null,'recovery_code_expires_at'=>null,'recovery_code_attempts'=>0])->save();
        return true;
    }

    public function createDocumentSecret(User $user): string
    {
        $secret = Str::upper(Str::random(16));
        $user->forceFill(['recovery_document_secret'=>Crypt::encryptString($secret)])->save();
        return $secret;
    }

    public function createRecoveryDocument(User $user): string
    {
        $secret = $this->createDocumentSecret($user);
        $payload = json_encode([
            'purpose' => 'password_recovery',
            'version' => 1,
            'user_id' => $user->getKey(),
            'email' => strtolower($user->email),
            'secret' => $secret,
        ], JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE);

        return "BOTON DE PANICO - ARCHIVO DE RECUPERACION\n"
            . "Guarda este archivo en un lugar seguro. No lo edites.\n"
            . 'TOKEN_CIFRADO:'.Crypt::encryptString($payload)."\n";
    }

    public function verifyDocument(string $email, string $contents): ?User
    {
        $user = User::where('email', $email)->where('is_active', true)->first();
        if (!$user || !$user->recovery_document_secret) return null;
        try { $expected = Crypt::decryptString($user->recovery_document_secret); }
        catch (\Throwable) { return null; }
        if (!preg_match('/^TOKEN_CIFRADO:([A-Za-z0-9+\/=]+)$/m', trim($contents), $matches)) return null;
        try {
            $payload = json_decode(Crypt::decryptString($matches[1]), true, flags: JSON_THROW_ON_ERROR);
        } catch (\Throwable) {
            return null;
        }

        if (($payload['purpose'] ?? null) !== 'password_recovery'
            || ($payload['version'] ?? null) !== 1
            || (int) ($payload['user_id'] ?? 0) !== (int) $user->getKey()
            || strtolower((string) ($payload['email'] ?? '')) !== strtolower($user->email)
            || !isset($payload['secret'])
            || !hash_equals($expected, (string) $payload['secret'])) return null;

        $user->forceFill(['recovery_document_secret' => null])->save();

        return $user;
    }
}
