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
          <li class="breadcrumb-item">Beranda</li>
          <li class="breadcrumb-item active"><a href="#">Pengguna</a></li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<section class="content">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <a href="{{ route('pengguna.tambah') }}" class="btn btn-sm btn-primary mb-3"><i class="nav-icon fas fa-plus"></i></a>
          <table id="example1" class="table table-striped display compact">
            <thead>
              <tr>
                <th>No.</th>
                <th>Nama lengkap</th>
                <th>Nama Pengguna</th>
                <th>Email</th>
                <th>Level</th>
                <th>Cabang</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($users as $user)
              <tr>
                <td min-height= "10px">{{$loop->iteration}}</td>
                <td min-height= "10px"><a href="{{route('karyawan.detail',$user->employee->id)}}">{{ $user->employee->nama }}</a></td>
                <td min-height= "10px"><a href="{{route('pengguna.detail',$user->id)}}">{{ $user->username }}</a></td>
                <td min-height= "10px">{{ $user->email }}</td>
                <td min-height= "10px">{{ $user->level->nama }}</td>
                <td min-height= "10px"><a href="{{route('cabang.detail',$user->employee->branch->id)}}">{{ $user->employee->branch->nama }}</a></td>
              </tr>
              @endforeach
            </tbody>
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
  $(function() {
    $("#example1").DataTable({
      "ordering": false
    });
  });
</script>
@endpush