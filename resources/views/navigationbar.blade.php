<nav class="navbar navbar-expand-md navbar-light custom-navbar shadow-sm">
    <div class="container">
        <a class="d-flex align-items-center" href="{{ url('/home') }}">
            <img src="/img/boothopiaLogo.png" alt="Booking" width="150" height="85" class="me-2">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="/about">About</a></li>
                <li class="nav-item"><a class="nav-link" href="/contact">Contact</a></li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Guest (Unauthenticated) Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    @endif
                @else
                    <!-- Role-based Dashboard Links -->
                    @can('isAdmin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
                        </li>
                    @endcan
                    @can('isOrganiser')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('organiser.dashboard') }}">Organiser Dashboard</a>
                        </li>
                    @endcan
                    @can('isRequester')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('requester.dashboard') }}">Requester Dashboard</a>
                        </li>
                        <li>
                            <a class="nav-link" href="{{ route('events.index') }}">Booth</a>
                        </li>
                    @endcan
                    
                    <!-- User's Name and Logout Dropdown -->
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
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
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
