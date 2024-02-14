@extends('layouts.default')

@section('content')
<video autoplay muted loop>
    <source src="{{ asset('videos/accueil.mp4') }}" />
</video>
@endsection
