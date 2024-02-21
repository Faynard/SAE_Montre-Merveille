<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Montres & merveilles</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/accueil.css') }}">
    <link rel="stylesheet" href="{{ asset('css/boutiques.css') }}">
    <link rel="stylesheet" href="{{ asset('css/notif.css') }}">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="{{ asset('js/navbar.js') }}" defer></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="{{ asset('js/map.js') }}" defer></script>
</head>

<body>
    @if (Session::has("hasNotification"))
    <x-notification title="{{ Session::get('notificationTitle') }}" content="{{Session::get('notificationContent')}}" />
    @endif


    <header>
        <nav id="navbar" class="navbar flex items-center justify-center gap-16 font-['Comfortaa'] uppercase h-28">

            <div class="flex gap-5">
                <a href="{{ route('product.index') }}">Nos montres</a>
                <a href="{{ route('contact.index') }}">Contact</a>
            </div>

            <a href="{{ route('accueil.index') }}" class="flex flex-col gap-1">
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

    <main class="min-h-[calc(90vh)]">
        @yield('content')
    </main>

    <footer class="flex flex-col bg-[#02291F] text-white h-[472px]">
        <div class="flex basis-11/12 pt-12">
            <div class="flex flex-col items-center gap-7 basis-1/3">
                <a href="{{ route('accueil.index') }}" class="flex flex-col gap-1">
                    <img src="{{ asset('images/logo-white.svg') }}" class="h-6" />
                    <img src="{{ asset('images/swiss-made-white.svg') }}" class="h-6" />
                </a>
                <div class="flex flex-col items-center gap-4">
                    <span class="font-['Catamaran']">Mathieu LE BRAS</span>
                    <span class="font-['Catamaran']">Maximilien BAUSSON</span>
                    <span class="font-['Catamaran']">Thomas HAY</span>
                    <span class="font-['Catamaran']">Louis VILLATTE</span>
                    <span class="font-['Catamaran']">Nolan VANDEMEULEBROUCKE</span>
                </div>
            </div>
            <div class="flex basis-2/3 justify-around px-16">
                <div class="flex flex-col gap-7">
                    <span class="uppercase font-bold">Montres</span>
                    <div class="flex flex-col gap-4">
                        <a href="{{ route('product.index') }}">Toutes les montres</a>
                        <a href="{{ route('product.index') }}">Nos collections</a>
                        <a href="{{ route('product.index') }}">Nouveautés</a>
                    </div>
                </div>
                <div class="flex flex-col gap-7">
                    <span class="uppercase font-bold">Nous contacter</span>
                    <div class="flex flex-col gap-4">
                        <a href="{{ route('boutiques.index') }}">Nos boutiques</a>
                        <a href="{{ route('contact.index') }}">Contact</a>
                    </div>
                </div>
                <div class="flex flex-col gap-7">
                    <span class="uppercase font-bold">Légal</span>
                    <div class="flex flex-col gap-4">
                        <a href="{{ route('accueil.index') }}">Conditions d'utilisations</a>
                        <a href="{{ route('accueil.index') }}">Accessiblité</a>
                        <a href="{{ route('accueil.index') }}">Politique de cookie</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex items-center justify-center basis-1/12">
            <span class="font-['Catamaran']">© 2024 Montres & Merveilles</span>
        </div>
    </footer>
</body>

</html>
