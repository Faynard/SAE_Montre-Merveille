@extends('layouts.default')

@section('content')

<div class="flex justify-between">
    <div class="w-1/2">
        <form action="{{ route('order.payment') }}" method="GET">
            <button type="submit">Retour au panier</button>
        </form>

        <form action="{{ route('order.payment') }}" method="POST">
            @csrf
            <div>
                <label>Nom sur la carte</label>
                <input type="text" name="card_name"/>

                @error('card_name')
                <div>
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div>
                <label>Numéro de carte bancaire</label>
                <input type="text" name="card_number" pattern="\d{16}" title="Le numéro de carte doit contenir 16 chiffres" maxlength="16"/>

                @error('card_number')
                <div>
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div>
                <label>Date d'expiration (MM/AA)</label>
                <input type="text" name="expiration_date" placeholder="MM/AA" pattern="(0[1-9]|1[0-2])\/\d{2}" title="Le format doit être MM/AA"/>

                @error('expiration_date')
                <div>
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div>
                <label>CVV</label>
                <input type="text" name="cvv" pattern="\d{3}" title="Le CVV doit contenir 3 chiffres" maxlength="3" inputmode="numeric" />

                @error('cvv')
                <div>
                    {{ $message }}
                </div>
                @enderror
            </div>

            <button type="submit">Payer</button>
        </form>
    </div>

    <div class="w-1/2 pl-8">
        <table class="w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-gray-800 text-white">
            <tr>
                <th colspan="4">Récapitulatif de la commande</th>
            </tr>
            <tr>
                <th class="px-4 py-2 text-left">Aperçu</th>
                <th class="px-4 py-2 text-left">Nom</th>
                <th class="px-4 py-2 text-left">Prix</th>
                <th class="px-4 py-2 text-left">Quantité</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($quantityItems as $quantityItem)
            <tr class="hover:bg-gray-100">
                <td class="px-4 py-2">
                    <a>
                        <img class="w-20 h-20 object-contain" src="{{ asset('images/montre_1.png') }}" />
                    </a>
                </td>
                <td class="px-4 py-2 font-bold">
                    <a >
                        {{ $quantityItem->product->name }}
                    </a>
                </td>
                <td class="px-4 py-2">{{ $quantityItem->product->price }}€</td>
                <td class="px-4 py-2">{{ $quantityItem->quantity }}</td>
            </tr>
            @endforeach
            <tr>
                <td class="px-4 py-2">Prix total : {{ $totalPrice }}€</td>
            </tr>
            </tbody>
        </table>
    </div>


</div>
@endsection
