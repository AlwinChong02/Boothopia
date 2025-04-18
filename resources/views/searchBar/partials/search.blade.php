{{-- resources/views/searchBar/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Search Events')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="search w-50">
        <h1 class="text-center mb-5">Search Events</h1>
        <form action="#" id="search-form">
            @csrf
            <div class="row">
                <div class="col-12" id="search-wrapper">
                    <input
                        type="text"
                        class="form-control w-100 m-0 search"
                        placeholder="What are you looking for …">
                    <div id="results"></div>
                </div>
            </div>
        </form>
        <div id="post" class="mt-5"></div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(function () {
        'use strict';

        $(document).on('keyup', '#search-form .search', function () {
            if (this.value.length > 0) {
                $.get("{{ route('searchBar.search') }}", { search: this.value }, res => {
                    $('#results').html(res);
                });
            } else {
                $('#results').empty();
            }
        });

        $(document).on('click', '.post-link', function () {
            window.location.href = "/events/" + $(this).data('id');
        });
    });
</script>
@endpush
