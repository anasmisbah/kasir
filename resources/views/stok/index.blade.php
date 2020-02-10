@extends('layouts.master')

@push('css')
<!-- DataTables -->
<link rel="stylesheet" href="/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
<link rel="stylesheet" href="/adminlte/plugins/select2/css/select2.min.css">
@endpush
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item">Beranda</li>
          <li class="breadcrumb-item active"><a href="#">Stok Barang</a></li>
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
                <a class="nav-link active" href="{{ route('stok.tambah') }}"><i class="nav-icon fas fa-plus"></i></a>
              </li>
            </ul>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <form action="{{route('stok.index')}}" method="GET">
            <div class="row">
              <div class="col-md-2">
                <div class="custom-control custom-radio">
                  <input class="custom-control-input" type="radio" id="customRadio1" name="filter" value="cabang" {{Request::input('filter') == 'cabang' ?'checked':''}}>
                  <label for="customRadio1" class="custom-control-label">Cabang</label>
                </div>
              </div>
            </div>
            <div class="row mb-4">
              <div class="col-md-2">
                <select class="form-control form-control-sm " name="cabang">
                  <option value="0">Semua</option>
                  @foreach ($branches as $branch)
                  <option value="{{$branch->id}}" {{Request::input('filter') == 'cabang' ?Request::input('cabang') == $branch->id ?'selected':'':''}}>{{$branch->nama}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-6">
                <button type="submit" class="btn btn-sm btn-primary"><i class="nav-icon fas fa-eye"></i></button>
                <button type="submit" class="btn btn-sm btn-primary" name="print" value="supply"><i class="nav-icon fas fa-print"></i></button>
                <a href="#" onClick="window.location.reload();" class="btn btn-sm btn-primary"><i class="nav-icon fas fa-sync"></i></a>
              </div>
            </div>
          </form>
          <table id="example1" class="table compact table-bordered table-striped">
            <thead>
              <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Cabang</th>
                <th>Harga Pusat</th>
                <th>Harga Cabang</th>
                <th>Selisih</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($supplies as $supply)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td><a href="{{route('barang.detail', $supply->item->id)}}">{{$supply->item->nama}}</a></td>
                <td><a href="{{route('cabang.detail', $supply->branch->id)}}">{{$supply->branch->nama}}</a></td>
                <td>Rp <span class="harga">{{$supply->item->harga}}</span>,-</td>
                <td>Rp <span class="harga">{{$supply->harga_cabang}}</span>,-</td>
                <td>Rp <span class="harga">{{$supply->harga_selisih}}</span>,-</td>
              </tr>
              @endforeach

            <tfoot>
              <th>No.</th>
              <th>Nama</th>
              <th>Cabang</th>
              <th>Harga Pusat</th>
              <th>Harga Cabang</th>
              <th>Selisih</th>
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
<script src="/adminlte/plugins/select2/js/select2.full.min.js"></script>
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
    $('.select2').select2();
    $(".harga").divide({
      delimiter: '.',
      divideThousand: true
    });

  });
</script>
@endpush