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

    <video class="search-video" autoplay loop muted width="1100" height="1000">
        <source src="/video/roadshow.mp4" type="video/mp4">
    </video>


    <section class="search-section">
        <div class="search-bar">
            <div class="search-background">
                <img src="{{ asset('img/searchBackground.png') }}" class="search-img" alt="Booking"
                     class="search-background" width="1521" height="750">
            </div>
            @include('searchBar.partials.search')
        </div>
    </section>
@endsection
