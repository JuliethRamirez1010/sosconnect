@extends('layout')

@section('content')
<x-auth-compact-shell title="Recuperar contraseña" subtitle="Elige una opción para volver a acceder a SOS Connect">
    <div class="space-y-4">
        <section class="rounded-xl border border-slate-200 p-4">
            <h3 class="mb-3 font-semibold text-slate-800">1. Enlace por correo</h3>
            <form method="POST" action="{{ route('password.email') }}" class="space-y-3">
                @csrf
                <label for="link-email" class="sr-only">Correo electrónico</label>
                <input id="link-email" class="w-full rounded-xl border border-slate-200 p-3" type="email" name="email" value="{{ old('email') }}" placeholder="Correo electrónico" autocomplete="email" required>
                <button class="w-full rounded-xl bg-[#1140A6] p-3 font-semibold text-white">Enviar enlace de restablecimiento</button>
            </form>
        </section>

        <section class="rounded-xl border border-slate-200 p-4">
            <h3 class="mb-3 font-semibold text-slate-800">2. Código de verificación</h3>
            <form method="POST" action="{{ route('recovery.code.request') }}" class="space-y-3">
                @csrf
                <label for="code-email" class="sr-only">Correo electrónico</label>
                <input id="code-email" class="w-full rounded-xl border border-slate-200 p-3" type="email" name="email" value="{{ old('email') }}" placeholder="Correo electrónico" autocomplete="email" required>
                <button class="w-full rounded-xl border border-slate-200 p-3 font-semibold text-[#1140A6]">Enviar código de seis dígitos</button>
            </form>
            <a class="mt-3 inline-block text-sm text-[#1140A6] underline" href="{{ route('recovery.code.form') }}">Ya tengo un código</a>
        </section>

        <section class="rounded-xl border border-slate-200 p-4">
            <h3 class="mb-2 font-semibold text-slate-800">3. Archivo de recuperación</h3>
            <p class="mb-3 text-sm text-slate-500">Escribe el correo de tu cuenta. Te enviaremos un archivo .txt para subirlo y validar tu identidad.</p>
            <form method="POST" action="{{ route('recovery.document.request') }}" class="space-y-3">
                @csrf
                <label for="document-email" class="sr-only">Correo electrónico</label>
                <input id="document-email" class="w-full rounded-xl border border-slate-200 p-3" type="email" name="email" value="{{ old('email') }}" placeholder="Correo electrónico" autocomplete="email" required>
                <button class="w-full rounded-xl border border-slate-200 p-3 font-semibold text-[#1140A6]">Enviar archivo a mi correo</button>
            </form>
        </section>
    </div>

    <p class="mt-5 text-center text-sm"><a class="font-medium text-[#1140A6] hover:underline" href="{{ route('login') }}">Volver a iniciar sesión</a></p>
</x-auth-compact-shell>
@endsection
