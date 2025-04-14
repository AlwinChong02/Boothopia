<div class="">
    <h2>{{ $name }}</h2>
    @if($img)
        <img src="{{ $img }}" alt="{{ $name }}" class="">
    @endif
    <p><strong>Location:</strong> {{ $location ?? 'Unspecified' }}</p>
    <p><strong>Description:</strong> {{ $description ?? 'No description available' }}</p>
    <p><strong>Price:</strong> ${{ number_format($price, 2) }}</p>
</div>