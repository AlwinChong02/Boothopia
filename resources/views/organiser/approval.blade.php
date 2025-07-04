@extends('layouts.app')

@section('title', 'Booth Booking Approvals')

@section('content')

<body>
    <div class="container approval-container mt-4">
        <h2>Approve or Reject Booth Bookings</h2>

        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if($approvals->isEmpty())
        <p>No booth bookings to approve.</p>
        @else
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>Event</th>
                    <th>Requested by</th>
                    <th>Booth Quantity</th>
                    <th>Approval Image</th>

                    <th>Action</th>
                    <th>Status</th>
                    <th>Reviewed At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($approvals as $approval)
                <tr>
                    <td>{{ $approval->event->name ?? 'Unknown Event' }}</td>
                    <td>{{ $approval->requester->name ?? 'N/A' }}</td>
                    <td>{{ $approval->booth_quantity ?? '-' }}</td>
                    <td>
                        @if ($approval->approval_image)
                        <img src="{{ asset('storage/' . $approval->approval_image) }}" alt="Approval Image" width="100">
                        @else
                        No Image
                        @endif
                    </td>
                    
                    <td class="d-flex">
                        @if($approval->status === 'pending')
                        <form action="{{ route('organiser.approval.approve', $approval->id) }}" method="POST" class="me-2">
                            @csrf
                            <button type="submit" class="btn btn-success">Approve</button>
                        </form>
                        <form action="{{ route('organiser.approval.reject', $approval->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger">Reject</button>
                        </form>
                        @else
                        <button class="btn btn-secondary btn-sm me-2" disabled>Accept</button>
                        <button class="btn btn-secondary btn-sm" disabled>Reject</button>
                        @endif
                    </td>
                    <td>{{ ucfirst($approval->status) }}</td>
                    <td>{{ $approval->updated_at ?: 'N/A' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>

    <div class="footer">
        @include('footer')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZl2nKp1spnkV01xJ8pR3tv9eVwA5PizL8WvC3Kpg5S6sOlNq9jk5kN" crossorigin="anonymous"></script>
</body>
@endsection