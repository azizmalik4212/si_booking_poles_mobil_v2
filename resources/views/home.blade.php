@extends('layouts.app')
@section('content')

<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
<div class="container-fluid">
    <div class="header-body">
    <!-- Card stats -->
    <div class="row">
        <div class="col-xl-3 col-lg-6">
        <div class="card card-stats mb-4 mb-xl-0">
            <div class="card-body">
            <div class="row">
                <div class="col">
                <h5 class="card-title text-uppercase text-muted mb-0">Total data Pelanggan</h5>
                <span class="h2 font-weight-bold mb-0">{{$countUsers}}</span>
                </div>
                <div class="col-auto">
                <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                    <i class="fas fa-users"></i>
                </div>
                </div>
            </div>
            <p class="mt-3 mb-0 text-muted text-sm">
                <span class="text-nowrap">{{date('d M Y')}}</span>
            </p>
            </div>
        </div>
        </div>
        <div class="col-xl-3 col-lg-6">
        <div class="card card-stats mb-4 mb-xl-0">
            <div class="card-body">
            <div class="row">
                <div class="col">
                <h5 class="card-title text-uppercase text-muted mb-0">Booking Pending </h5>
                <span class="h2 font-weight-bold mb-0">{{$countPesanan}}</span>
                </div>
                <div class="col-auto">
                <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                    <i class="fas fa-tag"></i>
                </div>
                </div>
            </div>
            <p class="mt-3 mb-0 text-muted text-sm">
                <span class="text-nowrap">{{date('d M Y')}}</span>
            </p>
            </div>
        </div>
        </div>

        <div class="col-xl-3 col-lg-6">
        <div class="card card-stats mb-4 mb-xl-0">
            <div class="card-body">
            <div class="row">
                <div class="col">
                <h5 class="card-title text-uppercase text-muted mb-0">Pembayaran pending</h5>
                <span class="h2 font-weight-bold mb-0">{{$countPembayaranPending}}</span>
                </div>
                <div class="col-auto">
                <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                    <i class="fas fa-briefcase"></i>
                </div>
                </div>
            </div>
            <p class="mt-3 mb-0 text-muted text-sm">
                <span class="text-nowrap">{{date('d M Y')}}</span>
            </p>
            </div>
        </div>
        </div>
        <div class="col-xl-3 col-lg-6">
            <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                <div class="row">
                    <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">Total Pesanan selesai</h5>
                    <span class="h2 font-weight-bold mb-0">{{$countPesananDone}}</span>
                    </div>
                    <div class="col-auto">
                    <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                        <i class="fas fa-umbrella-beach"></i>
                    </div>
                    </div>
                </div>
                <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-nowrap">{{date('d M Y')}}</span>
                </p>
                </div>
            </div>
            </div>
    </div>
    </div>
</div>
</div>
<div class="container-fluid mt--7">



</div>
@endsection
