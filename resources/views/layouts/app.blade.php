<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>@yield('title', 'Default Title')</title>

    <!-- Bootstrap CSS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <!-- Global Styles -->
    <!-- Css for login/register -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> 

    <link href="{{ asset('css/myWeb.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    

    @stack('styles')
    <script src="{{ asset('js/custom.js') }}"></script>
</head>
<body>
    <div id="app">
        <!-- Navigation Bar -->
        @unless(request()->is('admin/*', 'user/*'))
            @include('navigationbar')
        @endunless
        <!-- Page Content -->
        <main>
            @yield('content')
        </main>

        <!-- Footer -->
        @include('footer')
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @stack('scripts')
</body>
</html>
