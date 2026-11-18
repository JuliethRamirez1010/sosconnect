@props(['title', 'subtitle'])

<div class="min-h-screen bg-slate-50 lg:grid lg:grid-cols-2">
    <aside class="relative hidden flex-col items-center justify-center overflow-hidden bg-[#1140A6] p-12 text-white lg:flex">
        <div class="absolute inset-0 opacity-10" style="background-image:radial-gradient(circle at 30% 20%,#fff 1px,transparent 1px),radial-gradient(circle at 70% 80%,#fff 1px,transparent 1px);background-size:40px 40px"></div>
        <div class="relative z-10 max-w-sm text-center">
            <div class="mx-auto mb-6 flex h-28 w-28 items-center justify-center rounded-2xl bg-white shadow-lg">
                <img src="{{ asset('images/sos-connect.png') }}" alt="SOS Connect" class="h-24 w-24 object-contain">
            </div>
            <h1 class="mb-3 text-4xl font-bold" style="font-family:'DM Sans',sans-serif">SOS Connect</h1>
            <p class="mb-8 text-lg font-light text-blue-200">Sistema Hospitalario de Alertas</p>
            <div class="space-y-4 text-left text-blue-100">
                <p><span class="mr-3 text-red-300">●</span>Alertas urgentes en tiempo real</p>
                <p><span class="mr-3 text-orange-300">●</span>Seguimiento de atención al paciente</p>
                <p><span class="mr-3 text-green-300">●</span>Historial completo de eventos</p>
            </div>
        </div>
        <p class="absolute bottom-6 text-xs text-blue-200/70">© 2026 SOS Connect — Sistema Hospitalario</p>
    </aside>

    <div class="flex items-center justify-center p-5 sm:p-8">
        <div class="w-full max-w-lg">
            <div class="mb-7 text-center lg:hidden">
                <img src="{{ asset('images/sos-connect.png') }}" alt="SOS Connect" class="mx-auto mb-3 h-16 w-16 object-contain">
                <h1 class="text-2xl font-bold">SOS Connect</h1>
                <p class="text-sm text-slate-500">Sistema Hospitalario de Alertas</p>
            </div>
            <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
                <h2 class="text-2xl font-bold" style="font-family:'DM Sans',sans-serif">{{ $title }}</h2>
                <p class="mt-1 text-sm text-slate-500">{{ $subtitle }}</p>
                <div class="mt-7">{{ $slot }}</div>
            </section>
            <p class="mt-5 text-center text-xs text-slate-400">© 2026 SOS Connect</p>
        </div>
    </div>
</div>
