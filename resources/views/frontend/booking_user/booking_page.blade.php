@extends('frontend.layouts.app')
@section('content')
 <!-- Service Start -->

<!-- Service End -->


<!-- Booking Start -->
<div class="container-fluid page-header mb-5 p-0" style="background-image: url({{asset('assets_frontend/img/carousel-bg-1.jpg')}});">
    <div class="container-fluid page-header-inner py-5">
        <div class="container text-center">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Booking</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center text-uppercase">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">Booking</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="container-fluid bg-secondary booking my-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
        <div class="row gx-5">
            <div class="col-lg-6 py-5">
                <div class="py-5">
                    <h1 class="text-white mb-4">Certified and Award Winning Car Repair Service Provider</h1>
                    <p class="text-white mb-0">Eirmod sed tempor lorem ut dolores. Aliquyam sit sadipscing kasd ipsum. Dolor ea et dolore et at sea ea at dolor, justo ipsum duo rebum sea invidunt voluptua. Eos vero eos vero ea et dolore eirmod et. Dolores diam duo invidunt lorem. Elitr ut dolores magna sit. Sea dolore sanctus sed et. Takimata takimata sanctus sed.</p>
                </div>
            </div>
            <div class="col-lg-6">
                <br>
                @if(session()->has('status') && session()->has('message'))
                    @if (session()->get('status') == 'sukses')
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> {{ session()->get('message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @else
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Gagal!</strong> {{ session()->get('message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria- ="true">&times;</span>
                        </button>
                    </div>
                    @endif
                @endif
                <div class="bg-primary h-100 d-flex flex-column justify-content-center text-center p-5 wow zoomIn" data-wow-delay="0.6s">
                    <h1 class="text-white mb-4">Book For A Service</h1>
                    <form action="{{ route('addDataBooking') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="id_user" class="form-control border-0" style="height: 55px;" value="{{@$dataUser->id}}" readonly>
                        <input type="hidden" name="no_booking" class="form-control border-0" style="height: 55px;" value="{{$no_booking}}" readonly>
                        <div class="row g-3">
                            <div class="col-12 col-sm-6">
                                <input type="text" class="form-control border-0" style="height: 55px;" value="{{@$dataUser->nama}}" readonly>
                            </div>
                            <div class="col-12 col-sm-6">
                                <input type="email" class="form-control border-0" placeholder="Your Email" value="{{@$dataUser->email}}" readonly style="height: 55px;">
                            </div>
                            <div class="col-12 col-sm-12">
                                <div class="date" id="date1" data-target-input="nearest">
                                    <input type="date" name="tgl_booking" class="form-control border-0" placeholder="Your Email" style="height: 55px;" required>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <select class="form-select border-0" name="id_layanan" id="id_layanan" onchange="onchangeLayanan()" onclick="" style="height: 55px;" required>
                                    <option value="">Pilih Servis</option>
                                    @foreach ($dataLayanan as $row)
                                        <option value="{{$row->id}}" harga="{{$row->harga}}">{{$row->jenis_layanan}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12 col-sm-6">
                                <input type="text" class="form-control border-0" id="harga_layanan" style="height: 55px;" placeholder="Harga" value="0" readonly>
                            </div>
                            <div class="col-12 col-sm-12">
                                <input type="text" name="kendaraan" class="form-control border-0" style="height: 55px;" placeholder="Kendaraan" required>
                            </div>
                            <div class="col-12">
                                <textarea class="form-control border-0" name="deskripsi" placeholder="Deksripsi (Opsional)"></textarea>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-secondary w-100 py-3" type="submit">Book Now</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('assets/js/plugins/jquery/dist/jquery.min.js') }}"></script>
<script>

    function onchangeLayanan(){
        if ($("#id_layanan").val() == '') {
            $("#harga_layanan").val('0');
        } else {
            $("#harga_layanan").val($("#id_layanan option:selected").attr("harga"));
        }
    }
</script>
@endsection
