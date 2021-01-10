@extends('app')
@push('scripts')
    <script>
        $(document).ready(function ($) {
            $(".clickable-row").click(function () {
                window.location = $(this).data("href");
            });
        });
    </script>
@endpush
@section('content')
    <style>
        .clickable-row:hover {
            cursor: pointer;
            background: grey !important;
        }
    </style>
    <div class="row align-items-start">
        @include('tactics', ['tactics' => $tactics])
        <div class="col-9">
            <table class="table table-striped">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                </tr>
                <tbody>
                @foreach($techniques as $technique)
                    <tr class="clickable-row" data-href="{{url('/technique/' . $technique->id) }}">
                        <td>{{$technique->external_references[0]['external_id']}}</td>
                        <td>{{$technique->name}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
