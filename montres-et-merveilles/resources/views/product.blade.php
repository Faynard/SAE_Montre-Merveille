@extends('layouts.default')

@section('content')

<div>
    <h1>Product: {{ $product->name }}</h1>
    <p>Product description: {{ $product->description }}</p>
    <p>Price: {{ $product->price }}€</p>
    <button>Add to cart</button>
</div>

@endsection
