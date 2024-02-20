@extends('layouts.default')

@section('content')
<div class="flex justify-center mt-8">
    <table class="w-full bg-white shadow-md rounded-lg overflow-hidden">
        <thead class="bg-gray-800 text-white">
            <tr>
                <th class="px-4 py-2 text-left">Aperçu</th>
                <th class="px-4 py-2 text-left">Nom</th>
                <th class="px-4 py-2 text-left">Prix</th>
                <th class="px-4 py-2 text-left">Quantité</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($quantityItems as $quantityItem)
            <tr class="hover:bg-gray-100">
                <td class="px-4 py-2">
                    <a href="{{ route('product.show', ['product'=> $quantityItem->product->id]) }}">
                        <img class="w-20 h-20 object-contain" src="{{ asset('images/montre_1.png') }}" />
                    </a>
                </td>
                <td class="px-4 py-2 font-bold">
                    <a href="{{ route('product.show', ['product'=> $quantityItem->product->id]) }}">{{
                        $quantityItem->product->name }}
                    </a>
                </td>
                <td class="px-4 py-2">{{ $quantityItem->product->price }}</td>
                <td class="px-4 py-2">{{ $quantityItem->quantity }}</td>
                <td>
                    <form method="POST">
                        @csrf

                        <input name="product_id" value="{{ $quantityItem->product->id }}" hidden />

                        <button type="submit" formaction="{{ route('cart.add') }}"> +1 </button>
                        <button type="submit" formaction="{{ route('cart.remove') }}"> -1 </button>
                        <button type="submit" formaction="{{ route('cart.delete') }}"> Enlever du panier </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
