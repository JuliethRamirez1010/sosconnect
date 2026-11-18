@props(['title', 'subtitle'])

<div class="flex min-h-screen items-center justify-center bg-slate-50 px-4 py-8">
    <div class="w-full max-w-xl">
        <header class="mb-5 flex items-center justify-center gap-3">
            <img src="{{ asset('images/sos-connect.png') }}" alt="Logo SOS Connect" class="h-12 w-12 rounded-xl bg-white object-contain shadow-sm">
            <div>
                <p class="text-lg font-bold leading-tight text-slate-900">SOS Connect</p>
                <p class="text-xs text-slate-500">Sistema Hospitalario de Alertas</p>
            </div>
        </header>
        <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
            <h1 class="text-2xl font-bold text-slate-900">{{ $title }}</h1>
            <p class="mt-1 text-sm text-slate-500">{{ $subtitle }}</p>
            <div class="mt-6">{{ $slot }}</div>
        </section>
    </div>
</div>
