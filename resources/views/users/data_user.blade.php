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
                                <th scope="col">Username</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Jabatan</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">No telp</th>
                                <th scope="col"><center>Aksi</center></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($sqlUser as $item)
                            <tr>
                                <th scope="row">{{$no++}}</th>
                                <td>{{$item->username}}</td>
                                <td>{{$item->nama}}</td>
                                <td>{{$item->role}}</td>
                                <td>{{$item->alamat}}</td>
                                <td>{{$item->hp}}</td>
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
            <form action="{{ route('addDataUser') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
              <div class="form-group">
                <label for="exampleInputEmail1">Nama User</label>
                <input type="text" name="nama" class="form-control" id="nama" aria-describedby="emailHelp" placeholder="Masukkan nama user" required>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">No Hp</label>
                <input type="text" name="hp" class="form-control" id="hp" aria-describedby="emailHelp" placeholder="Masukkan no hp user" required>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Alamat</label>
                <textarea class="form-control" name="alamat" placeholder="Masukkan alamat user" required></textarea>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Jenis kelamin</label>
                <select class="form-control" name="jk" required>
                    <option value="">-Pilih-</option>
                    <option value="L">Laki - laki</option>
                    <option value="P">Perempuan</option>
                </select>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Username</label>
                <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Username" required>
              </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
                </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Jabatan</label>
                <select class="form-control" name="role" required>
                    <option value="">-Pilih-</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
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
            <form action="{{ route('updateDataUser') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
              <input type="hidden" id="id_edit" name="id_edit">
              <div class="form-group">
                <label for="exampleInputEmail1">Nama User</label>
                <input type="text" name="nama" class="form-control" id="nama_edit" aria-describedby="emailHelp" placeholder="Masukkan nama user" required>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">No Hp</label>
                <input type="text" name="hp" class="form-control" id="hp_edit" aria-describedby="emailHelp" placeholder="Masukkan no hp user" required>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Alamat</label>
                <textarea class="form-control" name="alamat" id="alamat_edit" placeholder="Masukkan alamat user" required></textarea>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Jenis kelamin</label>
                <select class="form-control" name="jk" id=" jk_edit" required>
                    <option value="">-Pilih-</option>
                    <option value="L">Laki - laki</option>
                    <option value="P">Perempuan</option>
                </select>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Username</label>
                <input type="text" name="username" class="form-control" id="username_edit" aria-describedby="emailHelp" placeholder="Username" required>
              </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name="password" class="form-control" id="password_edit" placeholder="Password" required>
                </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Jabatan</label>
                <select class="form-control" name="role" id="role_edit" required>
                    <option value="">-Pilih-</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
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
                      text: '<i class="fa fa-file"></i> Cetak '+titlePage,
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
