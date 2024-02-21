@extends('layouts.default')

@section('content')
    <form action="{{ route('admin.product.save') }}" method="post" class="flex flex-col gap-6 w-1/2 mx-auto pb-6">
        @csrf
        <div>
            <input type="text" name="id" value="{{ $product->id }}" hidden>
        </div>

        <div class="grid md:grid-cols-2 gap-6">
            <div>
                <x-forms.input label="Nom" name="name" value="{{ $product->name }}" placeholder="Nom du produit" />

                @error('name')
                    <x-forms.error>{{ $message }}</x-forms.error>
                @enderror
            </div>

            <div>
                <x-forms.input type="number" label="Prix" name="price" value="{{ $product->price }}"
                    placeholder="Prix" />

                @error('price')
                    <x-forms.error>{{ $message }}</x-forms.error>
                @enderror
            </div>
        </div>

        <div>
            <x-forms.input label="Description" name="description" value="{{ $product->description }}"
                placeholder="Description du produit" />

            @error('description')
                <x-forms.error>{{ $message }}</x-forms.error>
            @enderror
        </div>

        <div>
            <x-forms.input type="number" label="Taille (mm.)" name="size" value="{{ $product->size }}"
                placeholder="Taille du cadran" />

            @error('size')
                <x-forms.error>{{ $message }}</x-forms.error>
            @enderror
        </div>

        <div>
            <div class="flex flex-col h-20 gap-4">
                <label for="movement"
                    class="font-['Catamaran Semi Bold'] uppercase tracking-widest italic text-lg">Mouvement</label>
                <select name="movement" required>
                    <option selected disabled>--- Mouvement ---</option>

                    @foreach (App\Models\Product::$movements as $movement)
                        <option value="{{ $movement }}" {{ $product->movement == $movement ? 'selected' : '' }}>
                            {{ $movement }}
                        </option>
                    @endforeach
                </select>
            </div>

            @error('movement')
                <x-forms.error>{{ $message }}</x-forms.error>
            @enderror
        </div>

        <div>
            <div class="flex flex-col h-20 gap-4">
                <label for="movement"
                    class="font-['Catamaran Semi Bold'] uppercase tracking-widest italic text-lg">Matériaux</label>
                <select name="material" required>
                    <option selected disabled>--- Matériaux ---</option>

                    @foreach (App\Models\Product::$materials as $material)
                        <option value="{{ $material }}" {{ $product->material == $material ? 'selected' : '' }}>
                            {{ $material }}
                        </option>
                    @endforeach
                </select>
            </div>

            @error('material')
                <x-forms.error>{{ $message }}</x-forms.error>
            @enderror
        </div>

        <div class="mx-auto">
            <x-forms.button text="Enregistrer" />
        </div>
    </form>
@endsection
