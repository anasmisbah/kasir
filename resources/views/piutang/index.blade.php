@extends('layouts.master')
@push('css')
<!-- DataTables -->
<link rel="stylesheet" href="/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
<link rel="stylesheet" href="/adminlte/plugins/daterangepicker/daterangepicker.css">

@endpush
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item ">Beranda</li>
          <li class="breadcrumb-item active"><a href="#">Piutang</a></li>
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
          <form action="{{route('piutang.index')}}" method="GET">
            <div class="row">
              <div class="col-md-4">
                <div class="custom-control custom-radio">
                  <input class="custom-control-input" type="radio" id="hari" name="filter" value="hari" {{Request::input('filter') == 'hari' ?'checked':''}}>
                  <label for="hari" class="custom-control-label">Pilih Tanggal</label>
                </div>
              </div>
              @if (auth()->user()->level_id ==1)
              <div class="col-md-2">
                <div class="custom-control custom-radio">
                  <input class="custom-control-input" type="radio" id="cabang" name="filter" value="cabang" {{Request::input('filter') == 'cabang' ?'checked':''}}>
                  <label for="cabang" class="custom-control-label">Cabang</label>
                </div>
              </div>
              @endif
            </div>
            <div class="row mb-4">
              <div class="col-md-4">
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-clock"></i></span>
                    </div>
                    <input name="hari" type="text" value="{{Request::input('filter') == 'hari' ?Request::input('hari'):''}}" class="form-control form-control-sm float-right" id="tanggal">
                  </div>
                </div>
              </div>
              @if (auth()->user()->level_id == 1)
              <div class="col-md-2">
                <select class="form-control form-control-sm" name="cabang">
                  <option value="0">Semua</option>
                  @foreach ($branches as $branch)
                  <option value="{{$branch->id}}" {{Request::input('filter') == 'cabang' ?Request::input('cabang') == $branch->id ?'selected':'':''}}>{{$branch->nama}}</option>
                  @endforeach
                </select>
              </div>
              @endif

              <div class="col-md-3">
                <button type="submit" class="btn btn-sm btn-primary"><i class="nav-icon fas fa-eye"></i></button>
                <button type="submit" class="btn btn-sm btn-primary" name="print" value="bon"><i class="nav-icon fas fa-print"></i></button>
                <a href="#" onClick="window.location.reload();" class="btn btn-sm btn-primary"><i class="nav-icon fas fa-sync"></i></a>
              </div>
            </div>
          </form>
          <table id="example1" class="table table-striped compact">
            <thead>
              <tr>
                <th>No.</th>
                <th>No. Nota Kas</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Telepon</th>
                <th class="text-right">Piutang</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($bills as $bill)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td><a href="{{route('piutang.detail',$bill->id)}}">{{$bill->no_nota_kas}}</a></td>
                <td><a href="{{route('pelanggan.detail',$bill->customer->id)}}">{{$bill->customer->nama}}</a></td>
                <td>{{$bill->customer->alamat}}</td>
                <td>{{$bill->customer->telepon}}</td>
                <td class="text-right">Rp <span class="harga">{{abs($bill->kembalian_nota)}}</span>,-</td>
                <td>
                  <a href="{{route('piutang.detail',$bill->id)}}" class="btn btn-sm btn-outline-success btn-sm">
                    <i class="fa fa-location-arrow"></i>
                </td>
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
<script src="/adminlte/plugins/number-divider.min.js"></script>
<script src="/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="/adminlte/plugins/select2/js/select2.full.min.js"></script>
<script src="/adminlte/plugins/moment/moment.min.js"></script>
<script src="/adminlte/plugins/daterangepicker/daterangepicker.js"></script>
<script>
  $(function() {
    $("#example1").DataTable();
    $('.select2').select2();
    $(".harga").divide({
      delimiter: '.',
      divideThousand: true
    });
    $('#tanggal').daterangepicker({
      timePicker: true,
      timePickerIncrement: 5,
      timePicker24Hour: true,
      locale: {
        format: 'MM/DD/YYYY HH:mm:ss'
      }
    })
  });
</script>
@endpush