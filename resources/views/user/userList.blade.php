@extends('layouts.app')

@section('title', 'User List')

@section('content')
@if(session('success'))
    <x-notification type="success" :message="session('success')" />
@endif

@if(session('error'))
    <x-notification type="error" :message="session('error')" />
@endif

@can('isAdmin')
<div class="d-flex">
    {{-- Sidebar --}}
    @include('layouts.sidenav')

    {{-- Main Content --}}
    <x-table 
        title="User List"
        :headers="['ID', 'Name', 'Email', 'Phone', 'Role', 'Created At', 'Update', 'Delete']"
        :route="route('userList')"
        :paginator="$users"
    >
        {{-- Optional slot for table body rows --}}
        @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone ?? 'N/A' }}</td>
                <td>{{ ucfirst($user->role) }}</td>
                <td>{{ $user->created_at->format('Y-m-d') }}</td>
            @can('update', $user)
                <td>
                    <form action="{{ route('user.updateForm', ['id' => $user->id]) }}" method="GET">
                        <button class="btn btn-primary btn-sm">Update</button>
                    </form>
                </td>  
            @endcan
            @can('delete', $user)
                <td>
                    <form action="{{ route('user.delete', ['id' => $user->id]) }}" method="GET" onsubmit="return confirm('Are you sure you want to delete this user?');">
                        @csrf
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            @endcan
            </tr>
        @endforeach
    </x-table>
</div>
@endcan
@endsection
