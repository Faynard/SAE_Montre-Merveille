@extends('layouts.default')

@section('content')

<div>
    <h1>Product: {{ $product->name }}</h1>
    <p>Product description: {{ $product->description }}</p>
    <p>Price: {{ $product->price }}€</p>

    <form action="{{ route('cart.add') }}" method="POST">
        @csrf

        <input name="product_id" value="{{ $product->id }}" />

        <button>Add to cart</button>
    </form>
</div>

@endsection