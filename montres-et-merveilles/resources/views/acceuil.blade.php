@extends('layouts.default')

@section('content')
<div>
    acceuil page
    @auth
    <form action="{{ route("user.logout") }}" method="post">
        @csrf
        <button type="submit">Logout</button>
    </form>
    @endauth
</div>
@endsection