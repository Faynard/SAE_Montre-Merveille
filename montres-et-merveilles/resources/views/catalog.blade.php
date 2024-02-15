@extends("layouts.default")

@section("content")
<h1>
    Catalogue
</h1>

<div>
    <h3>{{ count($products) }} montres</h3>

    @foreach ($products as $product)
    </br>
    <div>
        <a href="{{ route('product.show', ['product'=> $product->id]) }}">{{ $product->name }}</a>
        <span>{{ $product->description }}</span>
        <h4>{{ $product->price }}€</h4>
    </div>
    @endforeach
</div>
@endsection