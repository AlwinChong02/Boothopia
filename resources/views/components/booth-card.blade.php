<div class="border rounded shadow-md p-4">
    <div class="flex items-center justify-between mb-2">
        <h2 class="text-xl font-semibold">{{ $name }}</h2>
    </div>

    <p class="mb-2"><strong>Description:</strong> {{ $description ?? 'No description available' }}</p>

    <div class="flex items-center justify-between">
        <div>
            <span class="text-gray-500">${{ number_format($price, 2) }}</span>
        </div>
    </div>
    <div class="mt-2">
        @if($isAvailable)
            <input type="checkbox" class="form-check-input" id="booth{{ $name }}" name="booths[]" value="{{ $name }}">
            <label class="form-check-label" for="booth{{ $name }}">Select</label>
        @else
            <span class="text-danger">Unavailable</span>
        @endif

    </div>
</div>