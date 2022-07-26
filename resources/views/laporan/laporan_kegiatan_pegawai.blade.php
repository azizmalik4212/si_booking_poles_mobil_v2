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
            <div class="card shadow" style="padding:20px;">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">{{$tittle}}</h3>
                        </div>
                        <div class="col text-right">

                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center table-flush" id="table_id">
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
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
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
                    extend: 'pdf',
                    title:titlePage,
                    exportOptions: {
                        // columns: [0, 1, 2, 3]
                    },
                    customize: function (doc) {
                        doc.content[1].table.widths =
                            Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                    }
                },
                {
                    extend: 'csv',
                    title:titlePage,
                    exportOptions: {
                        // columns: [ 0, 1, 2, 3]
                    }
                },
                {
                    extend: 'print',
                    title:titlePage,
                    exportOptions: {
                        // columns: [ 0, 1, 2, 3]
                    }
                },
            ]
        });
    });
</script>
@endsection
