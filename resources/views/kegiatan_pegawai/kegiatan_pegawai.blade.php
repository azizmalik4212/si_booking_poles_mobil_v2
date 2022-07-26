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
                        @if ($jabatan == 'pegawai')
                            <div class="col text-right">
                                <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalAdd"><i class="fas fa-plus"></i></button>
                            </div>
                        @endif

                    </div>
                </div>

                <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">#no</th>
                                <th scope="col">Nama Pegawai</th>
                                <th scope="col">Kegiatan</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Bukti</th>
                                <th scope="col">Bonus</th>
                                <th scope="col">Keterangan</th>
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
                                <td>{{$item->nama_pegawai}}</td>
                                <td>{{$item->nama_kegiatan}}</td>
                                <td>{{date('d-m-Y',strtotime($item->tanggal))}}</td>
                                <td><a href="{{ asset('upload/report_kegiatan/'.$item->bukti) }}" target="_blank"><img src="{{ asset('upload/report_kegiatan/'.$item->bukti) }}" class="rounded" width="100px"></a></td>
                                <td>Rp {{number_format($item->bonus,0,",",".")}}</td>
                                <td>{{$item->keterangan}}</td>
                                <td>
                                    @if($item->status=='W')
                                        <i class="fa fa-clock text-info" title="Menunggu Konfirmasi"></i>  <span class="text-info">Waiting</span>
                                    @elseif ($item->status=='N')
                                        <i class="fa fa-times text-danger" title="Ditolak"></i> <span class="text-danger">Rejected</span>
                                    @else
                                        <i class="fa fa-check text-success" title="Diterima"></i> <span class="text-success">Accepted</span>
                                    @endif
                                </td>
                                <td>
                                    <center>
                                        @if($jabatan=='pegawai')
                                            @if($item->status=='W')
                                                <button class="btn btn-danger btn-sm" onclick="deleteData('{{$item->id}}')"><i class="fas fa-times"></i></button>
                                            @endif
                                        @elseif ($jabatan=='admin')
                                            <button class="btn btn-success btn-sm" onclick="konfirmData('Y','{{$item->id}}')" title="Setujui"><i class="fas fa-check"></i></button>
                                            <button class="btn btn-danger btn-sm" onclick="konfirmData('N','{{$item->id}}')" title="Tolak"><i class="fas fa-ban"></i></button>
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


<div class="modal fade" id="modalKonfirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Konfirmasi data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div id="desc_konfirm"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <a
            onclick="event.preventDefault();document.getElementById('destroy-form').submit();">
            <button class="btn btn-primary">
                Konfirmasi
            </button>
          </a>
          <form id="destroy-form" action="{{ route('konfirmDataKegiatanPeagwai') }}" method="POST" class="d-none">
            {{ csrf_field() }}
             <input type="hidden" name="id_konfirm" id="id_konfirm">
             <input type="text" name="status" id="status_konfirm">
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
            <form action="{{ route('addDataKegiatanPeagwai') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

              <input type="hidden" class="form-control" name="id_user" value="{{$idUser}}">
              <div class="form-group">
                <label for="exampleInputEmail1">Jenis kegiatan</label>
                <select class="form-control" name="id_kegiatan" id="id_kegiatan" onchange="onchangeJneisKegiatan()">
                    <option value="">-Pilih-</option>
                    @foreach ($jenisKegiatan as $row)
                    <option value="{{$row->id}}" bonus="{{$row->bonus}}">{{$row->nama_kegiatan}}</option>
                    @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Bonus</label>
                <input type="number" name="bonus" class="form-control" id="bonus" placeholder="" readonly required>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Tanggal</label>
                <input type="date" name="tanggal" class="form-control" id="tanggal" placeholder="Masukkan tanggal" required>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Bukti</label>
                <input type="file" name="bukti" class="form-control" id="bukti" placeholder="Masukkan bukti" required>
              </div>

              <div class="form-group">
                <label for="exampleInputEmail1">keterangan</label>
                <textarea class="form-control" name="keterangan" id="keterangan" placeholder="Masukkan keterangan" required></textarea>
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
            <form action="{{ route('updateDataKegiatan') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
              <input type="hidden" id="id_edit" name="id_edit">
              <div class="form-group">
                <label for="exampleInputEmail1">Nama kegiatan</label>
                <input type="text" name="nama_kegiatan" class="form-control" id="nama_kegiatan_edit" aria-describedby="emailHelp" placeholder="Masukkan Nama kegiatan" required>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Bonus</label>
                <input type="number" name="bonus" class="form-control" id="bonus_edit" aria-describedby="emailHelp" placeholder="" required>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">keterangan</label>
                <textarea class="form-control" name="keterangan" id="keterangan_edit" placeholder="Masukkan keterangan" required></textarea>
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

      function konfirmData(type,id){
        $('#status_konfirm').val(type);

        if (type=='Y') {
            $('#desc_konfirm').html('Apakah Anda yakin ingin menyetujui data report kegiatan yang dipilih?');
        } else {
            $('#desc_konfirm').html('Apakah Anda yakin ingin menolak data report kegiatan yang dipilih?');
        }
        $('#id_konfirm').val(id);
        $('#modalKonfirm').modal().show();
      }

      function onchangeJneisKegiatan(){
        $("#bonus").val($("#id_kegiatan option:selected").attr("bonus"));
      }
  </script>
@endsection
