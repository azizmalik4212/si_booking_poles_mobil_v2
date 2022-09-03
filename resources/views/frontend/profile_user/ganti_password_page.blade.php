@extends('frontend.layouts.app')
@section('content')

 <!-- Service Start -->

<!-- Service End -->


<!-- Booking Start -->
<div class="container-fluid page-header mb-5 p-0" style="background-image: url({{asset('assets_frontend/img/background_prime_1.jpg')}});">
    <div class="container-fluid page-header-inner py-5">
        <div class="container text-center">
            <h1 class="display-3 text-white mb-3 animated slideInDown">{{$tittle}}</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center text-uppercase">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">{{$tittle}}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="container-fluid bg-secondary booking my-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">

        <div class="row gx-5">
            <div class="col-lg-12">
                <br>

                <center>
                    <div class="card shadow" style="width: 800px">
                        <center>
                            @if(session()->has('status') && session()->has('message'))
                                @if (session()->get('status') == 'sukses')
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Success!</strong> {{ session()->get('message') }}
                                    <button type="button" class="btn bg-transparent" data-bs-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @else
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Gagal!</strong> {{ session()->get('message') }}
                                    <button type="button" class="btn bg-transparent" data-bs-dismiss="alert" aria-label="Close">
                                    <span aria- ="true">&times;</span>
                                    </button>
                                </div>
                                @endif
                            @endif
                        </center>
                        <br>
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="mb-0"></h3>
                                </div>
                                <div class="col text-right">

                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('updatePassword') }}" method="post" enctype="multipart/form-data" id="change_pass">
                                {{ csrf_field() }}
                            <input type="hidden" name="id_edit" id="id_edit" value="{{Auth::user()->id}}">
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <button class="btn btn-secondary disabled" type="button" id="button-addon2"><i class="fa fa-lock"></i></button>
                                            </div>
                                            <input type="password" class="form-control" id="password1" name="password_lama" value="{{old('password_lama')}}"  placeholder="Password Lama" required>
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary" type="button" id="button-addon2" onclick="showHidePass('1')"><i class="fa fa-eye" id="showhide_pass1"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <button class="btn btn-secondary disabled" type="button" id="button-addon2"><i class="fa fa-lock"></i></button>
                                            </div>
                                            <input type="password" class="form-control" id="password2" name="password" value="{{old('password')}}"  placeholder="Password Baru" required>
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary" type="button" id="button-addon2" onclick="showHidePass('2')"><i class="fa fa-eye" id="showhide_pass2"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <button class="btn btn-secondary disabled" type="button" id="button-addon2"><i class="fa fa-lock"></i></button>
                                            </div>
                                            <input type="password" class="form-control" id="password3" name="konfirm_password" value="{{old('konfirm_password')}}" placeholder="Konfirmasi Password Baru" required>
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary" type="button" id="button-addon2" onclick="showHidePass('3')"><i class="fa fa-eye" id="showhide_pass3"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button type="button" onclick="aksiGantiPass()" class="btn btn-primary w-100 py-3" type="submit">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>
                </center>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('assets/js/plugins/jquery/dist/jquery.min.js') }}"></script>
<script>
    jQuery.noConflict();
    $("[data-toggle='modal']").modal();

    $(".alert-dismissible").fadeTo(2000, 500).slideUp(500, function(){
        $(".alert-dismissible").alert('close');
    });

    function uploadBukti(idBooking){
        // var obj = data;
        // $('#id_edit').val(idEdit);
        // Object.entries(obj).forEach(([key, val]) => {
        //     $('#'+key+'_edit').val(val);
        //     $('#modalEdit').modal().show();
        // });
        $('#id_booking').val(idBooking);
        $('#modalUploadBukti').modal().show();
      }

      function showHidePass(num) {
        var x = document.getElementById("password"+num);
        if (x.type === "password") {
            x.type = "text";
            $('#showhide_pass'+num).attr('class', 'fa fa-eye-slash');
        } else {
            x.type = "password";
            $('#showhide_pass'+num).attr('class', 'fa fa-eye');

        }
      }

      function aksiGantiPass(){
        const currentPass = '{{@$dataUser->password}}';
        var passwordLama = $('#password1').val();
        var passwordbaru = $('#password2').val();
        var passwordKonfirm = $('#password3').val();

        if (passwordLama == '') {
            alert('Password lama tidak boleh kosong!');
            return false;
        }
        if (passwordbaru == '') {
            alert('Password baru tidak boleh kosong!');
            return false;
        }
        if (passwordKonfirm == '') {
            alert('Konfirmasi Password tidak boleh kosong!');
            return false;
        }

        if (passwordbaru != passwordKonfirm){
            alert('Konfirmasi password tidak valid!');
        } else {
            $('#change_pass').submit();
        }
      }

</script>
<!-- Booking End -->
@endsection
