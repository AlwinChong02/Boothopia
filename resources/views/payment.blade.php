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
    <form method="POST" action="{{ route('booking.payment') }}" id="paymentForm">
        @csrf
        <div class="mb-3">
            <label for="payment_method" class="form-label">Select Payment Method</label>
            <select class="form-select" id="payment_method" name="payment_method" required>
                <option value="">Choose...</option>
                <option value="online_banking">Online Banking</option>
                <option value="card">Card</option>
            </select>
        </div>
        <div id="online_banking_fields" style="display:none;">
            <div class="mb-3">
                <label for="bank_name" class="form-label">Bank Name</label>
                <input type="text" class="form-control" name="bank_name" id="bank_name">
            </div>
            <div class="mb-3">
                <label for="bank_account" class="form-label">Bank Account Number</label>
                <input type="text" class="form-control" name="bank_account" id="bank_account">
            </div>
        </div>
        <div id="card_fields" style="display:none;">
            <div class="mb-3">
                <label for="card_number" class="form-label">Card Number</label>
                <input type="text" class="form-control" name="card_number" id="card_number">
            </div>
            <div class="mb-3">
                <label for="card_expiry" class="form-label">Expiry Date</label>
                <input type="text" class="form-control" name="card_expiry" id="card_expiry" placeholder="MM/YY">
            </div>
            <div class="mb-3">
                <label for="card_cvc" class="form-label">CVC</label>
                <input type="text" class="form-control" name="card_cvc" id="card_cvc">
            </div>
        </div>
        <button type="submit" class="btn btn-success">Pay & Book</button>
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
    document.getElementById('payment_method').addEventListener('change', function() {
        document.getElementById('online_banking_fields').style.display = this.value === 'online_banking' ? 'block' : 'none';
        document.getElementById('card_fields').style.display = this.value === 'card' ? 'block' : 'none';
    });
</script>
@endsection


