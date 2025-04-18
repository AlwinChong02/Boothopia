<ul class="list-unstyled w-100">
    @forelse ($results as $post)
    <li><a href="#" class="post-link" data-id="{{ $post->id }}">{{ $post->name }}</a></li>
    @empty
    <li><a href="#" data-id="0">Sorry, there's no events with your search "{{ $search }}"</a></li>
    @endforelse
</ul>