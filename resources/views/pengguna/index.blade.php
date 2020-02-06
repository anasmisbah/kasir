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
            <h1>Data Pengguna</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Pengguna</a></li>
              <li class="breadcrumb-item active">index</li>
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
              <div class="card-tools">
                <ul class="nav nav-pills ml-auto">
                  <li class="nav-item">
                  <a class="nav-link active" href="{{ route('pengguna.tambah') }}"><i class="nav-icon fas fa-plus"></i></a>
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
                  <th>Nama lengkap</th>
                  <th>Nama Pengguna</th>
                  <th>Email</th>
                  <th>Level</th>
                  <th>Cabang</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ $user->employee->nama }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->level->nama }}</td>
                        <td>{{ $user->employee->branch->nama }}</td>
                        <td><form class="d-inline"
                            onsubmit="return confirm('Apakah anda ingin menghapus Kriteria secara permanen?')"
                            action="{{route('pengguna.hapus', $user->id)}}"
                            method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                    <i class="fa fa-trash"></i></button>
                            </form>
                                <a href="{{route('pengguna.detail',$user->id)}}" class="btn btn-outline-success btn-sm">
                                <i class="fa fa-location-arrow"></i>
                            </a></td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                  <th>No.</th>
                  <th>Nama lengkap</th>
                  <th>Nama Pengguna</th>
                  <th>Email</th>
                  <th>Level</th>
                  <th>Cabang</th>
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
