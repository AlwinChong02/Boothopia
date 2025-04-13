<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Event Profile - {{ $event->name }}</title>
    <link rel="stylesheet" href="{{ asset('css/myWeb.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" 
          integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <style>
        .profile-container {
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
        }
        .event-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .event-details {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            background: #f9f9f9;
        }
        .event-details img {
            max-width: 100%;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .booths-container {
            margin-top: 30px;
        }
        .booth-card {
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
            background: #fff;
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
    <div class="container profile-container">
        <div class="event-header">
            <h2>{{ $event->name }}</h2>
            <p>Status: <strong>{{ ucfirst($event->status) }}</strong></p>
        </div>
        <div class="event-details">
            @if($event->img)
                <img src="{{ asset('storage/' . $event->img) }}" alt="Event Image">
            @endif
            <p><strong>Description:</strong></p>
            <p>{{ $event->description }}</p>
            <p>
                <strong>Dates:</strong> {{ $event->start_date }} to {{ $event->end_date }}<br>
                <strong>Times:</strong> From {{ $event->start_time }} to {{ $event->end_time }}<br>
                <strong>Location:</strong> {{ $event->location }}<br>
                <strong>Category:</strong> {{ $event->category }}<br>
                <strong>Booth Quantity:</strong> {{ $event->booth_quantity }}
            </p>
        </div>

        <div class="booths-container">
            <h3>Booth Details</h3>
            @if($event->booths->isEmpty())
                <p>No booths available for this event.</p>
            @else
                @foreach ($event->booths as $booth)
                    <div class="booth-card">
                        <p><strong>{{ $booth->name }}</strong></p>
                        @if($booth->img)
                            <img src="{{ asset('storage/' . $booth->img) }}" alt="Booth Image" style="max-height:150px;">
                        @endif
                        <p>Price: ${{ number_format($booth->price, 2) }}</p>
                        @if($booth->description)
                            <p>{{ $booth->description }}</p>
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
</html>
