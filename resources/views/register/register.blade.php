<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        Aplikasi Booking SM Detailing
    </title>
    <!-- Favicon -->
    <link href="{{ asset('assets/img/logo_SM2.png') }}" rel="icon" type="image/png">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Icons -->
    <link href="{{ asset('assets/js/plugins/nucleo/css/nucleo.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet" />
    <!-- CSS Files -->
    <link href="{{ asset('assets/css/argon-dashboard.css?v=1.1.2') }}" rel="stylesheet" />
</head>

<body class="bg-default">
  <div class="main-content">


    <!-- Header -->
    <div class="header bg-gradient-primary py-7 py-lg-8">
      {{-- <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-lg-5 col-md-6">
              <h1 class="text-white">Selamat Datang di WSA Toserba!</h1>
              <p class="text-lead text-light">Silakan login dengan kredensial Anda, selamat bekerja :)</p>
            </div>
          </div>
        </div>
      </div> --}}
      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">

      <div class="row justify-content-center">
        <div class="col-lg-6 col-md-7">
        @if(session()->has('status') && session()->get('status') == 'sukses')
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
                <h6><i class="fas fa-check"></i><b> Success!</b></h6>
                Pendaftaran akun berhasil silakan login menggunakan data akun yang telah Anda buat. <b><a href="{{ url('/login') }}"> Login Sekarang! </a></b>
            </div>
        @elseif(session()->has('status') && session()->get('status') == 'gagal')
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>

            <span><i class="fas fa-times"></i> &nbsp; {{session()->get('message')}}</span>
        </div>
        @endif
          <div class="card bg-secondary shadow border-0">

            <div class="card-body px-lg-5 py-lg-5" style="margin-top: 10px">
              <div class="text-center text-muted mb-4">
                <h3><i class="fas fa-user"></i> REGISTER</h3>
              </div>
              <form method="POST" action="{{ route('addRegister') }}" role="form">
                @csrf
                <input type="hidden" name="role" value="user">
                <div class="form-group mb-3">
                    <div class="input-group input-group-alternative">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                      </div>
                      <input id="nama" type="text" class="form-control is-invalid" name="nama" value="{{ old('nama') }}" required autofocus placeholder="Nama Lengkap">
                    </div>
                  </div>
                <div class="form-group mb-3">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                    </div>
                    <input id="username" type="text" class="form-control is-invalid" name="username" value="{{ old('username') }}" autocomplete="username" autofocus placeholder="Username" >
                  </div>
                </div>

                <div class="form-group mb-3">
                    <div class="input-group input-group-alternative">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                      </div>
                      <input id="email" type="text" class="form-control is-invalid" name="email" value="{{ old('email') }}" autofocus placeholder="E-Mail">
                    </div>
                  </div>

                <div class="form-group mb-3">
                    <div class="input-group input-group-alternative">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-key"></i></span>
                        </div>
                        <input id="password" type="password" class="form-control is-invalid" name="password" value="{{ old('password') }}" required  placeholder="Password">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" id="button-addon2" onclick="showHidePass()"><i class="fa fa-eye" id="showhide_pass"></i></button>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <div class="input-group input-group-alternative">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-key"></i></span>
                        </div>
                        <input id="konform_password" type="password" name="konfirm_pass" class="form-control is-invalid" value="{{ old('konfirm_pass') }}" required  placeholder="Konfirmasi Password">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" id="button-addon2" onclick="showHidePass_re()"><i class="fa fa-eye" id="showhide_pass_re"></i></button>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <div class="input-group input-group-alternative">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-phone"></i></span>
                        </div>
                        <input id="text" type="text" class="form-control is-invalid" name="hp" value="{{ old('hp') }}" required  placeholder="No Handphone" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');">
                    </div>
                </div>
                <div class="form-group mb-3">
                    <div class="input-group input-group-alternative">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-gender"></i></span>
                        </div>
                        <select class="form-control" name="jk">
                            <option value="">-Jenis Kelamin-</option>
                            <option value="L" {{ old('jk') == 'L'?'selected':'' }}>Laki - laki</option>
                            <option value="P" {{ old('jk') == 'P'?'selected':'' }}>Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <div class="input-group input-group-alternative">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-locations"></i></span>
                        </div>
                        <textarea class="form-control" name="alamat" placeholder="Alamat Rumah" required>{{ old('alamat') }}</textarea>
                    </div>
                </div>
                <div class="form-group mb-3" style="">
                    <div class="custom-control custom-control-alternative custom-checkbox">
                        <input class="custom-control-input" id=" customCheckLogin" type="checkbox" required>
                        <label class="custom-control-label" for=" customCheckLogin">
                          <span class="text-muted">Dengan ini saya menyetujui <a href="#" data-toggle="modal" data-target="#snkModal">Syarat & Ketentuan</a> yang berlaku </span>
                        </label>
                    </div>
                </div>




                <div class="text-center">
                  <button type="submit" class="btn btn-success my-2 w-100">REGISTER</button>
                  <a href="/"><button type="button" class="btn btn-danger my-2 w-100">BATAL</button></a>
                </div>
              </form>
            </div>
          </div>

        </div>
      </div>
    </div>
    <footer class="py-5">
      <div class="container">
        <div class="row align-items-center justify-content-xl-between">
          <div class="col-xl-12">
            <div class="copyright text-center text-xl-left text-muted">
                <center>© 2022 Aplikasi Booking SM Detailing</center>
            </div>
          </div>

        </div>
      </div>
    </footer>
  </div>

  <div class="modal fade" id="snkModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Syarat dan Ketentuan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>1. Telah Berusia 17 Tahun Keatas</p>
          <p>2. Mengisi Data Sesuai Dengan Identitas Diri</p>
          <p>3. Tidak Memberikan Informasi Akun Anda Kepada Siapapun</p>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>

  <!--   Core   -->
  <script src="{{ asset('assets/js/plugins/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <!--   Optional JS   -->
  <script src="{{ asset('assets/js/plugins/chart.js/dist/Chart.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/chart.js/dist/Chart.extension.js') }}"></script>
  <!--   Argon JS   -->
  <script src="{{ asset('assets/js/argon-dashboard.min.js?v=1.1.2') }}"></script>
  <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
  <script>
    window.TrackJS &&
      TrackJS.install({
        token: "ee6fab19c5a04ac1a32a645abde4613a",
        application: "argon-dashboard-free"
      });

    function showHidePass() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
            $('#showhide_pass').attr('class', 'fa fa-eye-slash');
        } else {
            x.type = "password";
            $('#showhide_pass').attr('class', 'fa fa-eye');

        }
    }

    function showHidePass_re() {
        var x = document.getElementById("konform_password");
        if (x.type === "password") {
            x.type = "text";
            $('#showhide_pass_re').attr('class', 'fa fa-eye-slash');
        } else {
            x.type = "password";
            $('#showhide_pass_re').attr('class', 'fa fa-eye');

        }
    }
  </script>
</body>

</html>
