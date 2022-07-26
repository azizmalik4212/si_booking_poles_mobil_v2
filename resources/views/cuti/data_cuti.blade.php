@extends('layouts.app')
@section('content')
<style>
    .wrapper {
      position: relative;
      width: 400px;
      height: 200px;
      -moz-user-select: none;
      -webkit-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }
    .signature-canvas {
      position: absolute;
      left: 0;
      top: 0;
    }

    .signature-pad {
      position: absolute;
      left: 0;
      top: 0;
      width:400px;
      height:200px;
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
                            @if ($jabatan == 'pegawai')
                                <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalAdd"><i class="fas fa-plus"></i></button>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">#no</th>
                                <th scope="col">Pegawai</th>
                                <th scope="col">Awal cuti</th>
                                <th scope="col">AKhir cuti</th>
                                <th scope="col">Perihal</th>
                                <th scope="col">Total Hari cuti</th>
                                <th scope="col">Total cuti tahun ini</th>
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
                                <td>{{date('d-m-Y',strtotime($item->tgl_awal))}}</td>
                                <td>{{date('d-m-Y',strtotime($item->tgl_akhir))}}</td>
                                <td>{{$item->perihal}}</td>
                                <td>{{$item->total_hari_cuti}} Hari</td>
                                <td>{{$item->tot_cuti}} Hari</td>
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
                                        <a href="{{ route('pdfSuratCuti', $item->id) }}" target="_blank" style="margin-right: 8px"><button class="btn btn-primary btn-sm"><i class="fas fa-file"></i></button></a>
                                        @if($jabatan=='admin')
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


{{-- <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
          <form id="destroy-form" action="{{ route('deleteDataCuti') }}" method="POST" class="d-none">
            {{ csrf_field() }}
             <input type="hidden" name="id_delete" id="id_delete">
           </form>
        </div>
      </div>
    </div>
  </div> --}}

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
            <form action="{{ route('addDataCuti') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
              <div class="form-group">
                <input type="hidden" name="id_user" value="{{Auth::user()->id}}">
                <label for="exampleInputEmail1">Pegawai</label>
                <input type="text" name="nama" class="form-control" value="{{Auth::user()->name}}" id="nama" aria-describedby="emailHelp" placeholder="Nama pegawai" required readonly>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Tgl awal cuti</label>
                <input type="date" name="tgl_awal" class="form-control" id="tgl_awal"  placeholder="Masukkan tgl awal cuti" required>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Tgl akhir cuti</label>
                <input type="date" name="tgl_akhir" class="form-control" id="tgl_akhir"  placeholder="Masukkan tgl akhir cuti" required>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Perihal</label>
                <input type="text" name="perihal" class="form-control" id="perihal" aria-describedby="emailHelp" placeholder="Masukkan perihal cuti" required>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">keterangan</label>
                <textarea class="form-control" name="keterangan" id="keterangan" placeholder="Masukkan keterangan cuti" required></textarea>
              </div>
              <div class="form-group">
                <label for="message-text" class="col-form-label">Tanda tangan Digital</label>
                <textarea style="display:none" id="signature" name="signature"></textarea>
                  <div class="wrapper" id="rowBoard">
                    <img class="signature-canvas" src="{{URL::asset('assets/img/white_board.jpeg')}}" width=400 height=200 />
                    <canvas id="signature-pad" class="signature-pad" width=400 height=200></canvas>
                  </div>

                  <div class="wrapper" id="rowresultTTD">
                      <hr>
                    <img id="resultTTD" width=400 height=200/>

                  </div>
                  <div style="margin-top: 20px">
                    <button type="button" class="btn btn-success" id="save"><i class="fa fa-check"></i></button>
                    <button type="button" class="btn btn-danger" id="clear"><i class="fa fa-times"></i></button>
                  </div>
              </div>
              <div style="text-align: right;margin-top:50px;">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" id="saveData">Simpan</button>
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
                <input type="number" name="bonus" class="form-control" id="bonus_edit" aria-describedby="emailHelp" placeholder="Masukkan bonus" required>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">keterangan</label>
                <textarea class="form-control" name="keterangan" id="keterangan_edit" placeholder="Masukkan keterangan" required></textarea>
              </div>
              <div class="form-group">
                <label for="message-text" class="col-form-label">Tanda tangan Digital</label>
                <textarea style="display:none" id="signature" name="signature"></textarea>
                  <div class="wrapper" id="rowBoard">
                    <img class="signature-canvas" src="{{URL::asset('assets/img/white_board.jpeg')}}" width=400 height=200 />
                    <canvas id="signature-pad" class="signature-pad" width=400 height=200></canvas>
                  </div>

                  <div class="wrapper" id="rowresultTTD">
                      <hr>
                    <img id="resultTTD" src="" width=400 height=200/>

                  </div>
                  <div style="margin-top: 20px">
                    <button type="button" class="btn btn-success" id="save"><i class="fa fa-check"></i></button>
                    <button type="button" class="btn btn-danger" id="clear"><i class="fa fa-times"></i></button>
                  </div>
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

          <div class="form-group" id="formTtdValidation">
            <label for="message-text" class="col-form-label">Tanda tangan Digital : </label>
              <div class="wrapper" id="rowBoard">
                <img class="signature-canvas" src="{{URL::asset('assets/img/white_board.jpeg')}}" width=400 height=200 />
                <canvas id="signature-pad2" class="signature-pad" width=400 height=200></canvas>
              </div>

              <div class="wrapper" id="rowresultTTD2">
                  <hr>
                <img id="resultTTD2" width=400 height=200/>

              </div>
              <div style="margin-top: 20px">
                <button type="button" class="btn btn-success" id="save2"><i class="fa fa-check"></i></button>
                <button type="button" class="btn btn-danger" id="clear2"><i class="fa fa-times"></i></button>
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <a
            onclick="event.preventDefault();document.getElementById('konfirm-form').submit();">
            <button class="btn btn-primary" id="saveData2">
                Konfirmasi
            </button>
          </a>
          <form id="konfirm-form" action="{{ route('konfirmDataCuti') }}" method="POST" class="d-none">
            {{ csrf_field() }}
             <textarea style="display:none" id="signature_validation" name="signature_validation"></textarea>
             <input type="hidden" name="id_konfirm" id="id_konfirm">
             <input type="text" name="status" id="status_konfirm">
           </form>
        </div>
      </div>
    </div>
  </div>


<script src="{{ asset('assets/js/plugins/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/signature.js') }}"></script>
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

    $(document).ready(function(){
        if ($("#signature").val()=='') {
            resultConfig('hide');
        } else {
            resultConfig('show');
        }
    });

    var signaturePad = new SignaturePad(document.getElementById('signature-pad'), {
    backgroundColor: 'rgba(255, 255, 255, 0)',
    penColor: 'rgb(0, 0, 0)'
    });
    var saveButton = document.getElementById('save');
    var cancelButton = document.getElementById('clear');
    var photo = document.getElementById('resultTTD');

    saveButton.addEventListener('click', function (event) {
    var data = signaturePad.toDataURL('image/png');
    $("#signature").val(data);
    resultConfig('show');
    photo.setAttribute('src', data);
    });

    cancelButton.addEventListener('click', function (event) {
    signaturePad.clear();
    resultConfig('hide');
    });

    function resultConfig(type){
        if (type == 'show') {
            $("#rowresultTTD").show();
            $("#rowresultTTD2").show();
            $("#saveData").show();
            $("#saveData2").show();
            $("#save").hide();
            $("#rowBoard").hide();
        } else {
            $("#rowresultTTD").hide();
            $("#rowresultTTD2").hide();
            $("#saveData").hide();
            $("#saveData2").hide();
            $("#save").show();
            $("#rowBoard").show();
        }
    }

    function konfirmData(type,id){
        $('#status_konfirm').val(type);

        if (type == 'Y') {
            $('#desc_konfirm').html('lakukan tandan tangan digital untuk menyetujui pengajuan cuti');
            $('#formTtdValidation').show();
            $("#saveData2").hide();
        } else {
            $('#desc_konfirm').html('Apakah Anda yakin ingin menolak pengajuan cuti yang dipilih?');
            $('#formTtdValidation').hide();
            $("#saveData2").show();
        }
        $('#id_konfirm').val(id);
        $('#modalKonfirm').modal().show();
      }

</script>

<script>
    var signaturePad2 = new SignaturePad(document.getElementById('signature-pad2'), {
    backgroundColor: 'rgba(255, 255, 255, 0)',
    penColor: 'rgb(0, 0, 0)'
    });
    var saveButton2 = document.getElementById('save2');
    var cancelButton2 = document.getElementById('clear2');
    var photo2 = document.getElementById('resultTTD2');

    saveButton2.addEventListener('click', function (event) {
    var data = signaturePad2.toDataURL('image/png');
    $("#signature_validation").val(data);
    resultConfig('show');
    photo2.setAttribute('src', data);
    });

    cancelButton2.addEventListener('click', function (event) {
    signaturePad2.clear();
    resultConfig('hide');
    });
</script>
@endsection
