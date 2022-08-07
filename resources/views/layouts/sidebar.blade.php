<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="{{ route('home') }}">
        <span><img src="{{ asset('assets/img/logo_SM1.png') }}" class="navbar-brand-img" alt="..."><h2>Detailing Dashboard</h2></span>
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
        <li class="nav-item dropdown">
            <a class="nav-link nav-link-icon" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="ni ni-bell-55"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right" aria-labelledby="navbar-default_dropdown_1">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                <img alt="Image placeholder" src="{{ asset('assets/img/icons/avatar-4.png') }}">
                </span>
            </div>
            </a>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
            <div class=" dropdown-header noti-title">
                <h6 class="text-overflow m-0">Welcome!</h6>
            </div>
            <a href="{{ route('home') }}" class="dropdown-item">
                <i class="ni ni-single-02"></i>
                <span>My profile</span>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
            </div>
        </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <!-- Collapse header -->
        <div class="navbar-collapse-header d-md-none">
            <div class="row">
            <div class="col-6 collapse-brand">
                <a href="{{ route('home') }}">
                <img src="{{ asset('assets/img/logo_wsa2.png') }}">
                </a>
            </div>
            <div class="col-6 collapse-close">
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                <span></span>
                <span></span>
                </button>
            </div>
            </div>
        </div>
        <!-- Form -->
        <form class="mt-4 mb-3 d-md-none">
            <div class="input-group input-group-rounded input-group-merge">
            <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="Search" aria-label="Search">
            <div class="input-group-prepend">
                <div class="input-group-text">
                <span class="fa fa-search"></span>
                </div>
            </div>
            </div>
        </form>
        <!-- Navigation -->
        <ul class="navbar-nav">
            <li class="nav-item">
            <a class="nav-link  {{ Request::is('home') ? 'active' : '' }} "href="{{ route('home') }}">
                <i class="ni ni-tv-2 text-primary"></i> Dashboard
            </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('user/data') ? 'active' : '' }}" href="{{ route('getDataUser') }}">
                    <i class="fa fa-users text-blue"></i> Data Users
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('layanan/data') ? 'active' : '' }} "href="{{ route('getDataLayanan') }}">
                    <i class="fa fa-box-open text-blue"></i> Data Layanan
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('booking/data') ? 'active' : '' }} "href="{{ route('getDataBooking') }}">
                    <i class="fa fa-list text-blue"></i> Data Booking
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('pembayaran/data') ? 'active' : '' }} "href="{{ route('getDataPembayaran') }}">
                    <i class="fa fa-coins text-blue"></i> Data Pembayaran
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('list-booking/data') ? 'active' : '' }} "href="{{ route('getDataListBooking') }}">
                    <i class="fa fa-calendar text-blue"></i> List Booking
                </a>
            </li>
        </ul>

        <!-- Divider -->
        {{-- <hr class="my-3">
        <!-- Heading -->
        <h6 class="navbar-heading text-muted">Laporan</h6>
        <!-- Navigation -->
        <ul class="navbar-nav mb-md-3">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('getLaporanDataBooking') }}">
                    <i class="ni ni-single-copy-04"></i> Laporan data booking
                </a>
            </li>
        </ul> --}}

        {{-- <ul class="navbar-nav">
            <li class="nav-item active active-pro">
            <a class="nav-link" href="./examples/upgrade.html">
                <i class="ni ni-send text-dark"></i> Upgrade to PRO
            </a>
            </li>
        </ul> --}}
        </div>
    </div>
</nav>
