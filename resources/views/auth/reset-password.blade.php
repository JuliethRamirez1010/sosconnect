@extends('layout')

@section('content')
<x-auth-compact-shell title="Nueva contraseña" subtitle="Actualiza la contraseña de tu cuenta SOS Connect">
    <form method="POST" action="{{ route('password.update') }}" class="space-y-3">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <label for="email" class="block text-sm font-semibold text-slate-700">Correo electrónico</label>
        <input id="email" class="w-full rounded-xl border border-slate-200 p-3" type="email" name="email" value="{{ $email }}" autocomplete="email" required>
        <label for="password" class="block text-sm font-semibold text-slate-700">Nueva contraseña</label>
        <input id="password" class="w-full rounded-xl border border-slate-200 p-3" type="password" name="password" placeholder="Nueva contraseña" autocomplete="new-password" required>
        <label for="password_confirmation" class="block text-sm font-semibold text-slate-700">Confirmar contraseña</label>
        <input id="password_confirmation" class="w-full rounded-xl border border-slate-200 p-3" type="password" name="password_confirmation" placeholder="Confirmar contraseña" autocomplete="new-password" required>
        <button class="w-full rounded-xl bg-[#1140A6] p-3 font-semibold text-white">Restablecer</button>
    </form>
</x-auth-compact-shell>
@endsection
