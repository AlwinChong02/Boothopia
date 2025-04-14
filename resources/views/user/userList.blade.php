@extends('layouts.app')

@section('title', 'User List')

@section('content')
@if(session('success'))
    <div class="position-fixed top-0 start-50 translate-middle-x p-3" style="z-index: 1050">
        <div class="toast align-items-center text-bg-success border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    {{ session('success') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
@endif

<div class="d-flex">
    {{-- Sidebar --}}
    @include('layouts.sidenav')

    {{-- Main Content --}}
    <div style="padding: 25px;"> 
        <h2 class="mb-4 pt-4">User List</h2>

        <div>
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Role</th>
                        <th>Created At</th>
                        <th>Update</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone ?? 'N/A' }}</td>
                            <td>{{ ucfirst($user->role) }}</td>
                            <td>{{ $user->created_at->format('Y-m-d') }}</td>
                            <td>
                                <form action="{{ route('user.updateForm', ['id' => $user ->id]) }}" method="GET">
                                    <button class="btn btn-primary">Update</button>
                                </form>
                            </td>  
                            <td>
                                <form action="{{ route('user.delete', ['id' => $user->id]) }}" method="GET" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                    @csrf
                                    <button class="btn btn-danger">Delete</button>
                                </form> 

                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>

<style>
    .w-5{ 
        display: none 
    } 
    
    .custom-table {
        width: 100%;
        table-layout: fixed;
        border-collapse: collapse;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .custom-table th, .custom-table td {
        padding: 14px 20px;
        text-align: left;
        border-bottom: 1px solid #eee;
    }

    .custom-table th {
        background-color: #0096C7;
        color: white;
    }

    .custom-table tr:hover {
        background-color: #f1f1f1;
    }

    .custom-table td {
        font-size: 14px;
        color: #333;
        word-wrap: break-word;
        white-space: normal;
    }

    h2 {
        color: #333;
    }

    .custom-table th:nth-child(1),
    .custom-table td:nth-child(1) {
        width: 58px; /* ID */
    }
</style>
@endsection
