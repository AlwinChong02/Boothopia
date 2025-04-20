@extends('layouts.dash')
@section('content')
<body>
    <div class="dashboard-container">
        <div class="dashboard-header">
            <h2>Organiser Dashboard</h2>
            <p>Overview of your events</p>
        </div>

        <div class="row g-3">
            <div class="col-md-3">
                <div class="stats-card position-relative">
                    <h4>Total Events</h4>
                    <p>
                        <a href="{{ route('organiser.events.all') }}"
                            class="stretched-link text-decoration-none text-dark">
                            {{ $totalEvents }}
                        </a>
                    </p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card position-relative">
                    <h4>Upcoming</h4>
                    <p>
                        <a href="{{ route('organiser.events.upcoming') }}"
                            class="stretched-link text-decoration-none text-dark">
                            {{ $upcomingEvents }}
                        </a>
                    </p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card position-relative">
                    <h4>Ongoing</h4>
                    <p>
                        <a href="{{ route('organiser.events.ongoing') }}"
                            class="stretched-link text-decoration-none text-dark">
                            {{ $ongoingEvents }}
                        </a>
                    </p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card position-relative">
                    <h4>Canceled</h4>
                    <p>
                        <a href="{{ route('organiser.events.canceled') }}"
                            class="stretched-link text-decoration-none text-dark">
                            {{ $canceledEvents }}
                        </a>
                    </p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card position-relative">
                    <h4>Pending Approval</h4>
                    <p>
                        <a href="{{ route('organiser.approval') }}"
                            class="stretched-link text-decoration-none text-dark">
                            {{ $unlistedEvents }}
                        </a>
                    </p>
                </div>
            </div>
        </div>

        <div class="latest-events">
            <h3>Latest Events</h3>
            @if($latestEvents->isEmpty())
            <p>No recent events found.</p>
            @else
            @foreach ($latestEvents as $event)
            <div class="event-item">
                <h5>{{ $event->name }}</h5>
                <p>
                    <strong>Status:</strong> {{ ucfirst($event->status) }}<br>
                    <strong>Date:</strong> {{ $event->start_date }} to {{ $event->end_date }}
                </p>
                <a href="{{ route('events.booking', $event->id) }}" class="btn btn-sm btn-primary">View Details</a>
                    {{-- cancel event feature for organsier --}}
    @php
    $daysUntilStart = \Carbon\Carbon::today()
    ->diffInDays(\Carbon\Carbon::parse($event->start_date));
  @endphp

  @if(Auth::id() === $event->user_id)
    @if($daysUntilStart >= 7 && $event->status !== 'canceled')
    <form action="{{ route('events.cancel', ['event' => $event->id]) }}" method="POST"
    onsubmit="return confirm('Really cancel this event?');" class="mb-4">
      @csrf
      <button type="submit" class="btn btn-danger">Cancel Event</button>
    </form>

    @elseif($event->status !== 'canceled')
    <div class="alert alert-warning mb-4">
    You can only cancel 7 or more days before the event start date.
    </div>
    @endif
  @endif
            </div>
            @endforeach
            @endif
        </div>
    </div>

    <div class="footer">
        @include('footer')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZl2nKp1spnkV01xJ8pR3tv9eVwA5PizL8WvC3Kpg5S6sOlNq9jk5kN" crossorigin="anonymous"></script>
</body>
@endsection