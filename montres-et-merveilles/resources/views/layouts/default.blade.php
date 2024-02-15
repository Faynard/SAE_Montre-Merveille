<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Montres & merveilles</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/accueil.css') }}">

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="{{ asset('js/navbar.js') }}" defer></script>
</head>

<body>
    <header>
        <nav id="navbar"
            class="navbar flex items-center justify-center gap-16 font-['Comfortaa'] uppercase h-28">

            <div class="flex gap-5">
                <a href="{{ route('product.index') }}">Nos montres</a>
                <a href="{{ route('contact.index') }}">Contact</a>
            </div>

            <a href="{{ route('acceuil.index') }}" class="flex flex-col gap-1">
                <img id="logo" data-alt-src="{{ asset('images/logo-white.svg') }}"
                    src="{{ asset('images/logo.svg') }}" />
                <img id="swiss-logo" data-alt-src="{{ asset('images/swiss-made-white.svg') }}"
                    src="{{ asset('images/swiss-made.svg') }}" class="h-6" />
            </a>

            <div class="flex gap-5">
                <a href="{{ route('user.profile') }}">Mon compte</a>
                <a href="{{ route('boutiques.index') }}">Boutiques</a>
            </div>

        </nav>
    </header>

    <main class="min-h-screen">
        @yield('content')
    </main>

    <footer class="bg-green-900">
        <div class="flex items-center justify-center h-96">
            <span>footer</span>
        </div>
    </footer>
</body>

</html>
