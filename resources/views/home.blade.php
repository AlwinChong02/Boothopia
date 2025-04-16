@extends('layouts.app') 

@section('title', 'Home Page') 

@if(session('success'))
    <x-notification type="success" :message="session('success')" />
@endif

@if(session('error'))
    <x-notification type="error" :message="session('error')" />
@endif

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
            @include('searchBar.index') 
        </div>
    </section>
@endsection