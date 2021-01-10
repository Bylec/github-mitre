<html>
<head>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    @stack('scripts')

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <form action="{{url('/technique/search')}}" method="POST" class="form-inline my-2 my-lg-0">
            @csrf
            <input name="technique_name" class="form-control mr-sm-2" type="search" placeholder="Search techniques" aria-label="Search">
            <button class="btn btn-outline-dark my-2 my-sm-0" type="submit">Search</button>
        </form>
    </nav>
    <div class="row align-items-start">
        @include('tactics', ['tactics' => $tactics])
        @yield('content')
    </div>
</div>
</body>
</html>
