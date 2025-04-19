@extends('layouts.dash')
@include('navigationbar')

<body>
  <div class="dashboard-container">
    <div class="dashboard-header">
      <h2>Upcoming Events</h2>
      <p>All events you have scheduled that haven’t started yet.</p>
    </div>

    @if($events->isEmpty())
      <p>No upcoming events found.</p>
    @else
      @foreach($events as $event)
        <div class="event-item mb-3 p-3 border rounded">
          <h5>{{ $event->name }}</h5>
          <p>
            <strong>Date:</strong> 
              {{ \Carbon\Carbon::parse($event->start_date)->format('M j, Y') }}
              —
              {{ \Carbon\Carbon::parse($event->end_date)->format('M j, Y') }}
            <br>
            <strong>Booths:</strong> {{ $event->booths()->count() }}
          </p>
          <a href="{{ route('events.booking', $event->id) }}"
             class="btn btn-sm btn-primary">
            View Booking
          </a>
        </div>
      @endforeach
    @endif
  </div>

  <div class="footer">
    @include('footer')
  </div>
</body>
