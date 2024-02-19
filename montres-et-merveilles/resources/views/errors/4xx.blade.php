@extends('layouts.default')

@section('content')
    <div class="px-12 md:px-26 lg:px-44 mt-20 mb-12">
        <h2> {{ $exception->getMessage() }} </h2>
        <h2> {{ $exception->getStatusCode() }} error </h2>
    </div>
@endsection