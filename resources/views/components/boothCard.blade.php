<div class="border rounded shadow-md p-4">
    <div class="flex items-center justify-between mb-2">
        <h2 class="text-xl font-semibold">{{ $name }}</h2>
    </div>

    @if($img)
        <img src="{{ $img }}" alt="{{ $name }}" class="w-full rounded mb-2">
    @endif

    <p><strong>Location:</strong> {{ $location ?? 'Unspecified' }}</p>
    <p class="mb-2"><strong>Description:</strong> {{ $description ?? 'No description available' }}</p>

    <div class="flex items-center justify-between">
        <div>
            <span class="text-gray-500 line-through">${{ number_format($price, 2) }}</span>
        </div>
        <a class="bg-blue-500 text-white px-4 py-2 rounded" href="{{ route('events.booking', ['event' => $eventId]) }}">
            Book Now
        </a>
        {{-- <x-available-btn :label="'Check Availability'" :url="" /> --}}
    </div>
</div>