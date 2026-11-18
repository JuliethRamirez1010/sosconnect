@extends('layout')

@section('content')
<x-auth-shell title="Iniciar sesión" subtitle="Ingresa tus credenciales para continuar">
    <form method="POST" action="{{ url('/login') }}" class="space-y-5">
        @csrf
        <div>
            <label for="email" class="mb-1.5 block text-sm font-semibold text-slate-700">Correo electrónico</label>
            <input id="email" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-[#1140A6] focus:outline-none focus:ring-2 focus:ring-[#1140A6]/30" type="email" name="email" value="{{ old('email') }}" placeholder="correo@hospital.com" autocomplete="username" required autofocus>
        </div>
        <div>
            <label for="login-password" class="mb-1.5 block text-sm font-semibold text-slate-700">Contraseña</label>
            <input id="login-password" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-[#1140A6] focus:outline-none focus:ring-2 focus:ring-[#1140A6]/30" type="password" name="password" placeholder="Tu contraseña" autocomplete="current-password" required>
        </div>
        <label for="show-login-password" class="flex w-fit cursor-pointer items-center gap-2 text-sm text-slate-600">
            <input id="show-login-password" type="checkbox" data-password-toggle="#login-password" class="rounded border-slate-300 text-[#1140A6] focus:ring-[#1140A6]">
            Mostrar contraseña
        </label>
        <button class="w-full rounded-xl bg-[#1140A6] py-3 text-sm font-semibold text-white transition hover:bg-[#0e339e] focus:outline-none focus:ring-2 focus:ring-[#1140A6]/40 focus:ring-offset-2">Iniciar sesión</button>
    </form>
    <div class="mt-6 border-t border-slate-100 pt-5 text-center text-sm">
        <a class="font-medium text-[#1140A6] hover:underline" href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
        <span class="px-2 text-slate-300">·</span>
        <a class="font-medium text-[#1140A6] hover:underline" href="{{ route('register') }}">Crear cuenta</a>
    </div>
</x-auth-shell>
@endsection
