@extends('layouts.master')
@push('css')
<!-- DataTables -->
<link rel="stylesheet" href="/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
<link rel="stylesheet" href="/adminlte/plugins/select2/css/select2.min.css">
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
          <li class="breadcrumb-item active"><a href="#">Penjualan</a></li>
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
          <form action="{{route('penjualan.index')}}" method="GET">
            <div class="row">
              <div class="col-md-4">
                <div class="custom-control custom-radio">
                  <input class="custom-control-input" type="radio" id="radiohari" name="filter" value="hari" {{Request::input('filter') == 'hari' ?'checked':''}}>
                  <label for="radiohari" class="custom-control-label">Hari:</label>
                </div>
              </div>
              <div class="col-md-2">
                <div class="custom-control custom-radio">
                  <input class="custom-control-input" type="radio" id="radiobulan" name="filter" value="bulan" {{Request::input('filter') == 'bulan' ?'checked':''}} >
                  <label for="radiobulan" class="custom-control-label">Bulan:</label>
                </div>
              </div>
              <div class="col-md-2">
                <div class="custom-control custom-radio">
                  <input class="custom-control-input" type="radio" id="radiotahun" name="filter" value="tahun" {{Request::input('filter') == 'tahun' ?'checked':''}} >
                  <label for="radiotahun" class="custom-control-label">Tahun:</label>
                </div>
              </div>
              @if (auth()->user()->level_id == 1)
              <div class="col-md-2">
                <div class="custom-control custom-radio">
                  <input class="custom-control-input" type="radio" id="radiocabang" name="filter" value="cabang" {{Request::input('filter') == 'cabang' ?'checked':''}} >
                  <label for="radiocabang" class="custom-control-label">Cabang</label>
                </div>
              </div>
              @else
              <div class="col-md-2">
                <div class="custom-control custom-radio">
                  <input class="custom-control-input" type="radio" id="radiocabang" name="filter" value="status" {{Request::input('filter') == 'status' ?'checked':''}} >
                  <label for="radiocabang" class="custom-control-label">Status</label>
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
                      <input name="hari" type="text" value="{{Request::input('filter') == 'hari' ?Request::input('hari'):''}}" class="form-control float-right" id="tanggal">
                    </div>
                  </div>
              </div>
              <div class="col-md-1">
                <select class="form-control select2" name="bulan">
                  <option value="01" {{Request::input('filter') == 'bulan' ?Request::input('bulan') == '01' ?'selected':'':''}}>Jan</option>
                  <option value="02" {{Request::input('filter') == 'bulan' ?Request::input('bulan') == '02' ?'selected':'':''}}>Feb</option>
                  <option value="03" {{Request::input('filter') == 'bulan' ?Request::input('bulan') == '03' ?'selected':'':''}}>Mar</option>
                  <option value="04" {{Request::input('filter') == 'bulan' ?Request::input('bulan') == '04' ?'selected':'':''}}>Apr</option>
                  <option value="05" {{Request::input('filter') == 'bulan' ?Request::input('bulan') == '05' ?'selected':'':''}}>Mei</option>
                  <option value="06" {{Request::input('filter') == 'bulan' ?Request::input('bulan') == '06' ?'selected':'':''}}>Jun</option>
                  <option value="07" {{Request::input('filter') == 'bulan' ?Request::input('bulan') == '07' ?'selected':'':''}}>Jul</option>
                  <option value="08" {{Request::input('filter') == 'bulan' ?Request::input('bulan') == '08' ?'selected':'':''}}>Agu</option>
                  <option value="09" {{Request::input('filter') == 'bulan' ?Request::input('bulan') == '09' ?'selected':'':''}}>Sep</option>
                  <option value="10" {{Request::input('filter') == 'bulan' ?Request::input('bulan') == '10' ?'selected':'':''}}>Okt</option>
                  <option value="11" {{Request::input('filter') == 'bulan' ?Request::input('bulan') == '11' ?'selected':'':''}}>Nov</option>
                  <option value="12" {{Request::input('filter') == 'bulan' ?Request::input('bulan') == '12' ?'selected':'':''}}>Des</option>
                </select>
              </div>
              <div class="col-md-1">
                <select class="form-control select2" name="bulantahun">
                  @foreach ($tahun as $key=> $item)
                  <option value="{{$key}}" {{Request::input('filter') == 'bulan' ?Request::input('bulantahun') == $key ?'selected':'':''}}>{{$key}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-2">
                <select class="form-control select2" name="tahun">
                  @foreach ($tahun as $key=> $item)
                  <option value="{{$key}}" {{Request::input('filter') == 'tahun' ?Request::input('tahun') == $key ?'selected':'':''}}>{{$key}}</option>
                  @endforeach
                </select>
              </div>
              @if (auth()->user()->level_id == 1)
              <div class="col-md-2">
                <select class="form-control select2" name="cabang">
                  <option value="0" {{Request::input('filter') == 'cabang' ?Request::input('cabang') == '0' ?'selected':'':''}}>Semua</option>
                  @foreach ($branches as $branch)
                  <option value="{{$branch->id}}" {{Request::input('filter') == 'cabang' ?Request::input('cabang') == $branch->id ?'selected':'':''}}>{{$branch->nama}}</option>
                  @endforeach
                </select>
              </div>
              @else
              <div class="col-md-2">
                <select class="form-control select2" name="status">
                  <option value="0" {{Request::input('filter') == 'status' ?Request::input('status') == '0' ?'selected':'':''}}>Semua</option>
                  <option value="lunas" {{Request::input('filter') == 'status' ?Request::input('status') == 'lunas' ?'selected':'':''}}>LUNAS</option>
                  <option value="piutang" {{Request::input('filter') == 'status' ?Request::input('status') == 'piutang' ?'selected':'':''}}>PIUTANG</option>
                </select>
              </div>
              @endif

              <div class="col-md-2">
                <button type="submit" class="btn btn-primary"><i class="nav-icon fas fa-eye"></i></button>
                <button type="submit" class="btn btn-primary" name="print" value="bill"><i class="nav-icon fas fa-print"></i></button>
                <a href="#" onClick="window.location.reload();" class="btn btn-primary"><i class="nav-icon fas fa-sync"></i></a>
              </div>
            </div>
          </form>
          @if (!Request::input('filter') || Request::input('filter') == "hari" || Request::input('filter') == "cabang"|| Request::input('filter') == "status")
          <table id="example1" class="table table-bordered table-striped display compact">
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
                @php
                    $total = 0;
                    $totalkas = 0;
                    $totalpiutang =0;
                @endphp
              @foreach ($bills as $bill)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td><a href="{{route('penjualan.detail',$bill->id)}}">{{$bill->no_nota_kas}}</a></td>
                <td>{{$bill->tanggal_nota->format('d F Y')}}</td>
                <td><a href="{{route('pelanggan.detail',$bill->customer->id)}}">{{$bill->customer->nama}}</a></td>
                <td>Rp.{{$bill->total_nota}},-</td>
                <td>Rp.{{ $bill->kembalian_nota < 0 ?abs($bill->kembalian_nota).",-":"-"}}</td>
                <td>{{strtoupper($bill->status)}}</td>
                <td><a href="{{route('cabang.detail',$bill->branch->id)}}">{{ $bill->branch->nama }}</a></td>
              </tr>
              @php
                    $temppiutang = $bill->kembalian_nota < 0 ?abs($bill->kembalian_nota):0;
                    $totalpiutang+=$temppiutang;
                    $total+=$bill->total_nota
                @endphp
              @endforeach
            </tbody>

            <tfoot>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>Jumlah</th>
                    <th>Rp {{$total}},-</th>
                    <th>Rp {{$totalpiutang}},-</th>
                    <th></th>
                    <th></th>
                  </tr>
                  <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>Jumlah Kas</th>
                    <th>Rp {{$total-$totalpiutang}}</th>
                    <th></th>
                    <th></th>
                    <th></th>
                  </tr>
            </tfoot>
          </table>
          @elseif(Request::input('filter') == "bulan" || Request::input('filter') == "tahun")
          <table id="example1" class="table table-bordered table-striped display compact">
            <thead>
              <tr>
                <th>No.</th>
                <th>{{Request::input('filter') == "bulan"?"Tanggal":"Bulan"}}</th>
                <th>Penjualan</th>
                <th>Nominal</th>
                <th>Piutang</th>
                <th>Nominal</th>
                <th>Kas</th>
              </tr>
            </thead>
            <tbody>
                @php
                    $totalpenjualan = 0;
                    $totalnominalpenjualan = 0;
                    $totalpiutang = 0;
                    $totalnominalpiutang =0;
                    $totalkas = 0;
                @endphp
              @foreach ($data as $item)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$item['tanggal']}}</td>
                <td>{{$item['penjualan']}}</td>
                <td>Rp {{$item['nominal_penjualan']}},-</td>
                <td>{{$item['piutang']}}</td>
                <td>Rp {{ abs($item['nominal_piutang'])}},-</td>
                <td>Rp {{$item['kas']}},-</td>
              </tr>
              @php
                    $totalpenjualan +=$item['penjualan'] ;
                    $totalnominalpenjualan += $item['nominal_penjualan'];
                    $totalpiutang +=$item['piutang'] ;
                    $totalnominalpiutang +=$item['nominal_piutang'];
                    $totalkas += $item['kas'];
                @endphp
              @endforeach
            </tbody>

            <tfoot>
                <tr>
                    <th></th>
                    <th>JUMLAH</th>
                    <th>{{$totalpenjualan}}</th>
                    <th>Rp {{$totalnominalpenjualan}},-</th>
                    <th>{{$totalpiutang}}</th>
                    <th>Rp {{abs($totalnominalpiutang)}},-</th>
                    <th>Rp {{$totalkas}},-</th>
                  </tr>
            </tfoot>
          </table>
          @endif
        </div>
        </form>
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
<script src="/adminlte/plugins/daterangepicker/daterangepicker.js"></script>
<script>
  $(function() {
    $("#example1").DataTable();
    $('.select2').select2()
    $('#tanggal').daterangepicker({
      timePicker: true,
      timePickerIncrement: 5,
      timePicker24Hour:true,
      locale: {
        format: 'MM/DD/YYYY HH:mm:ss'
      }
    })
  });
</script>
@endpush
