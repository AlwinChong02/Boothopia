<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Organiser Dashboard</title>
    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('css/myWeb.css') }}">
    <!-- Bootstrap CSS (using Bootstrap 5) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" 
          integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Inline CSS for Dashboard -->
    <style>
        .dashboard-container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
        }
        .dashboard-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .stats-card {
            padding: 20px;
            background: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 8px;
            text-align: center;
        }
        .stats-card h4 {
            margin-bottom: 10px;
        }
        .stats-card p {
            font-size: 24px;
            font-weight: bold;
            margin: 0;
        }
        .latest-events {
            margin-top: 40px;
        }
        .event-item {
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background: #fff;
            margin-bottom: 15px;
        }
        .event-item h5 {
            margin: 0 0 5px;
        }
    </style>
</head>
<header class="top-nav">
    <a href="/home">
        <img src="/img/boothopiaLogo.png" alt="Boothopia Logo" class="logo" width="150" height="90">
    </a>
    @include('navigationbar')
</header>
<body>
    <div class="dashboard-container">
        <div class="dashboard-header">
            <h2>Organiser Dashboard</h2>
            <p>Overview of your events</p>
        </div>

        <!-- Statistics Row -->
        <div class="row g-3">
            <div class="col-md-3">
                <div class="stats-card">
                    <h4>Total Events</h4>
                    <p>{{ $totalEvents }}</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <h4>Upcoming</h4>
                    <p>{{ $upcomingEvents }}</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <h4>Ongoing</h4>
                    <p>{{ $ongoingEvents }}</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <h4>Canceled</h4>
                    <p>{{ $canceledEvents }}</p>
                </div>
            </div>
        </div>

        <!-- Additional Stats Row (if needed) -->
        <div class="row g-3 mt-4">
            <div class="col-md-3">
                <div class="stats-card">
                    <h4>Pending Approval</h4>
                    <p>{{ $unlistedEvents }}</p>
                </div>
            </div>
        </div>

        <!-- Latest Events Section -->
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
                        <!-- Optionally link to the event profile page -->
                        <a href="{{ route('organiser.event.show', $event->id) }}" class="btn btn-sm btn-primary">View Details</a>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <div class="footer">
        @include('footer')
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-b5kHyXgcpbZl2nKp1spnkV01xJ8pR3tv9eVwA5PizL8WvC3Kpg5S6sOlNq9jk5kN" crossorigin="anonymous"></script>
</body>
</html>
