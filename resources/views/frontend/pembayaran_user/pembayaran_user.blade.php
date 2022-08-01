@extends('frontend.layouts.app')
@section('content')
 <!-- Service Start -->

<!-- Service End -->


<!-- Booking Start -->
<div class="container-fluid bg-secondary booking my-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
        <div class="row gx-5">
            <div class="col-lg-12">
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
                        <div class="table-responsive">
                            <!-- Projects table -->
                            <table class="table align-items-center table-flush" id="table_id">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">#no</th>
                                        <th scope="col">No booking</th>
                                        <th scope="col">Tgl booking</th>
                                        <th scope="col">Pelanggan</th>
                                        <th scope="col">Layanan</th>
                                        <th scope="col">Kendaraan</th>
                                        <th scope="col">Alamat</th>
                                        <th scope="col">Dekskripsi</th>
                                        <th scope="col">Status</th>
                                        <th scope="col"><center>Aksi</center></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($dataSql as $item)
                                    <tr>
                                        <th scope="row">{{$no++}}</th>
                                        <td>{{$item->no_booking}}</td>
                                        <td>{{date('d-m-Y',strtotime($item->tgl_booking))}}</td>
                                        <td>{{$item->nama}}</td>
                                        <td>{{$item->jenis_layanan}}</td>
                                        <td>{{$item->kendaraan}}</td>
                                        <td>{{$item->alamat ?? '-'}}</td>
                                        <td>{{$item->deskripsi}}</td>
                                        <td>
                                            @if($item->status=='WAITING')
                                                <i class="fa fa-clock text-warning" title="Menunggu Konfirmasi"></i>  <span class="text-warning">Menunggu Konfirmasi</span>
                                            @elseif($item->status=='ON_PROGRESS')
                                                <i class="fa fa-clock text-warning" title="Menunggu Konfirmasi"></i>  <span class="text-warning">Sedang Dikerjakan</span>
                                            @elseif ($item->status=='COMPLETED')
                                                <i class="fa fa-check text-info" title="Ditolak"></i> <span class="text-info">Selesai</span>
                                            @elseif ($item->status=='PAID')
                                                <i class="fa fa-coins text-success" title="Diterima"></i> <span class="text-success">Terkonfirmasi</span>
                                            @elseif ($item->status=='REJECT')
                                                <i class="fa fa-times text-danger" title="Diterima"></i> <span class="text-danger">Ditolak</span>
                                            @endif
                                        </td>
                                        <td>
                                            <center>
                                                {{-- <button class="btn btn-primary btn-sm" onclick="editData({{$item}},'{{$item->id}}')"><i class="fas fa-pen"></i></button> --}}
                                                <button class="btn btn-success btn-sm" onclick="deleteData('{{$item->id}}')">Upload Bukti Bayar</button>
                                            </center>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<script src="{{ asset('assets/js/plugins/jquery/dist/jquery.min.js') }}"></script>
<script>
    $(".alert-dismissible").fadeTo(2000, 500).slideUp(500, function(){
        $(".alert-dismissible").alert('close');
    });
</script>
<!-- Booking End -->
@endsection
