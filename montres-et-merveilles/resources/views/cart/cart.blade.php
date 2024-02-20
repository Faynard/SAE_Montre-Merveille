<table class="w-full bg-white shadow-md rounded-md overflow-hidden">
    <thead class="bg-black text-white">
        <tr>
            <th class="font-cinzel-decorative px-4 py-2 text-left">Aperçu</th>
            <th class="font-cinzel-decorative px-4 py-2 text-left">Nom</th>
            <th class="font-cinzel-decorative px-4 py-2 text-left">Prix</th>
            <th class="font-cinzel-decorative px-4 py-2 text-left">Quantité</th>
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

                    <div class="flex gap-2">
                        <button type="submit" formaction="{{ route('cart.add') }}"> + 1 </button>
                        <button type="submit" formaction="{{ route('cart.remove') }}"> - 1 </button>
                        <button type="submit" formaction="{{ route('cart.delete') }}"> Enlever du panier </button>
                    </div>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>