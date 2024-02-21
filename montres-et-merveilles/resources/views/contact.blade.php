@extends('layouts.default')

@section('content')
<div class="flex">
    <img class="w-1/2" src="{{ asset('images/montre_4.png') }}" />
    <div class="flex items-center">
        <div class="border-l-2 border-gray-500 pl-12 py-8">
            <div class="flex flex-col text-5xl uppercase max-w-96 mb-12 uppercase">
                <span class="font-cinzel font-thin">Trouver un</span>
                <span class="font-notoserif italic">Détaillant</span>
            </div>

            <x-forms.button text="Détaillants agréés" />
            <a href="{{ route('boutiques.index') }}" class="flex gap-2 items-center mt-2">
                <span class="block w-12 border border-black"></span>
                <span>Explorer toutes les boutiques</span>
            </a>

            <div class="mt-6 bg-gray-100 p-6 flex flex-col gap-3">
                <h3 class="uppercase tracking-widest font-bold font-['Catamaran'] text-gray-600">Contact local</h3>

                <div class="font-semibold">
                    <p>+33 1 53 33 23 16</p>
                    <p>info.europe@montres&merveilles.com</p>
                </div>

                <div class="flex flex-col gap-0.5 font-bold text-gray-500">
                    <p class="flex justify-between gap-4">
                        <span>Lundi - Vendredi</span>
                        <span>8:00 - 17:30</span>
                    </p>

                    <p class="flex justify-between gap-4">
                        <span>Samedi</span>
                        <span>10:00 - 18:00</span>
                    </p>

                    <p class="flex justify-between gap-4">
                        <span>Dimanche</span>
                        <span>Fermé</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection