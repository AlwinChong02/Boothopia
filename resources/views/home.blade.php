<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head><title>Home Page</title><link rel="stylesheet" href="{{ asset('css/myWeb.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <script src="{{ asset('js/custom.js') }}"></script>
    <header class="top-nav"><a href="/home">
        <img src="/img/boothopiaLogo.png" alt="Booking" class="logo" width="150" height="90"></a>
        @include('navigationbar')
    </header>
    <body>
    <button onclick="scrollToTop()">Back to Top</button>
        <video class="search-video" autoplay loop muted width="1600" height="1500"><source src="/video/roadshow.mp4" type="video/mp4"></video>
            <section class="search-section">
                <div class="search-bar">
                    <div class="search-background">
                        <img src="/img/searchBackground.png" alt="Booking" class="search-background" width="1521" height="750">
                    </div>
                    @include('searchBar.index')
                </div>
            </section>
    </body>
         @include('footer')
</html>

