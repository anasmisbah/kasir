@extends('layouts.master')
@push('css')
<!-- DataTables -->
<link rel="stylesheet" href="/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
<link rel="stylesheet" href="{{asset('/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endpush
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-6">
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
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Barang</h3>
            <div class="card-tools">
                <ul class="nav nav-pills ml-auto">
                    <li class="nav-item mr-2">
                        <a class="nav-link btn-sm btn-info active" href="{{ route('cabang.tambah') }}"><i class="nav-icon fas fa-print"></i></a>
                      </li>
                  <li class="nav-item">
                    <a class="nav-link btn-primary active" href="{{ route('barang.tambah') }}"><i class=" fas fa-plus"></i></a>
                  </li>
                </ul>
              </div>
        </div>
        <div class="card-body">
          <table id="example1" style="width:100%" class="table table-striped compact dt-responsive nowrap">
            <thead>
              <tr>
                <th style="width: 5%" class="py-2 text-left">No.</th>
                <th style="width: 50%" class="py-2 text-left">Barang</th>
                <th style="width: 30%" class="py-2 text-left">Jenis</th>
                <th style="width: 15%" class="py-2 text-right">Harga</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($items as $item)
              <tr>
                <td style="width: 5%" class="py-2 text-left">{{ $loop->iteration }}</td>
                <td style="width: 50%" class="py-2 text-left"><a href="{{route('barang.detail',$item->id)}}">{{$item->nama}}</a></td>
                <td style="width: 30%" class="py-2 text-left"><a href="{{route('jenis.detail',$item->category->id)}}">{{$item->category->nama}}</a></td>
                <td style="width: 15%" class="py-2 text-right">Rp <span class="harga">{{$item->harga}}</span>,-</td>
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
<script src="/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script>
  $(function() {
    $("#example1").DataTable({
        "ordering": false,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Indonesian.json"
        }
    });
    $(".harga").divide({
      delimiter: '.',
      divideThousand: true
    });
  });
</script>
@endpush
