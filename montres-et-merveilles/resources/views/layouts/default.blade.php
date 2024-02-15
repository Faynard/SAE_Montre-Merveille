<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Montres & merveilles</title>

    <link rel="stylesheet" href="css/app.css">

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <nav class="flex items-center justify-center gap-16 font-['Comfortaa'] uppercase h-28">

        <div class="flex gap-5">
            <span>Nos montres</span>
            <span>Contact</span>
        </div>

        <span class="flex flex-col gap-1">
            <img src="{{ asset('images/logo.svg') }}" />
            <img src="{{ asset('images/swiss-made.svg') }}" class="h-6" />
        </span>

        <div class="flex gap-5">
            <span>Mon compte</span>
            <span>Boutique</span>
        </div>

    </nav>

    <main>
        @yield('content')
    </main>
</body>

</html>