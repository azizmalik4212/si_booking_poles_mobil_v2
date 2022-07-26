@extends('layouts.app')
@section('content')
<style>
    .dataTables_wrapper .dataTables_length select {
        margin-top: 25px;
    }
</style>
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            <!-- Card stats -->
            <div class="row">

            </div>
        </div>
    </div>
</div>
<div class="container-fluid mt--7">
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
    <div class="col-xl-12 mb-6 mb-xl-0">
        <div class="card">
          <div class="card-body">
            <div class="form-group">

                <form action="{{route('getDataBooking')}}" method="GET" enctype="multipart/form-data" id="filter_form">
                  {{ csrf_field() }}
                  <div class="row">
                <div class="col-lg-4">
                  <label for="exampleInputEmail1" class="mt-2">Status Booking</label>
                  <select class="form-control" name="status" id="status" required>
                      <option value="ALL">-Semua-</option>
                      <option value="WAITING" {{@$status == 'WAITING' ? 'selected':''}}>Menunggu Konfirmasi</option>
                      <option value="ON_PROGRESS" {{@$status == 'ON_PROGRESS' ? 'selected':''}}>Sedang Dikerjakan</option>
                      <option value="COMPLETED" {{@$status == 'COMPLETED' ? 'selected':''}}>Selesai</option>
                      <option value="PAID" {{@$status == 'PAID' ? 'selected':''}}>Dibayar</option>
                      <option value="REJECT" {{@$status == 'REJECT' ? 'selected':''}}>Ditolak</option>
                  </select>
                </div>
                <div class="col-lg-4">
                    <label for="exampleInputEmail1" class="mt-2">Tgl awal</label>
                    <input type="date" class="form-control" name="tgl_awal" id="tgl_awal" value="{{@$tgl_awal}}">
                </div>
                <div class="col-lg-4">
                    <label for="exampleInputEmail1" class="mt-2">Tgl akhir</label>
                    <input type="date" class="form-control" name="tgl_akhir" id="tgl_akhir" value="{{@$tgl_akhir}}">
                </div>
              </div>
            </form>

            </div>
          </div>
          <div class="card-footer">
            <button class="btn btn-primary" onclick="submitFilter()" type="button"><i class="fa fa-search"></i> Filter</button>
          </div>
        </div>
      </div>
    <div class="row mt-5">
        <div class="col-xl-12 mb-6 mb-xl-0">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">{{$tittle}}</h3>
                        </div>
                        <div class="col text-right">
                            <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalAdd"><i class="fas fa-plus"></i></button>
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
                                    <td>{{date('d-m-Y H:i:s',strtotime($item->tgl_booking))}}</td>
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
                                            <i class="fa fa-coins text-success" title="Diterima"></i> <span class="text-success">Dibayar</span>
                                        @elseif ($item->status=='REJECT')
                                            <i class="fa fa-times text-danger" title="Diterima"></i> <span class="text-danger">Ditolak</span>
                                        @endif
                                    </td>
                                    <td>
                                        <center>
                                            <button class="btn btn-primary btn-sm" onclick="editData({{$item}},'{{$item->id}}')"><i class="fas fa-pen"></i></button>
                                            <button class="btn btn-danger btn-sm" onclick="deleteData('{{$item->id}}')"><i class="fas fa-times"></i></button>
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


<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Hapus data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Anda yakin ingin menghapus data yang dipilih?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <a
            onclick="event.preventDefault();document.getElementById('destroy-form').submit();">
            <button class="btn btn-danger">
                Hapus
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

