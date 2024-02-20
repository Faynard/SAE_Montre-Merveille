@extends('layouts.default')

@section('content')
<table>
    <thead>
        <tr>
            <th> Id </th>
            <th> Utilisateur </th>
            <th> Price </th>
            <th> Date de création </th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
        <tr>
            <td>{{ $order->id }}</td>
            <td>{{ $order->user->lastname }}</td>
            <td>{{ $order->price }}</td>
            <td>{{ $order->created_at }}</td>
            <td>
                <form action="{{ route('admin.order.delete', ['id' => $order->id]) }}" method="POST">
                    @csrf
                    @method("DELETE")

                    <button>Supprimer</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div>
    <a href="{{ route('admin.product.create')}}">Créer un produit</a>
</div>
@endsection