@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <a href="{{ url()->previous() }}" class="btn btn-secondary mb-3">&larr; Back to Events</a>
        <h2>{{ $event->name }}</h2>
        <p>{{ $event->description }}</p>
        <p><strong>Status:</strong> {{ $event->status }}</p>
        <p><strong>Location:</strong> {{ $event->location }}</p>
        <p><strong>Category:</strong> {{ $event->category }}</p>
        <p><strong>Start:</strong> {{ $event->start_date }} {{ $event->start_time }}</p>
        <p><strong>End:</strong> {{ $event->end_date }} {{ $event->end_time }}</p>
        <hr>
        <h4>Booths</h4>

        @if($event->booths->isEmpty())
            <div class="alert alert-warning">No booths available for this event.</div>
        @else
            <div class="row">
                @foreach($event->booths as $booth)
                    <div class="col-md-4 mb-3">
                        <x-booth-card 
                            :id="$booth->id" 
                            :name="$booth->name" 
                            :description="$booth->description"
                            :location="$booth->location" 
                            :img="$booth->img" 
                            :price="$booth->price" 
                            :event_id="$booth->event_id"
                            :user_id="$booth->user_id" 
                            />
                            
                        {{-- @if($booth->user_id)
                            <span class="badge bg-danger">Booked</span>
                        @else
                            <span class="badge bg-green">Available</span>
                        @endif --}}
                    </div>
                @endforeach

                <div class="col-md-12 text-end mt-3">
                    <a href="{{ route('events.booking', $event->id) }}" class="btn btn-primary">Book a Booth</a>

                </div>
            </div>
        @endif
    </div>
@endsection