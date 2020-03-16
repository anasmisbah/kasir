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
    .btn-warning:hover{
        color: white;
    }
    .page-link{
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
    .border-atas{
        border-top: 1px solid black !important;
    }
</style>
@endpush
@section('breadcumb')
<li class="breadcrumb-item">Beranda</li>
<li class="breadcrumb-item active"><a href="#" >Jenis</a></li>
@endsection
@section('content')
    <div class="col-12">
      <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <div>
                  <h4 class="card-title mb-0">Daftar jenis Barang</h4>
                </div>
                <div class="btn-toolbar d-none d-md-block" role="toolbar" aria-label="Toolbar with buttons">
                  <a class="btn btn-primary"  href="{{ route('jenis.tambah') }}"><i class="fa fa-plus"></i></a>
                </div>
              </div>
          <table id="example1" style="width:100%" class="table table-sm table-striped compact">
            <thead>
              <tr>
                <th style="width: 5%">No</th>
                <th style="width: 7%">Kode Jenis</th>
                <th style="width:78%">Jenis Barang</th>
                <th style="width:10%">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($categories as $category)
              <tr>
                <td class="text-center" >{{ $loop->iteration }}</td>
                <td class="text-center" >{{ $category->kode }}</td>
                <td class="text-center"> <a href="{{route('jenis.detail',$category->id)}}" > {{ $category->nama }}</a>
                </td>
                <td class="text-center">
                  <button onclick="hapus({{$category->id}},'{{$category->nama}}')" data-nama="{{$category->nama}}" type="submit" class="btn btn-warning btn-sm">
                    <i class="fa fa-trash"></i></button>
                </td>
              </tr>
              @endforeach
              <tfoot>
                <tr>
                    <td class="border-atas p-0" colspan="4"></td>
                </tr>
            </tfoot>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
<form class="d-inline" id="form-delete" method="POST">
  @csrf
  @method('DELETE')
</form>
@endsection

@push('script')
<!-- DataTables -->
<script src="/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="/adminlte/plugins/sweetalert.min.js"></script>
<script>
  function hapus(id, nama) {
    swal({
        title: `apakah anda yakin menghapus ${nama}?`,
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          swal("berhasil menghapus", {
            icon: "success",
            button: false,
            timer: 1000
          });
          $('#form-delete').attr('action', `/jenis/hapus/${id}`)
          $('#form-delete').submit()
        }
      });
  }
</script>
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
