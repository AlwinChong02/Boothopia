@extends('layouts.app')

@section('title', 'Booth Booking Approvals')

@section('content')

<body>
    <div class="d-flex justify-content-between align-items-center shadow-sm p-3 mb-4 bg-white rounded">
        <h4 class="mb-0">Organiser Dashboard</h4>
        <div class="dropdown">
            <a class="d-flex flex-column text-decoration-none dropdown-toggle" href="#" role="button" id="userDropdown"
                data-bs-toggle="dropdown" aria-expanded="false">
                <strong>{{ Auth::user()->name }}</strong>
                <small class="text-muted text-uppercase" style="font-size: 0.65rem; font-weight: 650">{{ Auth::user()->role }}</small>
            </a>

            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                <li>
                    <a class="dropdown-item" href="{{ route('profile') }}">
                        View Profile
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
    <div class="container approval-container mt-4">
        <h2>Approve or Reject Booth Bookings</h2>

        {{-- Success message --}}
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        {{-- No pending approvals --}}
        @if($approvals->isEmpty())
        <p>No pending booth bookings to approve.</p>
        @else
        @foreach ($approvals as $approval)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">
                    Event: {{ $approval->event->name ?? 'Unknown Event' }}
                </h5>
                <p class="card-text">
                    <strong>Requested by:</strong> {{ $approval->requester->name ?? 'N/A' }}<br>
                    <strong>Booths:</strong> {{ $approval->booth_quantity ?? '–' }}
                </p>
                <div class="d-flex">
                    <form action="{{ route('requester.approval.approve', $approval->id) }}" method="POST" class="me-2">
                        @csrf
                        <button type="submit" class="btn btn-success">Approve</button>
                    </form>
                    <form action="{{ route('requester.approval.reject', $approval->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">Reject</button>
                    </form>
                </div>
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
@endsection