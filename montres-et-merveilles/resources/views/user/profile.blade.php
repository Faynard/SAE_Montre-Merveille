@extends('layouts.default')

@section('content')
<div class="grid grid-rows-2 md:grid-cols-2 mx-16 mt-4 md:mt-8 gap-8">
    <div>
        <form class="flex flex-col gap-8" action="{{ route('user.profile') }}" method="post">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-2 gap-3 md:gap-5">
                <div class="flex flex-col gap-0.5">
                    <x-forms.input name="firstname" label="Prénom" placeholder="Votre prénom"
                        value="{{ $user->firstname }}" />

                    @error('firstname')
                    <x-forms.error>{{ $message }}</x-forms.error>
                    @enderror
                </div>

                <div class="flex flex-col gap-0.5">
                    <x-forms.input name="lastname" label="Nom de famille" placeholder="Votre nom de famille"
                        value="{{ $user->lastname }}" />

                    @error('lastname')
                    <x-forms.error>{{ $message }}</x-forms.error>
                    @enderror
                </div>
            </div>

            <div class="flex flex-col gap-0.5">
                <x-forms.input name="password" type="password" label="Mot de passe" placeholder="Votre mot de passe" />

                @error('password')
                <x-forms.error>{{ $message }}</x-forms.error>
                @enderror
            </div>

            <div class="flex flex-col gap-0.5">
                <x-forms.input name="password_confirmation" type="password" label="Confirmez votre mot de passe"
                    placeholder="Confirmez votre mot de passe" />
            </div>

            <div class="flex flex-row-reverse gap-2 mt-2">
                <x-forms.button text="Enregistrer" />
            </div>
        </form>

        <div class="grid grid-cols-3 mt-3">
            <div>
                @if($user->role == 'admin')
                <a href="{{route('admin.index')}}">
                    <x-forms.button text="Page d'administration" />
                </a>
                @endif
            </div>

            <form action="{{ route('user.profile') }}" method="post" class="mr-auto">
                @csrf
                @method('DELETE')

                <x-forms.button text="Supprimer mon compte" />
            </form>

            <form action="{{ route('user.logout') }}" method="post">
                @csrf

                <x-forms.button text="Se déconnecter" />
            </form>
        </div>
    </div>

    <div>
        @include('cart.cart', ['quantityItems' => $quantityItems])

        <p class="text-right mt-2">
            @if ($quantityItems->isEmpty())
            <span>Votre panier est vide</span>
            @else
            <a href="{{ route('order.payment') }}">
                <x-forms.button text="Valider le panier" />
            </a>
            @endif
        </p>
    </div>
</div>
@endsection