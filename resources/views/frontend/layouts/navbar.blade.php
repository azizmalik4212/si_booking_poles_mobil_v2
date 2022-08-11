<nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
    <a href="/" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
        <h2 class="m-0 text-dark"><span><img src="{{ asset('assets/img/logo_SM1.png') }}" width="50px">&nbsp;&nbsp;Detailing</span></h2>
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <a href="/" class="nav-item nav-link {{ (Request::is('/'))  ? 'active' : '' }}">Beranda</a>
            <a href="#Aboutus" class="nav-item nav-link">Tentang</a>
            <a href="#Service" class="nav-item nav-link ">Layanan</a>
            @if (Auth::user())
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle {{ (Request::is('user/list-booking-user') or Request::is('user/pembayaran') or Request::is('user/jadwal-booking'))  ? 'active' : '' }}" data-bs-toggle="dropdown">Transaksi</a>
                <div class="dropdown-menu fade-up m-0">
                    <a href="{{ route('getDataListBookingUser') }}" class="dropdown-item">Booking</a>
                    <a href="{{ route('getPembayaranUser') }}" class="dropdown-item">Pembayaran</a>
                    <a href="{{ route('getJadwalBooking') }}" class="dropdown-item">Jadwal</a>
                    {{-- <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                    <a href="404.html" class="dropdown-item">404 Page</a> --}}
                </div>
            </div>
            <!-- Ne Senah lamen sube login-->
            <div class="nav-item dropdown">
                <a href="{{ url('/login') }}" class="nav-link dropdown-toggle {{ (Request::is('user/profile') or Request::is('user/ganti-password'))  ? 'active' : '' }}" data-bs-toggle="dropdown">{{Auth::user()->nama}}</a>
                <div class="dropdown-menu fade-up m-0">
                    <a href="{{route('getProfileUser')}}" class="dropdown-item">Profil Saya</a>
                    <a href="{{route('getGantiPassword')}}" class="dropdown-item">Ganti Password</a>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                    </form>
                    {{-- <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                    <a href="404.html" class="dropdown-item">404 Page</a> --}}
                </div>
            </div>
            @else
            <a href="{{ url('/login') }}" class="nav-item nav-link">Login</a>
            @endif
        </div>
        <!-- Lamen nden login ke halaman Login, Lamen Sube Login ke form booking-->
        <a href="{{ route('getBookingUser') }}" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block">Booking Sekarang<i class="fa fa-arrow-right ms-3"></i></a>
    </div>
</nav>
