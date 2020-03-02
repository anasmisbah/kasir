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
</style>
@endpush
@section('breadcumb')
<li class="breadcrumb-item">Beranda</li>
<li class="breadcrumb-item active"><a href="#" class="text-info">Jenis</a></li>
@endsection
@section('content')
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <div>
                  <h4 class="card-title mb-0">Daftar jenis Barang</h4>
                </div>
                <div class="btn-toolbar d-none d-md-block" role="toolbar" aria-label="Toolbar with buttons">
                  <a class="btn btn-info"  href="{{ route('jenis.tambah') }}"><i class="fa fa-plus"></i></a>
                </div>
              </div>
          <table id="example1" style="width:100%" class="table table-striped compact">
            <thead>
              <tr>
                <th style="width: 5%" class="py-2">No</th>
                <th class="py-2 text-left">Jenis Barang</th>
                <th class="py-2" style="width:10%">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($categories as $category)
              <tr>
                <td class="min-padding">{{ $loop->iteration }}</td>
                <td class="min-padding text-left"> <a href="{{route('jenis.detail',$category->id)}}" class="text-info"> {{ $category->nama }}</a>
                </td>
                <td class="min-padding" style="width:10%">
                  <button onclick="hapus({{$category->id}},'{{$category->nama}}')" data-nama="{{$category->nama}}" type="submit" class="btn btn-warning btn-sm">
                    <i class="fa fa-trash"></i></button>
                </td>
              </tr>
              @endforeach
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->
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
