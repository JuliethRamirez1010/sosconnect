@extends('layout')

@section('content')
<x-auth-compact-shell title="Restablecer contraseña" subtitle="Crea una nueva contraseña para SOS Connect">
    <form method="POST" action="{{ route('password.recovery.update') }}" class="space-y-3">
        @csrf
        <label for="password" class="block text-sm font-semibold text-slate-700">Nueva contraseña</label>
        <input id="password" class="w-full rounded-xl border border-slate-200 p-3" type="password" name="password" placeholder="Nueva contraseña" autocomplete="new-password" required>
        <label for="password_confirmation" class="block text-sm font-semibold text-slate-700">Confirmar contraseña</label>
        <input id="password_confirmation" class="w-full rounded-xl border border-slate-200 p-3" type="password" name="password_confirmation" placeholder="Confirmar contraseña" autocomplete="new-password" required>
        <button class="w-full rounded-xl bg-[#1140A6] p-3 font-semibold text-white">Guardar</button>
    </form>
</x-auth-compact-shell>
@endsection
