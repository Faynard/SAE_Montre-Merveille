@extends('layouts.default')

@section('content')

<form action="{{ route("user.login") }}" method="post">
    @csrf
    <div>
        <label for="email">Email</label>
        <input type="email" name="email" id="email">
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
    </div>
    <div>
        <button type="submit">Login</button>
    </div>
    @error('email')
        <div>
            {{ $message }}
        </div>
    @enderror
</form>

@endsection
