<?php

use App\Mail\RecoveryDocumentMail;
use App\Models\User;
use App\Services\RecoveryService;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Mailer\Exception\TransportException;

uses(RefreshDatabase::class);

it('returns to recovery and preserves previous credentials when mail delivery fails', function (string $method) {
    $user = User::factory()->create();
    $service = app(RecoveryService::class);
    $service->createCode($user);
    $service->createRecoveryDocument($user);
    $before = $user->fresh();
    $exception = new TransportException('SMTP connection unavailable');

    if ($method === 'password.email') {
        Notification::shouldReceive('send')->once()->andThrow($exception);
    } elseif ($method === 'recovery.code.request') {
        Mail::shouldReceive('raw')->once()->andThrow($exception);
    } else {
        Mail::shouldReceive('to')->once()->with($user->email)->andReturnSelf();
        Mail::shouldReceive('send')->once()->andThrow($exception);
    }

    $this->from(route('password.request'))
        ->post(route($method), ['email' => $user->email])
        ->assertRedirect(route('password.request'))
        ->assertSessionHasErrors('email')
        ->assertSessionHasInput('email', $user->email)
        ->assertSessionMissing('status');

    $after = $user->fresh();
    expect($after->recovery_code_hash)->toBe($before->recovery_code_hash);
    expect($after->recovery_document_secret)->toBe($before->recovery_document_secret);
    expect(DB::table('password_reset_tokens')->where('email', $user->email)->exists())->toBeFalse();
})->with(['password.email', 'recovery.code.request', 'recovery.document.request']);

it('shows all three password recovery methods', function () {
    $this->get(route('password.request'))
        ->assertOk()
        ->assertSee('Enlace por correo')
        ->assertSee('Código de verificación')
        ->assertSee('Archivo de recuperación');
});

it('sends the traditional password reset link to a registered account', function () {
    Notification::fake();
    $user = User::factory()->create();

    $this->post(route('password.email'), ['email' => $user->email])
        ->assertSessionHas('status');

    Notification::assertSentTo($user, ResetPassword::class);
});

it('accepts a valid recovery code once', function () {
    $user = User::factory()->create();
    $service = app(RecoveryService::class);
    $code = $service->createCode($user);

    expect($service->verifyCode($user->fresh(), $code))->toBeTrue();
    expect($user->fresh()->recovery_code_hash)->toBeNull();
    expect($service->verifyCode($user->fresh(), $code))->toBeFalse();
});

it('limits recovery codes to five attempts and expires them after ten minutes', function () {
    $user = User::factory()->create();
    $service = app(RecoveryService::class);
    $service->createCode($user);

    for ($attempt = 0; $attempt < 5; $attempt++) {
        expect($service->verifyCode($user->fresh(), '000000'))->toBeFalse();
    }

    expect($service->verifyCode($user->fresh(), '000000'))->toBeFalse();
    expect($user->fresh()->recovery_code_attempts)->toBe(5);

    $service->createCode($user->fresh());
    $this->travel(11)->minutes();
    expect($service->verifyCode($user->fresh(), '000000'))->toBeFalse();
});

it('emails a recovery text file and accepts it to reset the password', function () {
    Mail::fake();
    $user = User::factory()->create(['email' => 'recover@example.com']);
    $service = app(RecoveryService::class);

    $this->actingAs($user)
        ->post(route('security.recovery-document'))
        ->assertRedirect();

    $fileContents = null;
    Mail::assertSent(RecoveryDocumentMail::class, function (RecoveryDocumentMail $mail) use ($user, &$fileContents) {
        expect($mail->hasTo('recover@example.com'))->toBeTrue();
        expect($mail->contents)->toContain('TOKEN_CIFRADO:');
        expect($mail->contents)->not->toContain(Crypt::decryptString($user->fresh()->recovery_document_secret));
        $mail->assertHasAttachedData($mail->contents, 'recuperacion-cuenta.txt', ['mime' => 'text/plain']);
        $fileContents = $mail->contents;

        return true;
    });

    auth()->logout();
    $this->post(route('recovery.document.verify'), [
        'email' => $user->email,
        'document' => UploadedFile::fake()->createWithContent('recuperacion-cuenta.txt', $fileContents),
    ])->assertRedirect(route('password.recovery.form'));

    $this->post(route('password.recovery.update'), [
        'password' => 'NuevaClave123!',
        'password_confirmation' => 'NuevaClave123!',
    ])->assertRedirect(route('login'));

    expect(Hash::check('NuevaClave123!', $user->fresh()->password))->toBeTrue();
});
