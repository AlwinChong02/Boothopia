<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Event Approval</title>
    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('css/myWeb.css') }}">
    <!-- Bootstrap CSS (Bootstrap 5) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" 
          integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Inline CSS for approval page -->
    <style>
        .approval-container {
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
        }
        .approval-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .event-card {
            border: 1px solid #ddd;
            background: #f9f9f9;
            border-radius: 4px;
            padding: 15px;
            margin-bottom: 15px;
        }
        .event-card h4 {
            margin-bottom: 10px;
        }
        .event-card p {
            margin-bottom: 10px;
        }
        .btn-approve {
            background-color: #28a745;
            color: white;
            border: none;
        }
        .btn-reject {
            background-color: #dc3545;
            color: white;
            border: none;
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
    <div class="approval-container">
        <h2>Approve or Reject Events</h2>

        <!-- Display success message -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- List pending events -->
        @if($events->isEmpty())
            <p>No pending events to approve.</p>
        @else
            @foreach ($events as $event)
                <div class="event-card">
                    <h4>{{ $event->name }}</h4>
                    <p>{{ $event->description }}</p>
                    <p>
                        <strong>Start:</strong> {{ $event->start_date }} at {{ $event->start_time }} <br>
                        <strong>End:</strong> {{ $event->end_date }} at {{ $event->end_time }}
                    </p>
                    <p>
                        <strong>Location:</strong> {{ $event->location }} <br>
                        <strong>Category:</strong> {{ $event->category }} <br>
                        <strong>Booth Quantity:</strong> {{ $event->booth_quantity }}
                    </p>
                    <div class="d-flex justify-content-between">
                        <!-- Approve form -->
                        <form action="{{ route('organiser.event.approve', $event->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-approve">Approve</button>
                        </form>
                        <!-- Reject form -->
                        <form action="{{ route('organiser.event.reject', $event->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-reject">Reject</button>
                        </form>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <div class="footer">
        @include('footer')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-b5kHyXgcpbZl2nKp1spnkV01xJ8pR3tv9eVwA5PizL8WvC3Kpg5S6sOlNq9jk5kN" crossorigin="anonymous"></script>
</body>
</html>
