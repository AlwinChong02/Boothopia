@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="d-flex">
    {{-- Sidebar --}}
    @include('layouts.sidenav')

    {{-- Main content area --}}
    <div class="flex-grow-1 p-4">
        <h1>Welcome to, {{ Auth::user()->name }}</h1>
        <p>Your email is {{ Auth::user()->email }}.</p>

        <!-- Add your admin dashboard content here -->
    </div>
</div>
@endsection
