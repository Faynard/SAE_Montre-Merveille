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

        <button class="bg-black border border-transparent px-10 py-4 text-white font-cinzel-decorative 
            hover:bg-white hover:text-black hover:border-black hover:font-black transition-all ease-out">Ajouter
            au panier</button>
    </form>
    <div>
        {{-- Si l'utilisateur est authentifié et est admin --}}
        @if(Auth::user()?->role == 'admin')
        <div>
            <a href="{{route('admin.product.edit',$product->id)}}">Modifier le produit</a>
        </div>
        @endif
    </div>
</div>
@endsection
