@extends('layouts.master')

@push('css')
    <!-- DataTables -->
  <link rel="stylesheet" href="/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
@endpush

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>DataTables</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">DataTable with default features</h3>
              <div class="card-tools">
                <ul class="nav nav-pills ml-auto">
                  <li class="nav-item">
                  <a class="nav-link active" href="{{ route('cabang.tambah') }}"><i class="nav-icon fas fa-plus"></i></a>
                  </li>
                </ul>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Nama</th>
                  <th>Alamat</th>
                  <th>Telepon</th>
                  <th>Pimpinan</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>

                @foreach ($branches as $branch)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$branch->nama}}</td>
                    <td>{{$branch->alamat}}</td>
                    <td>{{$branch->telepon}}</td>
                    <td>{{$branch->pimpinan}}</td>
                    <td>
                        <form class="d-inline"
                        onsubmit="return confirm('Apakah anda ingin menghapus Kriteria secara permanen?')"
                        action="{{route('cabang.hapus', $branch->id)}}"
                        method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                <i class="fa fa-trash"></i></button>
                        </form>
                        <a href="{{route('cabang.detail',$branch->id)}}" class="btn btn-outline-success btn-sm">
                        <i class="fa fa-location-arrow"></i>
                    </a>
                    </td>
                </tr>
                @endforeach


                <tfoot>
                  <th>No.</th>
                  <th>Nama</th>
                  <th>Alamat</th>
                  <th>Telepon</th>
                  <th>Pimpinan</th>
                  <th>Aksi</th>
                </tfoot>
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
@endsection

@push('script')
<!-- DataTables -->
<script src="/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>
@endpush
