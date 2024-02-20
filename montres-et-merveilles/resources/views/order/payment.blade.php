@extends('layouts.default')

@section('content')

<div class="grid grid-cols-2 gap-8 mx-16">
    <div>
        <form action="{{ route('order.payment') }}" method="GET">
            <button type="submit">Retour au panier</button>
        </form>

        <form action="{{ route('order.payment') }}" method="POST">
            @csrf
            <div>
                <label>Nom sur la carte</label>
                <input type="text" name="card_name" />

                @error('card_name')
                <div>
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div>
                <label>Numéro de carte bancaire</label>
                <input type="text" name="card_number" pattern="\d{16}"
                    title="Le numéro de carte doit contenir 16 chiffres" maxlength="16" />

                @error('card_number')
                <div>
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div>
                <label>Date d'expiration (MM/AA)</label>
                <input type="text" name="expiration_date" placeholder="MM/AA" pattern="(0[1-9]|1[0-2])\/\d{2}"
                    title="Le format doit être MM/AA" />

                @error('expiration_date')
                <div>
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div>
                <label>CVV</label>
                <input type="text" name="cvv" pattern="\d{3}" title="Le CVV doit contenir 3 chiffres" maxlength="3"
                    inputmode="numeric" />

                @error('cvv')
                <div>
                    {{ $message }}
                </div>
                @enderror
            </div>

            <button type="submit">Payer</button>
        </form>
    </div>

    <div>
        @include('cart.cart', ['quantityItems' => $quantityItems])
    </div>

</div>
@endsection