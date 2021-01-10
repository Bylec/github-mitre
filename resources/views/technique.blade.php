@extends('app')
@section('content')
    <div class="col-9">
        <div class="container text-center">
            <h4>{{ $technique->name }}</h4>
            <div class="container">
                {{ $technique->description }}
            </div>
        </div>
    </div>
@endsection
