@extends('layouts.default')

@section('content')
    <div class="grid grid-cols-2 gap-8 mx-16">
        <div class="flex flex-col gap-8">
            <form action="{{ route('user.profile') }}" method="GET">
                <x-forms.button text="Retour au panier" />
            </form>

            <form action="{{ route('order.payment') }}" method="POST" class="flex flex-col gap-4">
                @csrf

                <x-forms.input type="text" name="card_name" label="Nom sur la carte"
                    placeholder="Indiquez le nom présent sur la carte" />
                @error('card_name')
                    <x-forms.error>{{ $message }}</x-forms.error>
                @enderror

                <x-forms.input type="text" name="card_number" label="Numéro de carte bancaire"
                    placeholder="Indiquez le numéro de votre carte bancaire"
                    title="Le numéro de carte doit contenir 16 chiffres" maxLength="16" />
                @error('card_number')
                    <x-forms.error>{{ $message }}</x-forms.error>
                @enderror

                <x-forms.input type="text" name="expiration_date" label="Date d'expiration (MM/AA)" placeholder="MM/AA"
                    title="Le format doit être MM/AA" maxLength="5" pattern="(0[1-9]|1[0-2])\/\d{2}" />
                @error('expiration_date')
                    <x-forms.error>{{ $message }}</x-forms.error>
                @enderror

                <x-forms.input type="text" name="cvv" label="CVV" placeholder="123"
                    title="Le CVV doit contenir 3 chiffres" maxLength="3" inputmode="numeric" />
                @error('cvv')
                    <x-forms.error>{{ $message }}</x-forms.error>
                @enderror

                <x-forms.button text="Payer" />
            </form>
        </div>

        <div>
            @include('cart.cart', ['quantityItems' => $quantityItems])
        </div>

    </div>
@endsection
