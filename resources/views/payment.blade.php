@extends('layouts.app')
@section('content')
<div class="container mt-5">
    <h2>Payment for Event: {{ $event->name }}</h2>
    <div class="mb-3">
        <strong>Booths:</strong>
        <ul>
            @foreach($booths as $booth)
                <li>{{ $booth->name }} - ${{ number_format($booth->price, 2) }}</li>
            @endforeach
        </ul>
        <strong>Total: ${{ number_format($total, 2) }}</strong>
    </div>

    {{-- approval section (upload one image for organiser approval --}}
    <form method="POST" action="{{ route('payment.approval') }}" enctype="multipart/form-data" class="mt-4">
        @csrf
        <div class="mb-3">
            <label for="approval_image" class="form-label">Upload Approval Image</label>
            <input type="file" class="form-control" name="approval_image" id="approval_image" accept="image/*" required>

            {{-- hidden value for organiser id(users role is organiser), requester id, status-> pending --}}
            <input type="hidden" name="organiser_id" value="{{ $event->user_id }}">
            <input type="hidden" name="requester_id" value="{{ auth()->user()->id }}">
            <input type="hidden" name="status" value="pending">
        </div>
        <button type="submit" class="btn btn-primary">Upload Approval Image</button>
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
{{-- <script>
    document.getElementById('payment_method').addEventListener('change', function() {
        document.getElementById('online_banking_fields').style.display = this.value === 'online_banking' ? 'block' : 'none';
        document.getElementById('card_fields').style.display = this.value === 'card' ? 'block' : 'none';
    });
</script> --}}
@endsection


