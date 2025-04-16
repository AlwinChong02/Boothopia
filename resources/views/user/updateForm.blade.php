@extends('layouts.app')

@section('title', 'Update User Profile')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-5">
            <div class="card">
                <div class="card-header">Update User Profile</div>

                <div class="card-body">
                    <form action="{{ route('user.update', ['id' => $users->id]) }}" method="POST">
                        @csrf

                        <input type="hidden" name="redirect_to" value="{{ old('redirect_to', url()->previous()) }}">

                        @can('isAdmin')
                        <div class="row mb-3">
                            <label for="user-id" class="col-md-4 col-form-label text-md-end">User ID: </label>

                            <div class="col-md-6">
                                <div id="user-id" class="form-control-plaintext">
                                    {{ $users->id }}
                                </div>
                            </div>
                        </div>
                        @endcan

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Name: </label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                       name="name" value="{{ old('name', $users->name) }}"  autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Email Address: </label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                       name="email" value="{{ old('email', $users->email) }}" >

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="phone" class="col-md-4 col-form-label text-md-end">Phone: </label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror"
                                       name="phone" value="{{ old('phone', $users->phone) }}" >

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="role" class="col-md-4 col-form-label text-md-end">Role: </label>

                            <div class="col-md-6">
                                @can('isAdmin') <!-- Only allow editing the role for admins -->
                                    <select name="role" id="role" class="form-control @error('role') is-invalid @enderror">
                                        <option value="">-- Select Role --</option>
                                        <option value="admin" {{ old('role', $users->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="organiser" {{ old('role', $users->role) == 'organiser' ? 'selected' : '' }}>Organiser</option>
                                        <option value="requester" {{ old('role', $users->role) == 'requester' ? 'selected' : '' }}>Requester</option>
                                    </select>
                                @else
                                    <div class="form-control-plaintext">
                                        {{ ucfirst($users->role) }} <!-- Display the role as text for non-admins -->
                                    </div>
                                @endcan

                                @error('role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                       name="password" autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Update Profile
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
