@extends('layouts.app')

@section('title', 'Create Event')

@section('content')
<div class="container create-event-container my-5">
  <div class="card shadow-sm">
    <div class="card-body">
      <h2 class="card-title mb-4">Create a New Event</h2>

      @if ($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      @if (session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
      @endif

      <form action="{{ route('organiser.event.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row g-3">
          {{-- Event Name --}}
          <div class="col-md-6">
            <label for="name" class="form-label">Event Name</label>
            <input type="text" id="name" name="name"
                   class="form-control" placeholder="Enter event name">
          </div>

          {{-- Booth Quantity --}}
          <div class="col-md-6">
            <label for="booth_quantity" class="form-label">Booth Quantity</label>
            <input type="number" id="booth_quantity" name="booth_quantity"
                   class="form-control" placeholder="Enter number of booths">
          </div>

          {{-- Dates --}}
          <div class="col-md-6">
            <label for="start_date" class="form-label">Start Date</label>
            <input type="date" id="start_date" name="start_date"
                   class="form-control">
          </div>
          <div class="col-md-6">
            <label for="end_date" class="form-label">End Date</label>
            <input type="date" id="end_date" name="end_date"
                   class="form-control">
          </div>

          {{-- Times --}}
          <div class="col-md-6">
            <label for="start_time" class="form-label">Start Time</label>
            <input type="time" id="start_time" name="start_time"
                   class="form-control">
          </div>
          <div class="col-md-6">
            <label for="end_time" class="form-label">End Time</label>
            <input type="time" id="end_time" name="end_time"
                   class="form-control">
          </div>

          {{-- Location & Category --}}
          <div class="col-md-6">
            <label for="location" class="form-label">Location</label>
            <input type="text" id="location" name="location"
                   class="form-control" placeholder="Enter event location">
          </div>
          <div class="col-md-6">
            <label for="category" class="form-label">Category</label>
            <input type="text" id="category" name="category"
                   class="form-control" placeholder="Enter event category">
          </div>

          {{-- Description --}}
          <div class="col-12">
            <label for="description" class="form-label">Description</label>
            <textarea id="description" name="description"
                      class="form-control" rows="3"
                      placeholder="Enter event description"></textarea>
          </div>

          {{-- Image Upload --}}
          <div class="col-12">
            <label for="img" class="form-label">Event Image</label>
            <input type="file" id="img" name="img"
                   class="form-control form-control-sm">
          </div>
        </div>

        <div class="mt-4 text-end">
          <button type="submit" class="btn btn-primary px-4">Create Event</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
