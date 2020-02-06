@extends('layouts.master')
@push('css')
<!-- DataTables -->
<link rel="stylesheet" href="/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
<link rel="stylesheet" href="/adminlte/plugins/select2/css/select2.min.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />

@endpush
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Data Penjualan</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Penjualan</a></li>
          <li class="breadcrumb-item active">Index</li>
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
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <form action="{{route('penjualan.index')}}" method="GET">
            <div class="row">
              <div class="col-md-2">
                <div class="custom-control custom-radio">
                  <input class="custom-control-input" type="radio" id="radiohari" name="filter" value="hari" checked>
                  <label for="radiohari" class="custom-control-label">Per Hari</label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="custom-control custom-radio">
                  <input class="custom-control-input" type="radio" id="radiobulan" name="filter" value="bulan" checked>
                  <label for="radiobulan" class="custom-control-label">Per Bulan</label>
                </div>
              </div>
              <div class="col-md-2">
                <div class="custom-control custom-radio">
                  <input class="custom-control-input" type="radio" id="radiotahun" name="filter" value="tahun" checked>
                  <label for="radiotahun" class="custom-control-label">Per Tahun</label>
                </div>
              </div>
              @if (auth()->user()->level_id == 1)
              <div class="col-md-2">
                <div class="custom-control custom-radio">
                  <input class="custom-control-input" type="radio" id="radiocabang" name="filter" value="cabang" checked>
                  <label for="radiocabang" class="custom-control-label">Cabang</label>
                </div>
              </div>
              @else
              <div class="col-md-2">
                <div class="custom-control custom-radio">
                  <input class="custom-control-input" type="radio" id="radiocabang" name="filter" value="status" checked>
                  <label for="radiocabang" class="custom-control-label">Status</label>
                </div>
              </div>
              @endif

            </div>
            <div class="row mb-4">
              <div class="col-md-2">
                <div class="form-group">
                  <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
                    <input name="hari" type="text" class="form-control datetimepicker-input" data-target="#datetimepicker4" />
                    <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-2">
                <select class="form-control select2" name="bulan">
                  @foreach ($bulan as $key => $item)
                  <option value="{{$key}}">{{$item}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-1">
                <select class="form-control select2" name="bulantahun">
                  @foreach ($tahun as $key=> $item)
                  <option value="{{$key}}">{{$key}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-2">
                <select class="form-control select2" name="tahun">
                  @foreach ($tahun as $key=> $item)
                  <option value="{{$key}}">{{$key}}</option>
                  @endforeach
                </select>
              </div>
              @if (auth()->user()->level_id == 1)
              <div class="col-md-2">
                <select class="form-control select2" name="cabang">
                  <option value="0">Semua</option>
                  @foreach ($branches as $branch)
                  <option value="{{$branch->id}}">{{$branch->nama}}</option>
                  @endforeach
                </select>
              </div>
              @else
              <div class="col-md-2">
                <select class="form-control select2" name="status">
                  <option value="0">Semua</option>
                  <option value="lunas">LUNAS</option>
                  <option value="piutang">PIUTANG</option>
                </select>
              </div>
              @endif

              <div class="col-md-3">
                <button type="submit" class="btn btn-primary"><i class="nav-icon fas fa-eye"></i></button>
                <button type="submit" class="btn btn-primary" name="pdf" value="download"><i class="nav-icon fas fa-print"></i></button>
                <a href="#" onClick="window.location.reload();" class="btn btn-primary"><i class="nav-icon fas fa-sync"></i></a>
              </div>
            </div>
          </form>
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No.</th>
                <th>No. Nota Kas</th>
                <th>Tanggal</th>
                <th>Pelanggan</th>
                <th>Total</th>
                <th>Piutang</th>
                <th>Status</th>
                <th>Cabang</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($bills as $bill)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td><a href="{{route('penjualan.detail',$bill->id)}}">{{$bill->no_nota_kas}}</a></td>
                <td>{{$bill->tanggal_nota}}</td>
                <td><a href="{{route('pelanggan.detail',$bill->customer->id)}}">{{$bill->customer->nama}}</a></td>
                <td>Rp.{{$bill->total_nota}},-</td>
                <td>Rp.{{ $bill->kembalian_nota < 0 ?abs($bill->kembalian_nota).",-":"-"}}</td>
                <td>{{strtoupper($bill->status)}}</td>
                <td><a href="{{route('cabang.detail',$bill->branch->id)}}">{{ $bill->branch->nama }}</a></td>
              </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th>No.</th>
                <th>No. Nota Kas</th>
                <th>Tanggal</th>
                <th>Pelanggan</th>
                <th>Total</th>
                <th>Piutang</th>
                <th>Status</th>
                <th>Cabang</th>
              </tr>
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
<script src="/adminlte/plugins/select2/js/select2.full.min.js"></script>
<script src="/adminlte/plugins/moment/moment.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>

<script>
  $(function() {
    $('#datetimepicker4').datetimepicker({
      format: 'L'
    });
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
    $('.select2').select2()
  });
</script>
@endpush