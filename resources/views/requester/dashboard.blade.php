@extends('layouts.app')

@section('title', 'Requester Dashboard')

@section('content')

    <h2 class="mt-4">Your Booth Approval Status</h2>
    @if($approvals->isEmpty())
        <div class="alert alert-info">You have no booth approval requests.</div>
    @else
        <table class="table table-bordered mt-3 ml-2 mr-2">
            <thead>
                <tr>
                    <th>Event</th>
                    <th>Booth Quantity</th>
                    <th>Status</th>
                    <th>Reviewed At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($approvals as $approval)
                    <tr>
                        <td>{{ $approval->event->name ?? 'N/A' }}</td>
                        <td>{{ $approval->booth_quantity }}</td>
                        <td>{{ ucfirst($approval->status) }}</td>
                        <td>{{ $approval->reviewed_at ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection