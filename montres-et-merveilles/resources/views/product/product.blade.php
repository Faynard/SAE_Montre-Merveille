@extends('layouts.default')

@section('content')

<div class="px-12 md:px-26 lg:px-44">
    <div class="grid grid-cols-3">
        <p class="flex flex-col gap-4 mt-20">
            <span class="text-4xl font-cinzel">{{ $product->name }}</span>
            <span class="text-gray-600 font-light">EUR {{ number_format($product->price) }}</span>
        </p>

        <img src="{{ asset('images/montre_2.png') }}" />
    </div>

    <form class="my-8 flex justify-center" action="{{ route('cart.add') }}" method="POST">
        @csrf

        <input name="product_id" value="{{ $product->id }}" hidden />

        <x-forms.button text="Ajouter au panier" />
    </form>
    <div>
        {{-- Si l'utilisateur est authentifié et est admin --}}
        @if(Auth::user()?->role == 'admin')
        <div>
            <a href="{{route('admin.product.edit',$product->id)}}">Modifier le produit</a>

            <form action="{{ route('product.delete', ['product'=> $product->id]) }}" method="POST">
                @csrf
                @method("DELETE")

                <button>Supprimer le produit</button>
            </form>
        </div>
        @endif
    </div>

    <p class="my-12 font-great-vibes text-4xl font-medium text-center">
        “Montres & Merveilles ouvre la voie vers l'avenir de l'horlogerie”
    </p>

    <div class="grid grid-cols-2 gap-8">
        <img class="mb-10" src="{{ asset('images/montre_3.png') }}" />

        <p class="font-medium text-balance">
            {{ $product->description }}
        </p>
    </div>

</div>
@endsection