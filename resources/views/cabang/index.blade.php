@extends('layouts.master')

@push('css')
<!-- DataTables -->
<link rel="stylesheet" href="/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
<style>
    .form-control-sm{
        padding-right: 1rem;
    }
    .form-control.form-control-sm:focus{
        color: black;
    }
    .btn-warning{
        color: white;
    }
    .table thead th{
        border-top: 1px solid black;
        border-bottom: 1px solid black;
        text-align: center;
    }
    table.dataTable.table-sm > thead > tr > th{
        padding-right: 0;
    }
</style>
@endpush
@section('breadcumb')
<li class="breadcrumb-item">Beranda</li>
<li class="breadcrumb-item active"><a href="#" >Cabang</a></li>
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
                    <a class="btn btn-primary"  href="{{ route('cabang.tambah') }}"><i class="fa fa-plus"></i></a>
                </div>
              </div>
          <table id="example1" style="width:100%" class="table table-sm table-striped compact dt-responsive nowrap">
            <thead>
              <tr>
                <th style="width:5%">No</th>
                <th style="width:15%">Nama Cabang</th>
                <th style="width:50%">Alamat</th>
                <th style="width:10%">Telepon</th>
                <th style="width:20%">Pimpinan</th>
              </tr>
            </thead>
            <tbody>

              @foreach ($branches as $branch)
              <tr>
                <td class="text-center">{{$loop->iteration}}</td>
                <td><a  href="{{route('cabang.detail', $branch->id)}}">{{$branch->nama}}</a></td>
                <td>{{$branch->alamat}}</td>
                <td class="text-center">{{$branch->telepon}}</td>
                <td class="text-center">{{$branch->pimpinan}}</td>
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
