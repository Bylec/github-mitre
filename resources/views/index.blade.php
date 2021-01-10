@extends('app')
@section('content')
    <div class="row align-items-start">
        @include('tactics', ['tactics' => $tactics])
    </div>
@endsection
