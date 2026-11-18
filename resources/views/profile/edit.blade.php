@extends('layout')

@section('content')
<style>
    .account-profile { max-width:760px; margin:24px auto; background:#fff; border:1px solid #dce5ee; border-radius:18px; overflow:hidden; }
    .account-profile-header { padding:26px 30px; background:#123047; color:#fff; }
    .account-profile-header h1 { margin:0 0 8px; font-size:26px; font-weight:700; }
    .account-profile-header p { margin:0; color:#d2e6f0; line-height:1.5; }
    .account-profile-form { padding:30px; }
    .account-profile-form label { display:block; margin-bottom:8px; color:#304d63; font-weight:600; }
    .account-profile-field { margin-bottom:22px; }
    .account-profile-form input { display:block; box-sizing:border-box; width:100%; padding:13px 15px; border:1px solid #cbd5e1; border-radius:10px; background:#fff; color:#0f172a; font:inherit; }
    .account-profile-form input:focus { outline:3px solid #ccfbf1; border-color:#0f766e; }
    .account-profile-help { margin:8px 0 0; color:#64748b; font-size:14px; line-height:1.5; }
    .account-profile-role { margin:0 0 26px; padding:14px 16px; border-radius:10px; background:#f1f7fa; color:#304d63; }
    .account-profile-actions { display:flex; flex-wrap:wrap; align-items:center; justify-content:space-between; gap:16px; border-top:1px solid #e2e8f0; padding-top:22px; }
    .account-profile-actions button { border:0; padding:13px 22px; background:#0f766e; border-radius:10px; color:#fff; font:inherit; font-weight:600; cursor:pointer; }
    .account-profile-actions a { color:#0f766e; text-decoration:underline; }
    @media(max-width:600px) { .account-profile-header,.account-profile-form { padding:22px; } }
</style>

<section class="account-profile" aria-labelledby="profile-heading">
    <header class="account-profile-header">
        <h1 id="profile-heading">Mi perfil</h1>
        <p>Actualiza los datos de tu cuenta como personal de salud.</p>
    </header>

    <form class="account-profile-form" method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PATCH')

        <div class="account-profile-field">
            <label for="profile-name">Nombre completo</label>
            <input id="profile-name" name="name" value="{{ old('name', $user->name) }}" required maxlength="255" autocomplete="name" aria-describedby="profile-name-help">
            <p class="account-profile-help" id="profile-name-help">Este nombre identifica quién atiende y registra cada llamada.</p>
        </div>

        <div class="account-profile-field">
            <label for="profile-email">Correo electrónico</label>
            <input id="profile-email" type="email" name="email" value="{{ old('email', $user->email) }}" required maxlength="255" autocomplete="email" aria-describedby="profile-email-help">
            <p class="account-profile-help" id="profile-email-help">Usa este correo para iniciar sesión y recuperar tu contraseña. Si lo cambias, ingresa con el nuevo correo la próxima vez.</p>
        </div>

        <p class="account-profile-role">Rol de tu cuenta: <strong>{{ ['nurse' => 'Enfermería', 'doctor' => 'Médico', 'admin' => 'Administrador'][$user->role] ?? $user->role }}</strong></p>

        <div class="account-profile-actions">
            <a href="{{ route('security.edit') }}">Cambiar contraseña</a>
            <button type="submit">Guardar cambios</button>
        </div>
    </form>
</section>
@endsection
