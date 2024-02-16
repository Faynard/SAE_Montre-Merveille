@extends("layouts.default")

@section("content")
<div class="px-12 md:px-26 lg:px-44 mt-20 mb-12">
    <!-- Barre de recherche -->
    <form class="flex flex-col gap-1" action="{{ route('product.index') }}" method="GET">
        <div class="relative">
            <input
                class="border-b-2 border-gray-400 focus:border-gray-500 py-2 text-2xl w-full md:text-4xl font-thin focus:outline-none pl-4 transition"
                name="name" placeholder="Rechercher des montres" />
            <button type="submit" class="absolute inset-y-0 right-0">
                <img class="mb-6" src="{{ asset('images/search-icon.svg') }}" />
            </button>
        </div>
    </form>

    <!-- Filtres -->
    <div class="mt-32 border-b border-gray-400 flex gap-8 py-4">
        <div>
            <span class="text-gray-400 font-thin">Filtrer par</span>
        </div>
        <div>
            <span>Taille</span>
            <div class="mt-8">
                <form class="flex gap-8">
                    <label>Size (mm.)</label>
                    <input class="border-b-2 border-gray-400 font-thin text-lg focus:outline-none" type="number"
                        name="size" default="0" min="0" max="60" />
                </form>
            </div>
        </div>
        <div>
            <span>Collection</span>
        </div>
        <div>
            <span>Matériau</span>
        </div>
    </div>

    <p class="my-8 text-gray-400 font-thin">{{ count($products) }} montres</p>

    <div class="grid grid-cols-3 gap-4">
        @foreach ($products as $product)
        <article class="bg-neutral-200 p-6 flex flex-col items-center gap-6 group">
            <a href="{{ route('product.show', ['product' => $product->id]) }}" class="text-lg font-bold"><img
                    class="w-40 drop-shadow-lg transition ease-in group-hover:scale-105 duration-500"
                    src="{{ asset('images/montre_1.png') }}" /></a>

            <p class="flex flex-col items-center">
                <a href="{{ route('product.show', ['product' => $product->id]) }}" class="text-lg font-bold">{{
                    $product->name }}</a>
                <span class="font-thin">Ultra-Complication Universelle</span>
            </p>

            <span class="text-sm font-light text-gray-500">
                42mm, Or gris 18 carats
            </span>
        </article>
        @endforeach
    </div>
</div>
@endsection