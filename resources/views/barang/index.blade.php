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
          <li class="breadcrumb-item active"><a href="#">Barang</a></li>
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
                <a class="nav-link active" href="{{ route('barang.tambah') }}"><i class="nav-icon fas fa-plus"></i></a>
              </li>
            </ul>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped compact">
            <thead>
              <tr>
                <th>No.</th>
                <th>Barang</th>
                <th>Jenis</th>
                <th>Harga</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($items as $item)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td><a href="{{route('barang.detail',$item->id)}}">{{$item->nama}}</a></td>
                <td><a href="{{route('jenis.detail',$item->category->id)}}">{{$item->category->nama}}</a></td>
                <td>Rp <span class="harga">{{$item->harga}}</span>,-</td>
              </tr>
              @endforeach

            <tfoot>
              <th>No.</th>
              <th>Barang</th>
              <th>Jenis</th>
              <th>Harga</th>
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
<script src="/adminlte/plugins/number-divider.min.js"></script>

<script src="/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script>
  $(function() {
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
    $(".harga").divide({
      delimiter: '.',
      divideThousand: true
    });
  });
</script>
@endpush