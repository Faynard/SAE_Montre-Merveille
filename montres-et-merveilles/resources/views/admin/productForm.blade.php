@extends('layouts.default')

@section('content')
<form action="{{route('admin.product.save')}}" method="post">
    @csrf
    <div>
        <input type="text" name="id" value="{{$product->id}}" hidden>
    </div>

    <div>
        <label>Nom : </label>
        <input type="text" name="name" value="{{$product->name}}" required>
        @error('name')
        <div>
            {{ $message }}
        </div>
        @enderror
    </div>

    <div>
        <label>Description : </label>
        <input type="text" name="description" value="{{$product->description}}" required>
        @error('description')
        <div>
            {{ $message }}
        </div>
        @enderror
    </div>

    <div>
        <label>Prix : </label>
        <input type="number" name="price" value="{{$product->price}}" required>
        @error('price')
        <div>
            {{ $message }}
        </div>
        @enderror
    </div>

    <div>
        <label>Taille (mm.) : </label>
        <input type="number" name="size" value="{{$product->size}}" required>
        @error('size')
        <div>
            {{ $message }}
        </div>
        @enderror
    </div>

    <div>
        <label>Mouvement : </label>
        <select name="movement" required>
            <option selected disabled>--- Mouvement ---</option>

            @foreach (App\Models\Product::$movements as $movement)
            <option value="{{$movement}}" {{ ($product->movement == $movement) ? 'selected' : '' }}>{{ $movement }}
            </option>
            @endforeach
        </select>

        @error('movement')
        <div>
            {{ $message }}
        </div>
        @enderror
    </div>

    <div>
        <label>Matériaux : </label>
        <select name="material" required>
            <option selected disabled>--- Matériaux ---</option>

            @foreach (App\Models\Product::$materials as $material)
            <option value="{{$material}}" {{ ($product->material == $material) ? 'selected' : '' }}>{{ $material }}
            </option>
            @endforeach
        </select>

        @error('material')
        <div>
            {{ $message }}
        </div>
        @enderror
    </div>
    <button>Enregistrer</button>
</form>
@endsection