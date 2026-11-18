<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Sistema Hospitalario' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-slate-50 text-slate-900" style="font-family: Inter, ui-sans-serif, system-ui, sans-serif">

    <div class="min-h-screen">

        @auth
        <nav class="bg-slate-900 text-white">
            <div class="mx-auto flex max-w-7xl items-center justify-between p-4">

                <a href="{{ route('dashboard') }}" class="flex items-center gap-2 font-bold">
                    <img src="{{ asset('images/sos-connect.png') }}" alt="" class="h-8 w-8 rounded bg-white object-contain">
                    SOS Connect
                </a>

                @auth
                    <div class="flex items-center gap-4 text-sm">

                        <a href="{{ route('dashboard') }}">
                            Inicio
                        </a>

                        <a href="{{ route('profile.edit') }}">
                            Perfil
                        </a>

                        <a href="{{ route('security.edit') }}">
                            Seguridad
                        </a>

                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.users.index') }}">
                                Usuarios
                            </a>
                        @endif

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit">
                                Salir
                            </button>
                        </form>

                    </div>
                @endauth

            </div>
        </nav>
        @endauth

        <main class="@auth mx-auto max-w-7xl p-6 @else min-h-screen @endauth">

            @if(session('success'))
                <div class="mb-4 rounded bg-emerald-100 p-3">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('status'))
                <div class="mb-4 rounded bg-blue-100 p-3">
                    {{ session('status') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-4 rounded bg-red-100 p-3">
                    <ul>
                        @foreach($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{ $slot ?? '' }}

            @yield('content')

        </main>

    </div>

</body>
</html>