<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Tambah {{$tittle}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('addDataBooking') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
             <div class="form-group">
                <label for="exampleInputEmail1">No booking</label>
                <input type="text" name="no_booking" value="{{$no_booking}}" class="form-control" id="no_booking" placeholder="" required readonly>
             </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Tgl booking</label>
                <input type="date" name="tgl_booking" onchange="onchangeTglBook()" class="form-control" id="tgl_booking" aria-describedby="emailHelp" placeholder="" required>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Jam Booking</label>
                <input type="time" name="jam_booking" class="form-control" id="jam_booking" aria-describedby="emailHelp" placeholder="" required>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Kendaraan</label>
                <input type="text" name="kendaraan" class="form-control" id="kendaraan" aria-describedby="emailHelp" placeholder="Masukkan data kendaraan" required>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Deskripsi</label>
                <input type="text" name="deskripsi" class="form-control" id="deskripsi" aria-describedby="emailHelp" placeholder="Masukkan data deskripsi">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Alamat</label>
                <textarea class="form-control" name="alamat" id="alamat" placeholder="Masukkan alamat"></textarea>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Data user</label>
                <select class="form-control" name="id_user" id="id_user" required>
                    <option value="">-Pilih-</option>
                    @foreach ($dataUser as $row)
                    <option value="{{$row->id}}">{{$row->nama}}</option>
                    @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Data layanan</label>
                <select class="form-control" name="id_layanan" id="id_layanan" required>
                    <option value="">-Pilih-</option>
                    @foreach ($dataLayanan as $row)
                    <option value="{{$row->id}}">{{$row->jenis_layanan}}</option>
                    @endforeach
                </select>
              </div>
              {{-- <div class="form-group">
                <label for="exampleInputEmail1">Status</label>
                <select class="form-control" name="status" id="status" required>
                    <option value="">-Pilih-</option>
                    <option value="ON_PROGRESS">Sedang Dikerjakan</option>
                    <option value="COMPLETED">Selesai</option>
                    <option value="PAID">Dibayar</option>
                </select>
              </div> --}}



              <div style="text-align: right;margin-top:50px;">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
            </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Edit {{$tittle}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('updateDataBooking') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
              <input type="hidden" id="id_edit" name="id_edit">
              <div class="form-group">
                <label for="exampleInputEmail1">No booking</label>
                <input type="text" name="no_booking" class="form-control" id="no_booking_edit" placeholder="" required readonly>
             </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Tgl booking</label>
                <input type="date" name="tgl_booking" class="form-control" id="tgl_booking_edit" onchange="onchangeTglBookEdit()" aria-describedby="emailHelp" placeholder="" required>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Jam Booking</label>
                <input type="time" name="jam_booking" class="form-control" id="jam_booking_edit" aria-describedby="emailHelp" placeholder="" required>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Kendaraan</label>
                <input type="text" name="kendaraan" class="form-control" id="kendaraan_edit" aria-describedby="emailHelp" placeholder="Masukkan data kendaraan" required>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Deskripsi</label>
                <input type="text" name="deskripsi" class="form-control" id="deskripsi_edit" aria-describedby="emailHelp" placeholder="Masukkan data deskripsi">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Alamat</label>
                <textarea class="form-control" name="alamat" id="alamat_edit"  placeholder="Masukkan alamat"></textarea>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Data user</label>
                <select class="form-control" name="id_user" id="id_user_edit" required>
                    <option value="">-Pilih-</option>
                    @foreach ($dataUser as $row)
                    <option value="{{$row->id}}">{{$row->nama}}</option>
                    @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Data layanan</label>
                <select class="form-control" name="id_layanan" id="id_layanan_edit" required>
                    <option value="">-Pilih-</option>
                    @foreach ($dataLayanan as $row)
                    <option value="{{$row->id}}">{{$row->jenis_layanan}}</option>
                    @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Status</label>
                <select class="form-control" name="status" id="status_edit" required>
                    <option value="">-Pilih-</option>
                    <option value="WAITING">menunggu Konfirmasi</option>
                    <option value="ON_PROGRESS">Sedang Dikerjakan</option>
                    <option value="COMPLETED">Selesai</option>
                    <option value="PAID">Dibayar</option>
                    <option value="REJECT">Ditolak</option>
                </select>
              </div>
              <div style="text-align: right;margin-top:50px;">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
            </form>
        </div>
      </div>
    </div>
  </div>

  <script src="{{ asset('assets/js/plugins/jquery/dist/jquery.min.js') }}"></script>
  <script>
      var titlePage = "{{$tittle}}";
      $(document).ready(function() {
         onchangeTglBook();
         var table = $('#table_id').DataTable({
              select: true,
              dom: 'Blfrtip',
              lengthMenu: [
                  [10, 25, 50, 100],
                  ['10', '25', '50', '100']
              ],
              language: {
                  'paginate': {
                  'previous': '<i class="fa fa-chevron-left"></i>',
                  'next': '<i class="fa fa-chevron-right"></i>'
                  }
              },
              buttons: [
                  {
                      extend: 'csv',
                      title:titlePage,
                      exportOptions: {
                          // columns: [ 0, 1, 2, 3]
                      },
                  },
                  {
                      extend: 'pdfHtml5',
                      title:titlePage,
                      exportOptions: {
                          // columns: [ 0, 1, 2, 3]
                      }
                  },
                  {
                      extend: 'print',
                      text:'<i class="fa fa-print"></i> Print',
                      title:titlePage,
                      exportOptions: {
                          // columns: [ 0, 1, 2, 3]
                      }
                  },
              ]
          });
          table.buttons().container()
              .appendTo('#datatable_wrapper .mt-5');
      });
  </script>
  <script>
      function editData(data,idEdit){
        var obj = data;
        $('#id_edit').val(idEdit);
        Object.entries(obj).forEach(([key, val]) => {
            $('#'+key+'_edit').val(val);

            if (key == 'tgl_booking') {
                $('#tgl_booking_edit').val(val.split(" ")[0]);
                $('#jam_booking_edit').val(val.split(" ")[1]);
            }
            onchangeTglBookEdit();
            $('#modalEdit').modal().show();
        });
      }

      function deleteData(id){
        $('#id_delete').val(id);
        $('#modalDelete').modal().show();
      }
      function submitFilter(){
        if ($('#status').val() == '') {
            alert('Status tidak boleh kosong');
        } else if ($('#tgl_awal').val() == '') {
            alert('Tanggal awal tidak boleh kosong');
        } else if ($('#tgl_akhir').val() == '') {
            alert('Tanggal akhir tidak boleh kosong');
        } else {
            $("#filter_form").submit()
        }
    }
    function onchangeTglBook(){
        var tgl = $('#tgl_booking').val().replaceAll("-", "/");
        var day = new Date(tgl);
        if (day.getDay() == 0 || day.getDay() == 6) {
            document.getElementById("jam_booking").setAttribute("max", '15:00');
            document.getElementById("jam_booking").setAttribute("min", '10:00');
        } else {
            document.getElementById("jam_booking").setAttribute("max", '18:00');
            document.getElementById("jam_booking").setAttribute("min", '09:00');
        }


    }

    function onchangeTglBookEdit(){
        var tgl = $('#tgl_booking_edit').val().replaceAll("-", "/");
        var day = new Date(tgl);
        if (day.getDay() == 0 || day.getDay() == 6) {
            document.getElementById("jam_booking_edit").setAttribute("max", '15:00');
            document.getElementById("jam_booking_edit").setAttribute("min", '10:00');
        } else {
            document.getElementById("jam_booking_edit").setAttribute("max", '18:00');
            document.getElementById("jam_booking_edit").setAttribute("min", '09:00');
        }


    }
  </script>
@endsection
