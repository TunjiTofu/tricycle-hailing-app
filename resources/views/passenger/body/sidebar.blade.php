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
            <a href="{{ route('rider.dashboard') }}">
                <i class='bx bx-home'> <span class="badge rounded-pill bg-success"> {{ $orderCount }}</span></i>
                <span class="link_name">Home </span>


            </a>
            <ul class="sub-menu blank">
                <li>
                    <a class="link_name" href="{{ route('rider.dashboard') }}">Home</a>
                    <span class="badge rounded-pill bg-success float-end">{{ $orderCount }}</span>
                </li>
            </ul>
        </li>

        <li>
            <div class="icon-link">
                <a href="#">
                    <i class='bx bx-mail-send'></i>
                    <span class="link_name">Orders </span>
                </a>
                <i class='bx bxs-chevron-down arrow'></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name" href="#">Orders </a></li>
                <li><a href="{{ route('rider.pending.order') }}">Pending Orders</a></li>
                <li><a href="{{ route('rider.history.order') }}">Order History</a></li>
            </ul>
        </li>
       

        {{-- 

        <hr style="color:aliceblue; width: auto">

        <li>
            <a href="{{ route('rider.profile') }}">
                <i class='bx bx-bell'><span class="badge rounded-pill bg-danger float-end" id="notification">{{ $orderCount }}</span></i>
                <span class="link_name">Notifications <h class="badge rounded-pill bg-danger float-end" id="notification">{{ $orderCount }}</h></span>
            </a>
            <ul class="sub-menu blank">
                <li>
                    <a class="link_name" href="{{ route('rider.profile') }}">Notifications</a>
                    <span class="badge rounded-pill bg-danger float-end" id="notification">{{ $orderCount }}</span>
                </li>
            </ul>
        </li>
        <li>
            <a href="{{ route('rider.profile') }}">
                <i class='bx bx-user'></i>
                <span class="link_name">Profile</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="{{ route('rider.profile') }}">Profile</a></li>
            </ul>
        </li>
        <li>
            <a href="{{ route('rider.password-change') }}">
                <i class='bx bx-wallet-alt'></i>
                <span class="link_name">Change Password</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="{{ route('rider.password-change') }}">Change Password</a></li>
            </ul>
        </li>
--}}
        <li>
            <div class="profile-details">
                <div class="profile-content">
                    <img class="rounded-circle header-profile-user" src="{{ asset($profileData->picture) }}"
                        alt="Header Avatar">
                </div>
                <div class="name-job">
                    <div class="profile_name">{{ $profileData->surname }} {{ $profileData->other_name }}</div>
                </div>
                <a href="{{ route('rider.logout') }}">
                    <i class='bx bx-log-out'></i>
                </a>
            </div>
        </li> 
    </ul>
</div>
