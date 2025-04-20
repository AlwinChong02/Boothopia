@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="d-flex flex-column">

    {{-- Body Content --}}
    <div class="d-flex">
        {{-- Sidebar --}}
        @include('layouts.sidenav')

        {{-- Main Dashboard --}}
        <div class="flex-grow-1 p-4">

            {{-- Top navbar inside content --}}
            <div class="d-flex justify-content-between align-items-center shadow-sm p-3 mb-4 bg-white rounded">
                <h4 class="mb-0">Admin Dashboard</h4>
                <div class="dropdown">
                    <a class="d-flex flex-column text-decoration-none dropdown-toggle" href="#" role="button" id="userDropdown"
                    data-bs-toggle="dropdown" aria-expanded="false">
                        <strong>{{ Auth::user()->name }}</strong>
                        <small class="text-muted text-uppercase" style="font-size: 0.65rem; font-weight: 650">{{ Auth::user()->role }}</small>
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <!-- View Profile -->
                        <a class="dropdown-item" href="{{ route('profile') }}">
                            <i class="fas fa-user me-2" style="padding-right: 10px"></i>View Profile
                        </a>

                        <!-- Logout -->
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                         document.getElementById('logout').submit();">
                            <i class="fas fa-sign-out-alt me-2" style="padding-right: 10px"></i>Logout
                        </a>
                        <form id="logout" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>

            {{-- Main Content Area --}}
            <div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <p>Here you can manage users, events, and other administrative tasks.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
