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
        text-align: center;
        border-top: 1px solid black;
        border-bottom: 1px solid black;
    }
    table.dataTable.table-sm > thead > tr > th{
        padding-right: 0;
    }
</style>
@endpush
@section('breadcumb')
<li class="breadcrumb-item">Beranda</li>
<li class="breadcrumb-item active"><a href="#" class="text-info">Barang</a></li>
@endsection
@section('content')
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <div>
                  <h4 class="card-title mb-0">Daftar Barang</h4>
                </div>
                <div class="btn-toolbar d-none d-md-block" role="toolbar" aria-label="Toolbar with buttons">
                    <a class="btn btn-info" href="{{ route('barang.print') }}" target="_blank"><i class="fa fa-print"></i></a>
                    <a class="btn btn-info"  href="{{ route('barang.tambah') }}"><i class="fa fa-plus"></i></a>
                </div>
              </div>
          <table id="example1" style="width:100%" class="table table-sm table-striped compact">
            <thead>
              <tr>
                <th style="width: 5%">No.</th>
                <th style="width: 60%">Nama Barang</th>
                <th style="width: 20%">Jenis</th>
                <th class="text-right" style="width: 3%"></th>
                <th style="min-width: 10%">Harga</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($items as $item)
              <tr>
                <td  class="text-center">{{ $loop->iteration }}</td>
                <td  class=""><a class="text-info" href="{{route('barang.detail',$item->id)}}">{{$item->nama}}</a></td>
                <td class="text-center"><a class="text-info" href="{{route('jenis.detail',$item->category->id)}}">{{$item->category->nama}}</a></td>
                <td class="text-right">Rp</td>
                <td class="text-right"><span class="harga">{{$item->harga}}</span>,-</td>
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
<script src="/adminlte/plugins/number-divider.min.js"></script>

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
    $(".harga").divide({
      delimiter: '.',
      divideThousand: true
    });
  });
</script>
@endpush
