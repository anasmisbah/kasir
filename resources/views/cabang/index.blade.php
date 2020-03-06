@extends('layouts.master')

@push('css')
<!-- DataTables -->
<link rel="stylesheet" href="/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
<style>
    .min-padding{
        padding-top: 0.2rem !important;
        padding-bottom: 0.2rem !important;
    }
    .form-control-sm{
        padding-right: 1rem;
    }
    .form-control.form-control-sm:focus{
        border-color: #39f;
        box-shadow: 0 0 0 0.2rem rgba(51, 153, 255, 0.25);
        color: black;
    }
    .page-item.active .page-link{
        background-color: #39f;
        border-color: #39f;
    }
    .btn-warning{
        color: white;
    }
    .page-link{
        color: #39f;
    }
    .page-link:focus{
        border-color: #39f;
        box-shadow: 0 0 0 0.2rem rgba(51, 153, 255, 0.25);
    }
    .page-link:hover{
        color: #39f;
    }

    .table thead th{
        border-top: 1px solid black;
        border-bottom: 1px solid black;
    }
    .table th,.table td{
        padding-top: 0.3rem !important;
        padding-bottom: 0.3rem !important;
    }
</style>
@endpush
@section('breadcumb')
<li class="breadcrumb-item">Beranda</li>
<li class="breadcrumb-item active"><a href="#" class="text-info">Cabang</a></li>
@endsection

@section('content')
    <div class="col-12">
      <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <div>
                  <h4 class="card-title mb-0">Daftar Cabang</h4>
                </div>
                <div class="btn-toolbar d-none d-md-block" role="toolbar" aria-label="Toolbar with buttons">
                    <a class="btn btn-info"  href="{{ route('cabang.tambah') }}"><i class="fa fa-plus"></i></a>
                </div>
              </div>
          <table id="example1" style="width:100%" class="table table-striped compact dt-responsive nowrap">
            <thead>
              <tr>
                <th style="width:5%" class="py-2 text-center">No.</th>
                <th style="width:15%" class="py-2 text-center">Nama Cabang</th>
                <th style="width:35%" class="py-2 text-center">Alamat</th>
                <th style="width:10%" class="py-2 text-center">Telepon</th>
                <th style="width:10%" class="py-2 text-center">Pimpinan</th>
              </tr>
            </thead>
            <tbody>

              @foreach ($branches as $branch)
              <tr>
                <td class="py-2 text-center">{{$loop->iteration}}</td>
                <td class="py-2"><a class="text-info" href="{{route('cabang.detail', $branch->id)}}">{{$branch->nama}}</a></td>
                <td class="py-2">{{$branch->alamat}}</td>
                <td class="py-2 text-center">{{$branch->telepon}}</td>
                <td class="py-2 text-center">{{$branch->pimpinan}}</td>
              </tr>
              @endforeach
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
@endsection

@push('script')
<!-- DataTables -->
<script src="/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script>
  $(function() {
    $("#example1").DataTable({
        "ordering": false,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Indonesian.json"
        }
    });
  });
</script>
@endpush
