@extends('layouts.default')

@section('content')
<div class="relative snap-y bg-black">
    <div class="relative h-screen snap-center scroll-m-0">
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

    <div class="flex items-center mx-16 h-screen snap-center scroll-m-0 gap-11">
        <img class="w-6/12" src="{{ asset('images/image_montre_accueil.png') }}" alt="montre">
        <div class="flex flex-col gap-8 text-white text-balance">
            <div class="flex flex-col text-5xl uppercase max-w-96">
                    <span class="font-cinzel font-thin">CODE 11,59</span>
                    <span class="font-notoserif italic">BY MONTRES & MERVEILLES</span>
            </div>


            <p class="w-4/5">
                La combinaison des savoir-faire horlogers de la Manufacture dans un seul mouvement à remontage automatique, capable d'animer 40 fonctions, dont 23 complications.
            </p>

            <p class="flex gap-2 items-center">
                <span class="block w-12 border border-white"></span>
                <span>En savoir plus</span>
            </p>
        </div>
    </div>
</div>
@endsection
