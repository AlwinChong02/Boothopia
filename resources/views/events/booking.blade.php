<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    <style>
        .booth-unavailable {
            opacity: 0.5;
            pointer-events: none;
        }
        .booth-card.selected {
            border: 2px solid #007bff !important;
            box-shadow: 0 0 8px #007bff33;
        }
    </style>
    @include('navigationbar')
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
                        {{-- display authenticated user(for testing purpose) --}}
                <p><strong>Authenticated User:</strong> {{ auth()->user()->name }}</p>
                
            </div>
        </div>
        <form id="boothForm" action="{{ route('events.booking.process', ['event' => $event->id]) }}" method="POST">
            @csrf
            <h4>Select Booth(s) to Book</h4>
            @if($booths->isEmpty())
                <div class="alert alert-warning">No booths available for this event.</div>
            @else
                <div class="row">
                    @foreach($booths as $booth)
                        @php $isAvailable = is_null($booth->user_id); @endphp
                        <div class="col-md-4 mb-3">
                            <div class="card h-100 booth-card {{ $isAvailable ? '' : 'booth-unavailable' }}">

                                <div class="card-body">
                                    <h5 class="card-title">{{ $booth->name }}</h5>
                                    <p class="card-text">{{ $booth->description }}</p>

                                    <p><strong>Price:</strong> ${{ number_format($booth->price, 2) }}</p>
                                    <div class="form-check">
                                        <input class="form-check-input booth-checkbox" type="checkbox" name="booths[]" value="{{ $booth->id }}"
                                            id="booth{{ $booth->id }}" {{ $isAvailable ? '' : 'disabled' }}>
                                        <label class="form-check-label" for="booth{{ $booth->id }}">
                                            {{ $isAvailable ? 'Select' : 'Unavailable' }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-4 text-end">
                    <button id="nextBtn" type="submit" class="btn btn-success" disabled>Next</button>
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
    <script>
        // Highlight selected booths and enable Next button only if at least one is selected
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.booth-checkbox');
            const nextBtn = document.getElementById('nextBtn');
            checkboxes.forEach(cb => {
                cb.addEventListener('change', function() {
                    const card = this.closest('.booth-card');
                    if (this.checked) {
                        card.classList.add('selected');
                    } else {
                        card.classList.remove('selected');
                    }
                    // Enable Next button if at least one is checked
                    nextBtn.disabled = document.querySelectorAll('.booth-checkbox:checked').length === 0;
                });
            });
        });
    </script>
</body>