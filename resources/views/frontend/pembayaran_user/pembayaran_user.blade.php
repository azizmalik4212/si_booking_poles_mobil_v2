@extends('frontend.layouts.app')
@section('content')

 <!-- Service Start -->

<!-- Service End -->


<!-- Booking Start -->
<div class="container-fluid page-header mb-5 p-0" style="background-image: url({{asset('assets_frontend/img/carousel-bg-1.jpg')}});">
    <div class="container-fluid page-header-inner py-5">
        <div class="container text-center">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Pembayaran</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center text-uppercase">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">Pembayaran</li>
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
                                        <th scope="col">Layanan</th>
                                        <th scope="col">Kendaraan</th>
                                        <th scope="col">Tgl pembayaran</th>
                                        <th scope="col">Bukti</th>
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
                                        <td>{{$item->jenis_layanan}}</td>
                                        <td>{{$item->kendaraan}}</td>
                                        <td>{{ $item->tgl_pembayaran==null ? ' - ' : date('d-m-Y',strtotime($item->tgl_pembayaran))}}</td>
                                        <td><a href="{{ asset('upload/bukti_bayar/'.$item->bukti ?? 'no_image.png') }}" target="_blank"><img src="{{ asset('upload/bukti_bayar/'.$item->bukti ?? 'no_image.png') }}" onerror="this.onerror=null; this.src='{{ asset('upload/bukti_bayar/no_image.png') }}'" class="rounded" width="100px"></a></td>
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
                                                @if (in_array($item->status,['WAITING','ON_PROGRESS','COMPLETED']))
                                                <button class="btn btn-success btn-sm" onclick="uploadBukti('{{$item->id}}','{{$item->harga}}')">Upload Bukti Bayar</button>
                                                @endif

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
                    <label for="exampleInputEmail1" style="margin-bottom: 10px">Total pembayaran</label>
                    <input type="text"  class="form-control" value="" id="total_bayar"  readonly>
                </div>
                <div class="form-group" style="margin-top: 20px" style="background-color: #fff">
                    <label for="exampleInputEmail1" style="margin-bottom: 10px">Bukti Pembayaran</label>
                    <input type="file" name="bukti" class="form-control" style="background-color: #fff" id="bukti"required>
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

    function uploadBukti(idBooking,harga){
        // var obj = data;
        // $('#id_edit').val(idEdit);
        // Object.entries(obj).forEach(([key, val]) => {
        //     $('#'+key+'_edit').val(val);
        //     $('#modalEdit').modal().show();
        // });
        $('#id_booking').val(idBooking);
        $('#total_bayar').val(harga);
        $('#modalUploadBukti').modal().show();
      }
</script>
<!-- Booking End -->
@endsection
