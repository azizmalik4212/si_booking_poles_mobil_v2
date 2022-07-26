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
                            @if ($absenToday == 0 && $jabatan == 'pegawai')
                                <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalAdd">Absen masuk <i class="fas fa-plus"></i></button>
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
                                <th scope="col">Nama user</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Absen masuk</th>
                                <th scope="col">Absen pulang</th>
                                <th scope="col">Keterlambatan</th>
                                <th scope="col">Lembur</th>
                                <th scope="col"><center>Aksi</center></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($dataSql as $item)
                            <tr>
                                <th scope="row">
                                    {{$no++}}
                                    @if ($item->tanggal == date('Y-m-d'))
                                        <sup class="text-info">Today</sup>
                                    @endif
                                </th>
                                <td>{{$item->name ?? ' - '}}</td>
                                <td>{{date('d-m-Y',strtotime($item->tanggal)) ?? ' - '}}</td>
                                <td>{{$item->absen_masuk ?? ' - '}}</td>
                                <td>{{$item->absen_pulang ?? ' - '}}</td>
                                <td>{{$item->lama_keterlambatan ?? ' - '}} Menit</td>
                                <td>{{$item->lama_lembur ?? ' - '}}</td>
                                <td>
                                    <center>
                                        <button class="btn btn-info btn-sm" onclick="deleteData('{{$item->id}}')"><i class="fas fa-eye"></i></button>
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
          <form id="destroy-form" action="{{ route('deleteDataUser') }}" method="POST" class="d-none">
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
            <form action="{{ route('addDataAbsensi') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group row">
                    <div class="col-md-12">
                        <input type="hidden" id="id_user" name="id_user" value="{{Auth::user()->id}}">
                        <input type="hidden" id="type_absen" name="type_absen" value="ABSEN_MASUK">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama User</label>
                            <input type="text" name="name" readonly class="form-control" id="name_edit" aria-describedby="emailHelp" value="{{Auth::user()->name}}" required>
                        </div>
                        <center><label for="message-text" class="col-form-label"><i class="fa fa-image"></i> Bukti</label></center>
                        <textarea id="bukti" name="bukti" style="display: none"></textarea>
                        <div class="contentarea">
                            <div class="border-camera">
                                    <div class="camera">
                                        <video id="video" style="width: 100%;border-radius:10px;">Video stream not available.</video>
                                    </div>
                                    <div><center><button id="startbutton" class="btn btn-primary" style="margin-top: 10px"><i class="fa fa-camera-retro"></i> Take photo</button></center></div>

                                <canvas id="canvas" style="height:10px;"></canvas>
                                <center>
                                <div class="output" id="resultImg">
                                    <hr>
                                    <img id="photo" alt="The screen capture will appear in this box.">
                                    <p><i id="desc_photo">*Pastikan hasil foto tidak buram atau blur</i></p>
                                </div>
                                </center>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="form-group" style="margin-top: 20px" id="row_absenMasuk">
                    <button type="submit" class="btn btn-success w-100">ABSEN MASUK</button>
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
            <form action="{{ route('updateDataUser') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
              <input type="hidden" id="id_edit" name="id_edit">
              <div class="form-group">
                <label for="exampleInputEmail1">Nama User</label>
                <input type="text" name="name" class="form-control" id="name_edit" aria-describedby="emailHelp" placeholder="Masukkan nama user" required>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">NIK</label>
                <input type="text" name="nik" class="form-control" id="nik_edit" aria-describedby="emailHelp" placeholder="Masukkan NIK user" required>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Tempat lahir</label>
                <input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir_edit" aria-describedby="emailHelp" placeholder="Masukkan tempat lahir user" required>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Tgl lahir</label>
                <input type="date" name="tgl_lahir" class="form-control" id="tgl_lahir_edit" aria-describedby="emailHelp" placeholder="Masukkan tgl lahir user" required>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">No Hp</label>
                <input type="text" name="telp" class="form-control" id="telp_edit" aria-describedby="emailHelp" placeholder="Masukkan no hp user" required>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Alamat</label>
                <textarea class="form-control" name="alamat" id="alamat_edit" placeholder="Masukkan alamat user" required></textarea>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Jenis kelamin</label>
                <select class="form-control" name="jk" id="jk_edit" required>
                    <option value="">-Pilih-</option>
                    <option value="L">Laki - laki</option>
                    <option value="P">Perempuan</option>
                </select>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Username</label>
                <input type="text" name="username" id="username_edit" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Username" required>
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" name="password" id="password_edit" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Jabatan</label>
                <select class="form-control" name="jabatan" id="jabatan_edit" required>
                    <option value="">-Pilih-</option>
                    <option value="admin">Admin</option>
                    <option value="pegawai">Pegawai</option>
                </select>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Status</label>
                <select class="form-control" name="status" id="status_edit" required>
                    <option value="">-Pilih-</option>
                    <option value="Y">Aktif</option>
                    <option value="N">Tidak Aktif</option>
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

    //   $(document).ready(function(){
    //     $("#desc_photo").html('Hasil foto akan tampil disini');
    // });
    (function() {
        //$('#row_absenMasuk').hide();

    var width = 320; // We will scale the photo width to this
    var height = 0; // This will be computed based on the input stream

    var streaming = false;

    var video = null;
    var canvas = null;
    var photo = null;
    var startbutton = null;

    function startup() {
        video = document.getElementById('video');
        canvas = document.getElementById('canvas');
        photo = document.getElementById('photo');
        $('#row_absenMasuk').hide();
        startbutton = document.getElementById('startbutton');

        navigator.mediaDevices.getUserMedia({
                video: true,
                audio: false
        })
        .then(function(stream) {
            video.srcObject = stream;
            video.play();
        })
        .catch(function(err) {
            console.log("An error occurred: " + err);
        });

    video.addEventListener('canplay', function(ev) {
        if (!streaming) {
            height = video.videoHeight / (video.videoWidth / width);

            if (isNaN(height)) {
                height = width / (4 / 3);
            }

            video.setAttribute('width', width);
            video.setAttribute('height', height);
            canvas.setAttribute('width', width);
            canvas.setAttribute('height', height);
            streaming = true;
        }
    }, false);

    startbutton.addEventListener('click', function(ev) {
            takepicture();
            ev.preventDefault();
        }, false);

        clearphoto();
    }


    function clearphoto() {
        $("#desc_photo").html('Hasil foto akan tampil disini');
        var context = canvas.getContext('2d');
        context.fillStyle = "#AAA";
        context.fillRect(0, 0, canvas.width, canvas.height);

        var data = canvas.toDataURL('image/png');
        photo.setAttribute('src', data);
    }

    function takepicture() {
        $("#resultImg").show();
        $("#desc_photo").html('*Pastikan hasil foto tidak buram atau blur');
        $("#startbutton").html('<i class="fa fa-camera-retro"></i> Ambil ulang foto');
        var context = canvas.getContext('2d');
        if (width && height) {
            canvas.width = width;
            canvas.height = height;
            context.drawImage(video, 0, 0, width, height);

            var data = canvas.toDataURL('image/png');
            $("#bukti").val(data);
            $('#row_absenMasuk').show('slow');
            photo.setAttribute('src', data);
        } else {
            clearphoto();
        }
    }

    window.addEventListener('load', startup, false);
    })();
  </script>
@endsection
