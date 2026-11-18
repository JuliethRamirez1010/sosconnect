@extends('layout')

@section('content')
<x-auth-compact-shell title="Código de recuperación" subtitle="Verifica tu cuenta de SOS Connect">
    <p class="text-sm text-slate-500">El código vence en 10 minutos y permite hasta cinco intentos.</p>
    <form method="POST" action="{{ route('recovery.code.verify') }}" class="mt-5 space-y-3">
        @csrf
        <label for="email" class="block text-sm font-semibold text-slate-700">Correo electrónico</label>
        <input id="email" class="w-full rounded-xl border border-slate-200 p-3" type="email" name="email" value="{{ old('email', $email ?? '') }}" placeholder="Correo electrónico" autocomplete="email" required>
        <label for="code" class="block text-sm font-semibold text-slate-700">Código de seis dígitos</label>
        <input id="code" class="w-full rounded-xl border border-slate-200 p-3" name="code" inputmode="numeric" pattern="[0-9]{6}" placeholder="Código de seis dígitos" maxlength="6" required>
        <button class="w-full rounded-xl bg-[#1140A6] p-3 font-semibold text-white">Verificar código</button>
    </form>
    <p class="mt-5 text-center text-sm"><a class="font-medium text-[#1140A6] hover:underline" href="{{ route('password.request') }}">Volver a recuperación</a></p>
</x-auth-compact-shell>
@endsection
