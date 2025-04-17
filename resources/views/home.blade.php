@extends('layouts.app')

@section('title', 'Home Page')

@section('content')
    <button onclick="scrollToTop()">Back to Top</button>
    <video class="search-video" autoplay loop muted width="1600" height="1500">
        <source src="/video/roadshow.mp4" type="video/mp4">
    </video>
    <section class="search-section">
        <div class="search-bar">
            <div class="search-background">
                <img src="/img/searchBackground.png" alt="Booking" class="search-background" width="1521" height="750">
            </div>
            @include('searchBar.partials.search')
        </div>
    </section>
@endsection
