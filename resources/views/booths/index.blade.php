<head><title>Contact Page</title><link rel="stylesheet" href="{{ asset('css/myWeb.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<header class="top-nav"><a href="/home">
    <img src="/img/boothopiaLogo.png" alt="Booking" class="logo" width="150" height="90"></a>
    @include('navigationbar')
</header>

<body>
{{-- display all events available in database --}}
@foreach ($booths as $booth)
    {{-- <div class="event-card">
        <h2>{{ $event->name }}</h2>
        <p><strong>Date:</strong> {{ $event->start_date }} to {{ $event->end_date }}</p>
        <p><strong>Location:</strong> {{ $event->location }}</p>
        <p><strong>Description:</strong> {{ $event->description }}</p>
        @if($event->img)
            <img src="{{ $event->img }}" alt="{{ $event->name }}" class="event-image">
        @endif
        <a href="{{ route('events.booking', ['event' => $event->id]) }}" class="btn btn-primary">Book Now</a>
    </div> --}}

    
    <x-boothCard 
        :id="$booth->id"
        :name="$booth->name" 
        :description="$booth->description" 
        :location="$booth->location" 
        :img="$booth->img" 
        :price="$booth->price" 
        :event_id="$booth->event_id"
    />

@endforeach
    
    {{-- if no booths available --}}
    @if($booths->isEmpty())
        <div class="alert alert-warning">No booths available for this event.</div>
    @endif

</body>

<div class="contact-footer">
    @include('footer')
</div>