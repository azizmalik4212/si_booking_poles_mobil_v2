@extends('frontend.layouts.app')
@section('content')
<!-- Service Start -->

<!-- Service End -->


<!-- Booking Start -->
<div class="container-fluid page-header mb-5 p-0" style="background-image: url({{asset('assets_frontend/img/background_prime_1.jpg')}});">
    <div class="container-fluid page-header-inner py-5">
        <div class="container text-center">
            <h1 class="display-3 text-white mb-3 animated slideInDown">List Booking</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center text-uppercase">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">List Booking</li>
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
                                        <th scope="col">#NO</th>
                                        <th scope="col">No Booking</th>
                                        <th scope="col">Tanggal booking</th>
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
                                        <td>{{date('d-m-Y H:i:s',strtotime($item->tgl_booking))}}</td>
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
                                                @if ($item->status=='WAITING' or $item->status=='PAID')
                                                <button class="btn btn-info btn-sm" onclick="editData({{$item}},'{{$item->id}}','{{$item->status}}')"><i class="fas fa-pen text-white"></i></button>
                                                <button class="btn btn-danger btn-sm" onclick="deleteData('{{$item->id}}')"><i class="fas fa-times"></i></button>
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

<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Booking</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form form action="{{ route('updateDataBooking') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" id="id_edit" name="id_edit">
                <div class="form-group" id="row_no_booking">
                    <label for="exampleInputEmail1" style="margin-bottom: 6px;margin-top:10px;">No Booking</label>
                    <input type="text" name="no_booking" class="form-control" id="no_booking_edit" placeholder="" required readonly>
                </div>
                <div class="form-group" id="row_tgl_booking">
                    <label for="exampleInputEmail1" style="margin-bottom: 6px;margin-top:10px;">Tanggal Booking</label>
                    <input type="date" name="tgl_booking" class="form-control" id="tgl_booking_edit" aria-describedby="emailHelp" placeholder="" required>
                </div>
                <div class="form-group" id="row_kendaraan">
                    <label for="exampleInputEmail1" style="margin-bottom: 6px;margin-top:10px;">Kendaraan</label>
                    <input type="text" name="kendaraan" class="form-control" id="kendaraan_edit" aria-describedby="emailHelp" placeholder="Masukkan data kendaraan" required>
                </div>
                <div class="form-group" id="row_deskripsi">
                    <label for="exampleInputEmail1" style="margin-bottom: 6px;margin-top:10px;">Deskripsi</label>
                    <input type="text" name="deskripsi" class="form-control" id="deskripsi_edit" aria-describedby="emailHelp" placeholder="Masukkan data deskripsi" required>
                </div>
                <div class="form-group" id="row_alamat">
                    <label for="exampleInputEmail1" style="margin-bottom: 6px;margin-top:10px;">Alamat</label>
                    <textarea class="form-control" name="alamat" id="alamat_edit"  placeholder="Masukkan alamat"></textarea>
                </div>
                <div class="form-group" id="row_id_layanan">
                    <label for="exampleInputEmail1" style="margin-bottom: 6px;margin-top:10px;">Data layanan</label>
                    <select class="form-control" name="id_layanan" id="id_layanan_edit" required style="background-color: #fff">
                        <option value="">-Pilih-</option>
                        @foreach ($dataLayanan as $row)
                        <option value="{{$row->id}}">{{$row->jenis_layanan}}</option>
                        @endforeach
                    </select>
                </div>
                <div style="text-align: right;margin-top:50px;">
                        <button button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

  {{-- <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Edit Booking</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('updateDataBooking') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
              <input type="hidden" id="id_edit" name="id_edit">
              <div class="form-group" id="row_no_booking">
                <label for="exampleInputEmail1" style="margin-bottom: 6px;margin-top:10px;">No booking</label>
                <input type="text" name="no_booking" class="form-control" id="no_booking_edit" placeholder="" required readonly>
             </div>
              <div class="form-group" id="row_tgl_booking">
                <label for="exampleInputEmail1" style="margin-bottom: 6px;margin-top:10px;">Tgl booking</label>
                <input type="date" name="tgl_booking" class="form-control" id="tgl_booking_edit" aria-describedby="emailHelp" placeholder="" required>
              </div>
              <div class="form-group" id="row_kendaraan">
                <label for="exampleInputEmail1" style="margin-bottom: 6px;margin-top:10px;">Kendaraan</label>
                <input type="text" name="kendaraan" class="form-control" id="kendaraan_edit" aria-describedby="emailHelp" placeholder="Masukkan data kendaraan" required>
              </div>
              <div class="form-group" id="row_deskripsi">
                <label for="exampleInputEmail1" style="margin-bottom: 6px;margin-top:10px;">Deskripsi</label>
                <input type="text" name="deskripsi" class="form-control" id="deskripsi_edit" aria-describedby="emailHelp" placeholder="Masukkan data deskripsi" required>
              </div>
              <div class="form-group" id="row_alamat">
                <label for="exampleInputEmail1" style="margin-bottom: 6px;margin-top:10px;">Alamat</label>
                <textarea class="form-control" name="alamat" id="alamat_edit"  placeholder="Masukkan alamat"></textarea>
              </div>
              <div class="form-group" id="row_id_layanan">
                <label for="exampleInputEmail1" style="margin-bottom: 6px;margin-top:10px;">Data layanan</label>
                <select class="form-control" name="id_layanan" id="id_layanan_edit" required style="background-color: #fff">
                    <option value="">-Pilih-</option>
                    @foreach ($dataLayanan as $row)
                    <option value="{{$row->id}}">{{$row->jenis_layanan}}</option>
                    @endforeach
                </select>
              </div>
              <div style="text-align: right;margin-top:50px;">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Simpan</button>
              </div>
            </form>
        </div>
      </div>
    </div>
  </div> --}}

  <div class="modal fade" id="modalEdit2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit booking</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('updateDataBooking') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
              <input type="hidden" id="id_edit2" name="id_edit">
              <div class="form-group" id="row_tgl_booking">
                <label for="exampleInputEmail1" style="margin-bottom: 6px;margin-top:10px;">Tanggal Booking</label>
                <input type="date" name="tgl_booking" class="form-control" id="tgl_booking_edit2" aria-describedby="emailHelp" placeholder="" required>
              </div>
              <div style="text-align: right;margin-top:50px;">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-success">Simpan</button>
              </div>
            </form>
        </div>
      </div>
    </div>
  </div>

  {{-- <div class="modal fade" id="modalEdit2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Edit Booking</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('updateDataBooking') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
              <input type="hidden" id="id_edit2" name="id_edit">
              <div class="form-group" id="row_tgl_booking">
                <label for="exampleInputEmail1" style="margin-bottom: 6px;margin-top:10px;">Tgl booking</label>
                <input type="date" name="tgl_booking" class="form-control" id="tgl_booking_edit2" aria-describedby="emailHelp" placeholder="" required>
              </div>
              <div style="text-align: right;margin-top:50px;">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Simpan</button>
              </div>
            </form>
        </div>
      </div>
    </div>
  </div> --}}

  {{-- <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Batalkan Boooking</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Anda yakin ingin membatalkan data booking yang dipilih?
        </div>
        <div class="modal-footer">

          <a
            onclick="event.preventDefault();document.getElementById('destroy-form').submit();">
            <button class="btn btn-danger">
                Yakin
            </button>
          </a>
          <form id="destroy-form" action="{{ route('deleteDataBooking') }}" method="POST" class="d-none">
            {{ csrf_field() }}
             <input type="hidden" name="id_delete" id="id_delete">
           </form>
        </div>
      </div>
    </div>
  </div> --}}


  <div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Hapus Booking</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            Anda yakin ingin membatalkan data booking yang dipilih?
          </div>
          <div class="modal-footer">
            {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button> --}}
            <a
              onclick="event.preventDefault();document.getElementById('destroy-form').submit();">
              <button class="btn btn-danger">
                  Yakin
              </button>
            </a>
            <form id="destroy-form" action="{{ route('deleteDataBooking') }}" method="POST" class="d-none">
              {{ csrf_field() }}
               <input type="hidden" name="id_delete" id="id_delete">
             </form>
          </div>
      </div>
    </div>
  </div>
<script src="{{ asset('assets/js/plugins/jquery/dist/jquery.min.js') }}"></script>
<script>


    function editData(data,idEdit,status){
        var obj = data;

        $('#id_edit').val(idEdit);
        $('#id_edit2').val(idEdit);
        Object.entries(obj).forEach(([key, val]) => {
            $('#'+key+'_edit').val(val);
            $('#'+key+'_edit2').val(val);
        });
        if (status == 'WAITING') {
            $('#modalEdit').modal('show');
        } else {
            $('#modalEdit2').modal('show');
        }

      }

      function deleteData(id){
        $('#id_delete').val(id);
        $('#modalDelete').modal('show');
      }

</script>
<!-- Booking End -->
@endsection
