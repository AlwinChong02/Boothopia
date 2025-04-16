@extends('layouts.app')
@section('title', 'Booth Booking')

@section('content')

<div>
    Hello World
</div>

    {{-- <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h2>{{ $booth->name }}</h2>
            </div>
            <div class="card-body">
                @if($booth->img)
                    <img src="{{ $booth->img }}" alt="{{ $booth->name }}" class="img-fluid mb-3">
                @endif
                <p><strong>Location:</strong> {{ $booth->location }}</p>
                <p><strong>Description:</strong> {{ $booth->description ?? 'No description available' }}</p>
                <p><strong>Price:</strong> ${{ number_format($booth->price, 2) }}</p>
            </div>
            <div class="card-footer text-center">
                <form action="{{ route('booths.book', ['id' => $booth->id]) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">Book This Booth</button>
                </form>
            </div>
        </div>
    </div> --}}
@endsection