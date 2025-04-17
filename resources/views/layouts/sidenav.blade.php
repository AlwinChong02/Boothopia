<div class="side-nav" style="width: 240px; height: 100vh;">
    <a class="d-flex align-items-center" href="{{ url('/home') }}">
        <img src="/img/boothopiaLogo.png" alt="Booking" width="200" height="120" >
    </a>
    
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('userList')}}">User List</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Reports</a>
        </li>
        {{-- Add more admin links as needed --}}
    </ul>
</div>
