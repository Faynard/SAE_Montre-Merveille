@extends('layouts.default')

@section('content')
<form action="{{ route('user.register') }}" method="POST">
    @csrf

    <div>
        <label>Nom</label>
        <input name="lastname" value="{{ old('lastname') }}" />

        @error('lastname')
        <div>
            {{ $message }}
        </div>
        @enderror
    </div>

    <div>
        <label>Prénom</label>
        <input name="firstname" value="{{ old('firstname') }}" />

        @error('firstname')
        <div>
            {{ $message }}
        </div>
        @enderror
    </div>

    <div>
        <label>Email</label>
        <input name="email" value="{{ old('email') }}" />

        @error('email')
        <div>
            {{ $message }}
        </div>
        @enderror
    </div>

    <div>
        <label>Mot de passe</label>
        <input type="password" name="password" />

        @error('password')
        <div>
            {{ $message }}
        </div>
        @enderror
    </div>

    <div>
        <label>Confirmation du mot de passe</label>
        <input type="password" name="password_confirmation" />

        @error('password')
        <div>
            {{ $message }}
        </div>
        @enderror
    </div>

    <button>Créer son compte</button>
</form>
@endsection