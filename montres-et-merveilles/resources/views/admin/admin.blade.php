@extends('layouts.default')

@section('content')
    <div class="mx-16">
        <table class="w-full bg-white shadow-md rounded-md overflow-hidden">
            <thead class="bg-black text-white">
                <tr>
                    <th> Id </th>
                    <th> Utilisateur </th>
                    <th> Price </th>
                    <th> Date de création </th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr class="hover:bg-gray-100 text-center">
                        <td class="px-4 py-2">{{ $order->id }}</td>
                        <td>{{ $order->user->lastname }}</td>
                        <td>{{ $order->price }}</td>
                        <td>{{ $order->created_at }}</td>
                        <td>
                            <form action="{{ route('admin.order.delete', ['id' => $order->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button>Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-8">
            <a href="{{ route('admin.product.create') }}">
                <x-forms.button text="Créer un produit" />
            </a>
        </div>
    </div>
@endsection
