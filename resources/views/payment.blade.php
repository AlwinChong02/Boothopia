
<div class="container mt-5">
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h2>Payment for: {{ $event->name }}</h2>
        </div>
        <div class="card-body">
            <p><strong>Date:</strong> {{ $event->start_date }} to {{ $event->end_date }}</p>
            <p><strong>Location:</strong> {{ $event->location }}</p>
            <p><strong>Description:</strong> {{ $event->description }}</p>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header bg-secondary text-white">
            <h4>Selected Booth(s)</h4>
        </div>
        <div class="card-body">
            @if($booths->isEmpty())
                <div class="alert alert-warning">No booths selected.</div>
            @else
                <ul class="list-group">
                    @foreach($booths as $booth)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ $booth->name }}</strong> <br>
                                <span>{{ $booth->location }}</span>
                            </div>
                            <span class="badge bg-success">${{ number_format($booth->price, 2) }}</span>
                        </li>
                    @endforeach
                </ul>
                <div class="mt-3 text-end">
                    <h5>Total: ${{ number_format($booths->sum('price'), 2) }}</h5>
                </div>
            @endif
        </div>
    </div>
    {{-- Payment form or button can be added here --}}
    <div class="text-end">
        <a href="/" class="btn btn-secondary">Cancel</a>
        <button class="btn btn-primary" disabled>Proceed to Payment (Demo)</button>
    </div>
</div>
    
    
    