@extends('frontend.layouts.app')
@section('content')

 <!-- Service Start -->

<!-- Service End -->


<!-- Booking Start -->
<div class="container-fluid page-header mb-5 p-0" style="background-image: url({{asset('assets_frontend/img/carousel-bg-1.jpg')}});">
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
                @if(session()->has('status') && session()->has('message'))
                    @if (session()->get('status') == 'sukses')
                    <div class="alert alert-success alert-dismissible fade show" role="alert" style="width: 800px">
                        <strong>Success!</strong> Password berhasil diubah
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @else
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="width: 800px">
                        <strong>Gagal!</strong> {{ session()->get('message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria- ="true">&times;</span>
                        </button>
                    </div>
                    @endif
                @endif
                </center>
                <center>
                    <div class="card shadow" style="width: 800px">
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
                            <form action="{{ route('updateDataUser') }}" method="post" enctype="multipart/form-data" id="change_pass">
                                {{ csrf_field() }}
                            <input type="hidden" name="id_edit" id="id_edit" value="{{Auth::user()->id}}">
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="password" class="form-control" id="password_lama" placeholder="Password lama"  required>
                                        <label for="name">Password lama</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="password" class="form-control" id="password_baru" name="password"  placeholder="Password baru" required>
                                        <label for="email">Password baru</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="password" class="form-control" id="konfirm_password" placeholder="Konfirmasi password baru" required>
                                        <label for="name">Konfirmasi password baru</label>
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

      function aksiGantiPass(){
        const currentPass = '{{@$dataUser->password}}';
        var passwordLama = $('#password_lama').val();
        var passwordbaru = $('#password_baru').val();
        var passwordKonfirm = $('#konfirm_password').val();

        if (passwordLama == '') {
            alert('Password lama tidak boleh kosong!');
            return false;
        }
        if (passwordbaru == '') {
            alert('Password baru tidak boleh kosong!');
            return false;
        }
        if (passwordKonfirm == '') {
            alert('Konfirmasi Password lama tidak boleh kosong!');
            return false;
        }

        if (passwordLama != currentPass) {
            alert('Password lama tidak valid!');
        } else if (passwordbaru != passwordKonfirm){
            alert('Konfirmasi password tidak valid!');
        } else {
            $('#change_pass').submit();
        }
      }

</script>
<!-- Booking End -->
@endsection
