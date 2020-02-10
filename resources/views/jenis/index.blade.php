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
        <div class="card-body">
          <a href="{{ route('jenis.tambah') }}" class="btn btn-sm btn-primary mb-3"><i class="nav-icon fas fa-plus"></i></a>
          <table id="example1" class="table table-striped compact">
            <thead>
              <tr>
                <th>No</th>
                <th>Jenis Barang</th>
                <th style="width:10%">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($categories as $category)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td> <a href="{{route('jenis.detail',$category->id)}}"> {{ $category->nama }}</a>
                </td>
                <td style="width:10%">
                  <form class="d-inline" onsubmit="return confirm('Apakah anda ingin menghapus Kriteria secara permanen?')" action="{{route('jenis.hapus', $category->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger btn-sm">
                      <i class="fa fa-trash"></i></button>
                  </form>
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
@endsection

@push('script')
<!-- DataTables -->
<script src="/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script>
  $(function() {
    $("#example1").DataTable();
  });
</script>
@endpush