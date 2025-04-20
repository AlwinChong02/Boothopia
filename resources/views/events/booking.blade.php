<head>

  <style>
    .booth-unavailable {
      opacity: .5;
      pointer-events: none;
      border: 1px solid #dc3545 !important; 
    }
    .card.booth-card.selected {
      border: 2px solid #007bff !important;
      box-shadow: 0 0 12px #007bff66 !important;
      z-index: 2;
    }
  </style>
  
</head>


{{-- @include('navigationbar') --}}
@extends('layouts.app')
@section('title', $event->name)

@section('content')
  <div class="container mt-5">
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif
    @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
  @endif

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

    {{-- event details --}}
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

    {{-- booth booking form --}}
    <form id="boothForm" action="{{ route('events.booking.process', ['event' => $event->id]) }}" method="POST">
    @csrf
    <h4>Select Booth(s) to Book</h4>

    @if($booths->isEmpty())
    <div class="alert alert-warning">No booths available for this event.</div>

  @else
  <div class="row">
    @foreach($booths as $booth)
    @php $isAvailable = is_null($booth->user_id) && $booth->status !== 'booked'; @endphp
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
    document.addEventListener('DOMContentLoaded', function() {
      const checkboxes = document.querySelectorAll('.booth-checkbox');
      const nextBtn    = document.getElementById('nextBtn');
      checkboxes.forEach(cb => {
        cb.addEventListener('change', function() {
          const card = this.closest('.booth-card');
          if (this.checked) {
            card.classList.add('selected');
          } else {
            card.classList.remove('selected');
          }
          nextBtn.disabled = document.querySelectorAll('.booth-checkbox:checked').length === 0;
        });
        // Initial state for pre-checked (if any)
        if (cb.checked) {
          cb.closest('.booth-card').classList.add('selected');
        }
      });
    });
  </script>
@endsection