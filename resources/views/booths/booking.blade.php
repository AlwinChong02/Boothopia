<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
</head>

<body>
    <div class="container mt-5">
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h2>{{ $event->name }}</h2>
            </div>
            <div class="card-body">
                @if($event->img)
                    <img src="{{ $event->img }}" alt="{{ $event->name }}" class="img-fluid mb-3">
                @endif
                <p><strong>Date:</strong> {{ $event->start_date }} to {{ $event->end_date }}</p>
                <p><strong>Location:</strong> {{ $event->location }}</p>
                <p><strong>Description:</strong> {{ $event->description }}</p>
            </div>
        </div>
        <form action="{{ route('events.booking.process', ['event' => $event->id]) }}" method="POST">
            @csrf
            <h4>Select Booth(s) to Book</h4>
            @if($booths->isEmpty())
                <div class="alert alert-warning">No booths available for this event.</div>
            @else
                <div class="row">
                    @foreach($booths as $booth)
                        <div class="col-md-4 mb-3">
                            <div class="card h-100">
                                @if($booth->img)
                                    <img src="{{ $booth->img }}" class="card-img-top" alt="{{ $booth->name }}">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $booth->name }}</h5>
                                    <p class="card-text">{{ $booth->description }}</p>
                                    <p><strong>Location:</strong> {{ $booth->location }}</p>
                                    <p><strong>Price:</strong> ${{ number_format($booth->price, 2) }}</p>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="booths[]" value="{{ $booth->id }}"
                                            id="booth{{ $booth->id }}">
                                        <label class="form-check-label" for="booth{{ $booth->id }}">Select</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-4 text-end">
                    <button type="submit" class="btn btn-success">Next</button>
                </div>
            @endif
        </form>
        @if($errors->any())
            <div class="alert alert-danger mt-3">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</body>