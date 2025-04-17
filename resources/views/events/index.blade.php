<head><title>Contact Page</title><link rel="stylesheet" href="{{ asset('css/myWeb.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<header class="top-nav"><a href="/home">
    @include('navigationbar')
</header>

<body>
{{-- display all events available in database --}}
@if($events->isEmpty())
    <div class="alert alert-warning">No events found.</div>
@else
    <div class="container mt-4">
        <div class="row">
            @foreach ($events as $event)
                <div class="col-md-6 mb-4">
                    <a href="{{ route('events.booking', $event->id) }}" class="text-decoration-none text-dark">
                        <x-event-card :event="$event" />
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endif
</body>


@include('footer')
