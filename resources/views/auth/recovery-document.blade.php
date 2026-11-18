@extends('layout')

@section('content')
<x-auth-compact-shell title="Archivo de recuperación" subtitle="Validación de seguridad de SOS Connect">
    <p class="text-sm text-slate-500">Enviamos el archivo al correo que ingresaste. Selecciona el .txt adjunto para validarlo.</p>
    <form method="POST" enctype="multipart/form-data" action="{{ route('recovery.document.verify') }}" class="mt-5 space-y-3">
        @csrf
        <label for="email" class="block text-sm font-semibold text-slate-700">Correo electrónico</label>
        <input id="email" class="w-full rounded-xl border border-slate-200 p-3" type="email" name="email" value="{{ old('email', session('recovery_email', '')) }}" placeholder="Correo electrónico" autocomplete="email" required>
        <label for="document" class="block text-sm font-semibold text-slate-700">Archivo .txt</label>
        <input id="document" class="w-full rounded-xl border border-slate-200 p-3" type="file" name="document" accept=".txt,text/plain" required>
        <button class="w-full rounded-xl bg-[#1140A6] p-3 font-semibold text-white">Verificar archivo</button>
    </form>
    <p class="mt-5 text-center text-sm"><a class="font-medium text-[#1140A6] hover:underline" href="{{ route('password.request') }}">Volver a recuperación</a></p>
</x-auth-compact-shell>
@endsection
