@extends('layouts.default')

@section('content')
    <div class="flex justify-between">
        <div class="w-1/2">
            <form action="{{ route('user.profile') }}" method="post">
                @csrf
                @method('PUT')
                <div>
                    <label for="firstname">firstname</label>
                    <input type="text" name="firstname" id="firstname" value="{{ $user->firstname }}">

                    @error('firstname')
                        <div>
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div>
                    <label for=lastname">lastname</label>
                    <input type="text" name="lastname" id="lastname" value="{{ $user->lastname }}">

                    @error('lastname')
                        <div>
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div>
                    <label for="password">password</label>
                    <input type="password" name="password" id="password">

                    @error('password')
                        <div>
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div>
                    <label for="password_confirmation">password confirmation</label>
                    <input type="password" name="password_confirmation" id="password_confirmation">

                    @error('password')
                        <div>
                            {{ $message }}
                        </div>
                    @enderror
                    <div>
                        <button type="submit">Update</button>
                    </div>
            </form>
            <div class="buttons-action flex gap-6">
                <form action="{{ route('user.logout') }}" method="post">
                    @csrf
                    <button type="submit">logout</button>
                </form>
                <form action="{{ route('user.profile') }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit">delete</button>
                </form>
            </div>
            <div>
                @if($user->role == 'admin')
                    <div>
                        <a href="{{route('admin.index')}}">Page d'administration</a>
                    </div>
                @endif
            </div>
        </div>

        <div>
            @include('cart.cart', ['quantityItems' => $quantityItems])
            @if ($quantityItems->isEmpty())
                <div>
                    <p>Votre panier est vide</p>
                </div>
            @else
                <a href="{{ route('order.payment') }}">Valider le panier</a>
            @endif
        </div>
    </div>
@endsection
