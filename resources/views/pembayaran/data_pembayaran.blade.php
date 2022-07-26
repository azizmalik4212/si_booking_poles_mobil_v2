@extends('layouts.app')
@section('content')
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
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
    @endif
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
                                <th scope="col">Tgl pembayaran</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Rek transfer</th>
                                <th scope="col">Bukti</th>
                                <th scope="col">Booking</th>
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
                                <td>{{date('d-m-Y',strtotime($item->tgl_pembayaran))}}</td>
                                <td>{{$item->nama}}</td>
                                <td>{{$item->rek_transfer}}</td>
                                <td><a href="{{ asset('upload/bukti_bayar/'.$item->bukti) }}" target="_blank"><img src="{{ asset('upload/bukti_bayar/'.$item->bukti) }}" class="rounded" width="100px"></a></td>
                                <td>{{$item->no_booking}} - {{$item->kendaraan}} - {{$item->jenis_layanan}}</td>
                                <td>
                                    @if($item->status=='WAITING')
                                        <i class="fa fa-clock text-warning" title="Menunggu Konfirmasi"></i>  <span class="text-warning">Menunggu Konfirmasi</span>
                                    @elseif ($item->status=='ACCEPT')
                                        <i class="fa fa-check text-success" title="Diterima"></i> <span class="text-success">Diterima</span>
                                    @elseif ($item->status=='REJECT')
                                        <i class="fa fa-times text-danger" title="Ditolak"></i> <span class="text-danger">Ditolak</span>
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
          <form id="destroy-form" action="{{ route('deleteDataPembayaran') }}" method="POST" class="d-none">
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
            <form action="{{ route('addDataPembayaran') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
              <div class="form-group">
                <label for="exampleInputEmail1">Tgl pembayaran</label>
                <input type="date" name="tgl_pembayaran" class="form-control" id="tgl_pembayaran" aria-describedby="emailHelp" placeholder="" required>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Rek transfer</label>
                <select class="form-control" name="rek_transfer" required style="background-color: #fff;">
                    <option value="">-Pilih-</option>
                    <option value="BCA - 7700607938">BCA - 7700607938</option>
                    <option value="BRI - 313401001228507">BRI - 313401001228507</option>
                </select>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Bukti</label>
                <input type="file" name="bukti" class="form-control" id="bukti"required>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Data booking</label>
                <select class="form-control" name="id_booking" id="id_booking" required>
                    <option value="">-Pilih-</option>
                    @foreach ($dataBookingAdd as $row)
                    <option value="{{$row->id}}">{{$row->no_booking}} - {{$row->kendaraan}} - {{$row->jenis_layanan}}</option>
                    @endforeach
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
            <form action="{{ route('updateDataPembayaran') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
              <input type="hidden" id="id_edit" name="id_edit">
              <div class="form-group">
                <label for="exampleInputEmail1">Tgl pembayaran</label>
                <input type="date" name="tgl_pembayaran" class="form-control" id="tgl_pembayaran_edit" aria-describedby="emailHelp" placeholder="" required>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Rek transfer</label>
                <select class="form-control" name="rek_transfer" id="rek_transfer_edit" required style="background-color: #fff;">
                    <option value="">-Pilih-</option>
                    <option value="BCA - 7700607938">BCA - 7700607938</option>
                    <option value="BRI - 313401001228507">BRI - 313401001228507</option>
                </select>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Bukti</label>
                <input type="file" name="bukti" class="form-control" id="" >
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Data booking</label>
                <select class="form-control" name="id_booking" id="id_booking_edit" style="pointer-events: none; background-color:#9e9e9e26;" required>
                    <option value="">-Pilih-</option>
                    @foreach ($dataBookingEdit as $row)
                    <option value="{{$row->id}}">{{$row->no_booking}} - {{$row->kendaraan}} - {{$row->jenis_layanan}}</option>
                    @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Status</label>
                <select class="form-control" name="status" id="status_edit" required>
                    <option value="">-Pilih-</option>
                    <option value="WAITING">Menunggu Konfirmasi</option>
                    <option value="ACCEPT">Diterima</option>
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
          $('#table_id').DataTable({
              dom: 'Bfrtip',
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
                      }
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
      });
  </script>
  <script>
      function editData(data,idEdit){
        var obj = data;
        $('#id_edit').val(idEdit);
        Object.entries(obj).forEach(([key, val]) => {
            $('#'+key+'_edit').val(val);
            $('#modalEdit').modal().show();
        });
      }

      function deleteData(id){
        $('#id_delete').val(id);
        $('#modalDelete').modal().show();
      }
  </script>
@endsection
