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
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item ">Beranda</li>
          <li class="breadcrumb-item active"><a href="#">Cabang Toko</a></li>
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
          <a href="{{ route('cabang.tambah') }}" class="btn btn-sm btn-primary mb-3"><i class="nav-icon fas fa-plus"></i></a>
          <table id="example1" class="table table-striped compact">
            <thead>
              <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Telepon</th>
                <th>Pimpinan</th>
              </tr>
            </thead>
            <tbody>

              @foreach ($branches as $branch)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td><a href="{{route('cabang.detail', $branch->id)}}">{{$branch->nama}}</a></td>
                <td>{{$branch->alamat}}</td>
                <td>{{$branch->telepon}}</td>
                <td>{{$branch->pimpinan}}</td>
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