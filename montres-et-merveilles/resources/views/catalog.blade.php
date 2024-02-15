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
        <h3>{{ $product->name }}</h3>
        <span>{{ $product->description }}</span>
        <h4>{{ $product->price }}€</h4>
    </div>
    @endforeach
</div>
@endsection