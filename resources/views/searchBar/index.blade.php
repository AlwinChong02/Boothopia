<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Your head markup: meta tags, title, CSS files, etc. -->
</head>
<body>
    @yield('content')

    <!-- Global scripts such as jQuery and Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Other global scripts -->

    <!-- Render any scripts pushed from partials -->
    @stack('scripts')
</body>
</html>
