@extends('layouts.app')

@section('title', 'User Profile')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-5">
            <div class="card">
                <div class="card-header">User Profile</div>

                <div class="card-body">
                    <form action="#" method="POST">
                        @csrf

                        @can('isAdmin')
                        <div class="row mb-3">
                            <label for="user-id" class="col-md-4 col-form-label text-md-end">User ID: </label>

                            <div class="col-md-6">
                                <input id="user-id" type="text" class="form-control" 
                                       value="{{ $user->id }}" disabled>
                            </div>
                        </div>
                        @endcan

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Name: </label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" 
                                       value="{{ $user->name }}" disabled>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Email Address: </label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" 
                                       value="{{ $user->email }}" disabled>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="phone" class="col-md-4 col-form-label text-md-end">Phone: </label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control" 
                                       value="{{ $user->phone }}" disabled>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="role" class="col-md-4 col-form-label text-md-end">Role: </label>

                            <div class="col-md-6">
                                <select id="role" class="form-control" disabled>
                                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="organiser" {{ $user->role == 'organiser' ? 'selected' : '' }}>Organiser</option>
                                    <option value="requester" {{ $user->role == 'requester' ? 'selected' : '' }}>Requester</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-12 text-center mt-4">
                                <a href="{{ route('user.updateForm', ['id' => $user->id]) }}" class="btn btn-secondary">
                                    Edit
                                </a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
