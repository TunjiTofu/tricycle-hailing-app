<div class="sidebar close">
    <div class="logo-details">
        <a href="{{ route('admin.dashboard') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('backend/assets/images/logo-sm.png') }}" alt="logo-sm-light" height="80">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('backend/assets/images/logo-light.png') }}" alt="logo-light" height="100">
            </span>
        </a>

        <a href="{{ route('admin.dashboard') }}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('backend/assets/images/logo-sm.png') }}" alt="logo-sm-light" height="80">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('backend/assets/images/logo-light.png') }}" alt="logo-light" height="100">
            </span>
        </a>

    </div>

    <div class="logo-details">
        <i class='bx bx-menu'>

            {{-- <i class='bx bxl-bitcoin'></i> --}}
            <span class="logo_name">Menu</span>
        </i>

    </div>
    <ul class="nav-links">
        <li>
            <a href="{{ route('admin.dashboard') }}">
                <i class='bx bx-home'></i>
                <span class="link_name">Home</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="{{ route('admin.dashboard') }}">Home</a></li>
            </ul>
        </li>
        <li>
            <a href="{{ route('adminrider.index') }}">
                <i class='bx bx-user-pin'></i>
                <span class="link_name">Riders </span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="{{ route('adminrider.index') }}">Riders </a></li>
            </ul>
        </li>
        <li>
            <div class="icon-link">
                <a href="#">
                    <i class='bx bx-cycling'></i>
                    <span class="link_name">Kekes </span>
                </a>
                <i class='bx bxs-chevron-down arrow'></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name" href="#">Kekes </a></li>
                <li><a href="{{ route('keke.index') }}">View All Keke</a></li>
                <li><a href="{{ route('keke.transit') }}">Keke in Transit</a></li>
                <li><a href="{{ route('keke.orders.history') }}">Keke Orders</a></li>
            </ul>
        </li>
        <li>
            <div class="icon-link">
                <a href="#">
                    <i class='bx bx-home-heart'></i>
                    <span class="link_name">Places</span>
                </a>
                <i class='bx bxs-chevron-down arrow'></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name" href="#">Places</a></li>
                <li><a href="{{ route('place.index') }}">View All Locations</a></li>
                <li><a href="{{ route('place.create') }}">Create New Location</a></li>
            </ul>
        </li>



        <hr style="color:aliceblue; width: auto">


        <li>
            <a href="{{ route('admin.profile') }}">
                <i class='bx bx-user'></i>
                <span class="link_name">Profile</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="{{ route('admin.profile') }}">Profile</a></li>
            </ul>
        </li>
        <li>
            <a href="{{ route('admin.password-change') }}">
                <i class='bx bx-wallet-alt'></i>
                <span class="link_name">Change Password</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="{{ route('admin.password-change') }}">Change Password</a></li>
            </ul>
        </li>

        <li>
            <div class="profile-details">
                <div class="profile-content">
                    <img class="rounded-circle header-profile-user" src="{{ asset($profileData->picture) }}"
                        alt="Header Avatar">
                </div>
                <div class="name-job">
                    <div class="profile_name">{{ $profileData->surname }} {{ $profileData->other_name }}</div>
                </div>
                <a href="{{ route('admin.logout') }}">
                    <i class='bx bx-log-out'></i>
                </a>
            </div>
        </li>
    </ul>
</div>
