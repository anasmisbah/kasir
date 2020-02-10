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
        <div class="card-body">
          <a href="{{ route('barang.tambah') }}" class="btn btn-sm btn-primary mb-3"><i class="nav-icon fas fa-plus"></i></a>
          <table id="example1" class="table table-striped compact">
            <thead>
              <tr>
                <th style="width: 5%" class="text-left">No.</th>
                <th style="width: 50%" class="text-left">Barang</th>
                <th style="width: 30%" class="text-left">Jenis</th>
                <th style="width: 15%" class="text-right">Harga</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($items as $item)
              <tr>
                <td style="width: 5%" class="text-left">{{ $loop->iteration }}</td>
                <td style="width: 50%" class="text-left"><a href="{{route('barang.detail',$item->id)}}">{{$item->nama}}</a></td>
                <td style="width: 30%" class="text-left"><a href="{{route('jenis.detail',$item->category->id)}}">{{$item->category->nama}}</a></td>
                <td style="width: 15%" class="text-right">Rp <span class="harga">{{$item->harga}}</span>,-</td>
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
<script src="/adminlte/plugins/number-divider.min.js"></script>

<script src="/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script>
  $(function() {
    $("#example1").DataTable();
    $(".harga").divide({
      delimiter: '.',
      divideThousand: true
    });
  });
</script>
@endpush