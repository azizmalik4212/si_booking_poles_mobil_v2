@extends('frontend.layouts.app')
@section('content')

 <!-- Service Start -->

<!-- Service End -->


<!-- Booking Start -->
<div class="container-fluid page-header mb-5 p-0" style="background-image: url({{asset('assets_frontend/img/background_prime_1.jpg')}});">
    <div class="container-fluid page-header-inner py-5">
        <div class="container text-center">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Profil</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center text-uppercase">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">Profil</li>
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
                <div class="card shadow">
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
                        <form action="{{ route('updateDataUser') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                        <input type="hidden" name="id_edit" id="id_edit" value="{{Auth::user()->id}}">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="name" name="nama" value="{{ old('nama') != '' ? old('nama') : $dataUser->nama }}" placeholder="Nama Anda">
                                    <label for="name">Nama</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') != '' ? old('email') : $dataUser->email }}" placeholder="Email Anda">
                                    <label for="email">Email</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="hp" name="hp" value="{{ old('hp') != '' ? old('hp') : $dataUser->hp }}" placeholder="No Handphone Anda">
                                    <label for="name">No Handphone</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-select border" name="jk" id="jk" required>
                                        <option value="">-Pilih-</option>
                                        <option value="L" {{old('jk') != '' ? old('jk') == 'L' ? 'selected' : '' :($dataUser->jk == 'L' ? 'selected' : '')}}>Laki-laki</option>
                                        <option value="P"  {{old('jk') != '' ? old('jk') == 'P' ? 'selected' : '' :($dataUser->jk == 'P' ? 'selected' : '')}}>Perempuan</option>
                                    </select>
                                    <label for="email">Jenis Kelamin</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Alamat Anda" id="alamat" name="alamat" style="height: 100px">{{ old('alamat') != '' ? old('alamat') : $dataUser->alamat }}</textarea>
                                    <label for="message">Alamat</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3" type="submit">Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalUploadBukti" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Upload bukti pembayaran</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('uploadBuktiPembayaran') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="id_booking" id="id_booking">
                <input type="hidden" name="tgl_pembayaran" id="tgl_pembayaran" value="{{date('Y-m-d')}}">
                <div class="form-group">
                    <label for="exampleInputEmail1" style="margin-bottom: 10px">Bukti Pembayaran</label>
                    <input type="file" name="bukti" class="form-control" id="bukti"required>
                </div>

                <div style="text-align: right;margin-top:50px;">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-success">Upload</button>
                </div>
            </form>
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
</script>
<!-- Booking End -->
@endsection
