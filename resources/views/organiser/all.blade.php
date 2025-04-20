@extends('layouts.app')

@section('content')
  @if($events->isEmpty())
    <div class="alert alert-warning">No events found.</div>
  @else
    <div class="container mt-4">
      <div class="row">
        @foreach ($events as $event)
            <div class="col-md-6 col-lg-4 mb-4">
              <a href="{{ route('events.booking', $event->id) }}"
                 class="text-decoration-none text-dark">
                <x-event-card :event="$event" />
              </a>
            </div>
        @endforeach
      </div>
    </div>
  @endif
  @endsection
