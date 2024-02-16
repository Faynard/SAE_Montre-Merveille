@extends('layouts.default')

@section('content')
    <div class="grid grid-cols-2 m-16">
        <div class="flex flex-col gap-8 lg:top-[30%] text-balance">
            <div class="flex flex-col text-5xl uppercase max-w-96">
                <span class="font-['Cinzel'] font-thin">TROUVER UNE</span>
                <span class="font-['NotoSerif'] italic">BOUTIQUE</span>
            </div>

            <p class="w-[1/2]">
                Pour découvrir nos montres ou nous confier la vôtre en révision, poussez la porte d'une de nos boutiques 
                <br />ou prenez rendez-vous.
            </p>
        </div>
        <div id="map"></div>
    </div>
@endsection
