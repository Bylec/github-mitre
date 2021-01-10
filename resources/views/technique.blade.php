@extends('app')
@section('content')
    <div class="row align-items-start">
        @include('tactics', ['tactics' => $tactics])
        <div class="col-9">
            <div class="container text-center">
                <h4>{{ $technique->name }}</h4>
                <div class="container">
                    {{ $technique->description }}
                </div>
            </div>
        </div>
    </div>
@endsection
