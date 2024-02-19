@extends('layouts.default')

@section('content')
<div class="relative bg-black">
    <div class="relative h-[calc(100vh+113px)]">
        <video class="absolute object-cover h-screen w-screen" autoplay muted loop>
            <source src="{{ asset('videos/accueil.mp4') }}" />
        </video>

        <div class="absolute flex flex-col gap-8 lg:top-[30%] ml-16 text-white text-balance">
            <div class="animated-title flex flex-col text-5xl uppercase max-w-96">
                <div class="title-animate">
                    <span class="font-cinzel font-thin">Une Royal OAK Concept</span>
                    <span class="font-notoserif italic">À la féminité affirmée</span>
                </div>
            </div>


            <div class="animated-description">
                <p class="description-animate w-2/5">
                    Montres & Merveilles dévoile une nouvelle édition limitée de la Royal Oak Concept Tourbillon Volant,
                    imaginée
                    en collaboration avec la créatrice de Haute Couture Tamara Ralph.
                </p>
            </div>

            <div class="animated-description">
                <p class="description-animate flex gap-2 items-center">
                    <span class="block w-12 border border-white"></span>
                    <span>En savoir plus</span>
                </p>
            </div>

        </div>
    </div>

    <div class="h-screen"></div>
</div>
@endsection