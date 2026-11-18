@extends('layout')

@section('content')
<x-auth-shell title="Crear cuenta" subtitle="Regístrate para acceder al sistema hospitalario">
    <form method="POST" action="{{ url('/register') }}" class="space-y-4">
        @csrf
        <div>
            <label for="name" class="mb-1.5 block text-sm font-semibold text-slate-700">Nombre completo</label>
            <input id="name" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-[#1140A6] focus:outline-none focus:ring-2 focus:ring-[#1140A6]/30" name="name" value="{{ old('name') }}" placeholder="Tu nombre" autocomplete="name" maxlength="255" required autofocus>
        </div>
        <div>
            <label for="email" class="mb-1.5 block text-sm font-semibold text-slate-700">Correo electrónico</label>
            <input id="email" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-[#1140A6] focus:outline-none focus:ring-2 focus:ring-[#1140A6]/30" type="email" name="email" value="{{ old('email') }}" placeholder="correo@hospital.com" autocomplete="email" maxlength="255" required>
        </div>
        <div>
            <label for="password" class="mb-1.5 block text-sm font-semibold text-slate-700">Contraseña</label>
            <input id="password" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-[#1140A6] focus:outline-none focus:ring-2 focus:ring-[#1140A6]/30" type="password" name="password" placeholder="Mínimo 8 caracteres" autocomplete="new-password" minlength="8" required>
        </div>
        <div>
            <label for="password_confirmation" class="mb-1.5 block text-sm font-semibold text-slate-700">Confirmar contraseña</label>
            <input id="password_confirmation" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-[#1140A6] focus:outline-none focus:ring-2 focus:ring-[#1140A6]/30" type="password" name="password_confirmation" placeholder="Repite tu contraseña" autocomplete="new-password" minlength="8" required>
        </div>
        <button class="w-full rounded-xl bg-[#1140A6] py-3 text-sm font-semibold text-white transition hover:bg-[#0e339e] focus:outline-none focus:ring-2 focus:ring-[#1140A6]/40 focus:ring-offset-2">Crear cuenta</button>
    </form>
    <p class="mt-6 border-t border-slate-100 pt-5 text-center text-sm text-slate-600">
        ¿Ya tienes una cuenta?
        <a class="font-semibold text-[#1140A6] hover:underline" href="{{ route('login') }}">Inicia sesión</a>
    </p>
</x-auth-shell>
@endsection
