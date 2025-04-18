@extends('layouts.app')

@section('title', 'Home Page')

@section('content')
    {{-- session alerts inside content --}}
    @if(session('success'))
        <x-notification type="success" :message="session('success')" />
    @endif

    @if(session('error'))
        <x-notification type="error" :message="session('error')" />
    @endif

    <button onclick="scrollToTop()">Back to Top</button>

    <video class="search-video" autoplay loop muted width="1600" height="1500">
        <source src="/video/roadshow.mp4" type="video/mp4">
    </video>

    <h1 style="font-size: 1000px;">HIt asdasdsad</h1>
    <section class="search-section">
        <div class="search-bar">
            <div class="search-background">
                <img src="{{ asset('img/searchBackground.png') }}" alt="Booking"
                     class="search-background" width="1521" height="750">
            </div>
            @include('searchBar.partials.search')
        </div>
    </section>
@endsection
