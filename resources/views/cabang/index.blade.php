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
        <div class="card-header">
            <h3 class="card-title">Daftar Cabang Toko</h3>
            <div class="card-tools">
                <ul class="nav nav-pills ml-auto">
                  <li class="nav-item">
                    <a class="nav-link btn-sm btn-primary active" href="{{ route('cabang.tambah') }}"><i class="nav-icon fas fa-plus"></i></a>
                  </li>
                </ul>
              </div>
        </div>
        <div class="card-body">
          <table id="example1" class="table table-striped compact">
            <thead>
              <tr>
                <th class="py-2">No.</th>
                <th class="py-2">Nama</th>
                <th class="py-2">Alamat</th>
                <th class="py-2">Telepon</th>
                <th class="py-2">Pimpinan</th>
              </tr>
            </thead>
            <tbody>

              @foreach ($branches as $branch)
              <tr>
                <td class="py-2">{{$loop->iteration}}</td>
                <td class="py-2"><a href="{{route('cabang.detail', $branch->id)}}">{{$branch->nama}}</a></td>
                <td class="py-2">{{$branch->alamat}}</td>
                <td class="py-2">{{$branch->telepon}}</td>
                <td class="py-2">{{$branch->pimpinan}}</td>
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
