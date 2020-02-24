@extends('layouts.master')

@push('css')
<!-- DataTables -->
<link rel="stylesheet" href="/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
@endpush

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-6">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item ">Beranda</li>
          <li class="breadcrumb-item active"><a href="#">Jenis</a></li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Jenis Barang</h3>
            <div class="card-tools">
                <ul class="nav nav-pills ml-auto">
                  <li class="nav-item">
                    <a class="nav-link btn-primary active" href="{{ route('jenis.tambah') }}"><i class=" fas fa-plus"></i></a>
                  </li>
                </ul>
              </div>
        </div>
        <div class="card-body">
          <table id="example1" class="table table-striped compact">
            <thead>
              <tr>
                <th class="py-2">No</th>
                <th class="py-2">Jenis Barang</th>
                <th class="py-2" style="width:10%">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($categories as $category)
              <tr>
                <td class="py-2">{{ $loop->iteration }}</td>
                <td class="py-2"> <a href="{{route('jenis.detail',$category->id)}}"> {{ $category->nama }}</a>
                </td>
                <td class="py-2" style="width:10%">
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
            timer: 750
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
