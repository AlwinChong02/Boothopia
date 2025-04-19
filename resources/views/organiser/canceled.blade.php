@extends('layouts.dash')
@include('navigationbar')

<body>
  <div class="dashboard-container">
    <div class="dashboard-header">
      <h2>Canceled Events</h2>
      <p>Events you’ve canceled or that were rejected.</p>
    </div>

    @if($events->isEmpty())
      <p>No canceled events.</p>
    @else
      @foreach($events as $event)
        <div class="event-item mb-3 p-3 border rounded">
          <h5>{{ $event->name }}</h5>
          <p>
            <strong>Originally Scheduled:</strong> 
              {{ \Carbon\Carbon::parse($event->start_date)->format('M j, Y') }}
              —
              {{ \Carbon\Carbon::parse($event->end_date)->format('M j, Y') }}
          </p>
          <a href="{{ route('events.show', $event->id) }}"
             class="btn btn-sm btn-secondary">
            Details
          </a>
        </div>
      @endforeach
    @endif
  </div>

  <div class="footer">
    @include('footer')
  </div>
</body>
