<div class="card mb-3" style="max-width: 540px;">
  <div class="row g-0">
    @if($event->img)
    <div class="col-md-4">
    <img src="{{ asset('storage/' . ltrim($event->img, '/')) }}" alt="Event Image" class="img-fluid">
    </div>
    @endif
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title">{{ $event->name }}</h5>
        <p class="card-text">{{ $event->description }}</p>
        <ul class="list-unstyled">
          <li><strong>Status:</strong> {{ $event->status }}</li>
          <li><strong>Category:</strong> {{ $event->category }}</li>
          <li><strong>Location:</strong> {{ $event->location }}</li>
          <li><strong>Start:</strong> {{ $event->start_date }} {{ $event->start_time }}</li>
          <li><strong>End:</strong> {{ $event->end_date }} {{ $event->end_time }}</li>
          <li><strong>Booth Quantity:</strong> {{ $event->booth_quantity }}</li>
        </ul>
        <p class="card-text"><small class="text-muted">Created by User ID: {{ $event->user_id }}</small></p>
      </div>
    </div>
  </div>
</div>