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
    <div class="row">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item ">Beranda</li>
          <li class="breadcrumb-item active"><a href="#">Penjualan</a></li>
        </ol>
    </div>
  </div><!-- /.container-fluid -->
</section>

<section class="content">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Penjualan</h3>
          </div>
        <div class="card-body">
          <form id="form-filter" action="{{route('penjualan.index')}}" method="GET">
            <div class="row">
              <div class="col-md-3">
                <div class="custom-control custom-radio">
                  <input class="custom-control-input" data-id="0" type="radio" id="radiohari" name="filter" value="hari" {{Request::input('filter') == 'hari' ?'checked':''}}>
                  <label for="radiohari" class="custom-control-label">Hari:</label>
                </div>
              </div>
              <div class="col-md-2">
                <div class="custom-control custom-radio">
                  <input class="custom-control-input" data-id="0" type="radio" id="radiobulan" name="filter" value="bulan" {{Request::input('filter') == 'bulan' ?'checked':''}}>
                  <label for="radiobulan" class="custom-control-label">Bulan:</label>
                </div>
              </div>
              <div class="col-md-2">
                <div class="custom-control custom-radio">
                  <input class="custom-control-input" data-id="0" type="radio" id="radiotahun" name="filter" value="tahun" {{Request::input('filter') == 'tahun' ?'checked':''}}>
                  <label for="radiotahun" class="custom-control-label">Tahun:</label>
                </div>
              </div>
              @if (auth()->user()->level_id == 1)
              <div class="col-md-2">
                  <label for="radiocabang">Cabang</label>
              </div>
              <div class="col-md-1">
                  <label for="radiostatus">Status</label>
              </div>
              @else
              <div class="col-md-2">
                  <label for="radiostatus">Status</label>
              </div>
              @endif

            </div>
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <div class="input-group">
                    <input name="hari" type="text" value="{{Request::input('filter') == 'hari' ?Request::input('hari'):''}}" class="form-control form-control-sm float-right" id="tanggal">
                    <div class="input-group-append">
                      <span class="input-group-text"><i class="far fa-calendar"></i></span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-1">
                <select class="form-control form-control-sm" name="bulan">
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
                <select class="form-control form-control-sm" name="bulantahun">
                  @foreach ($tahun as $key=> $item)
                  <option value="{{$key}}" {{Request::input('filter') == 'bulan' ?Request::input('bulantahun') == $key ?'selected':'':''}}>{{$key}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-2">
                <select class="form-control form-control-sm" name="tahun">
                  @foreach ($tahun as $key=> $item)
                  <option value="{{$key}}" {{Request::input('filter') == 'tahun' ?Request::input('tahun') == $key ?'selected':'':''}}>{{$key}}</option>
                  @endforeach
                </select>
              </div>
              @if (auth()->user()->level_id == 1)
              <div class="col-md-2">
                <select class="form-control form-control-sm" name="cabang">
                  <option value="0" {{Request::input('filter') == 'cabang' ?Request::input('cabang') == '0' ?'selected':'':''}}>Semua</option>
                  @foreach ($branches as $branch)
                  <option value="{{$branch->id}}" {{Request::input('cabang') == $branch->id ?'selected':''}}>{{$branch->nama}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-1">
                <select class="form-control form-control-sm" name="status">
                  <option value="0" {{Request::input('status') == '0' ?'selected':''}}>Semua</option>
                  <option value="lunas" {{Request::input('status') == 'lunas' ?'selected':''}}>LUNAS</option>
                  <option value="piutang" {{Request::input('status') == 'piutang' ?'selected':''}}>PIUTANG</option>
                  <option value="pelunasan" {{Request::input('status') == 'pelunasan' ?'selected':''}}>PELUNASAN</option>
                </select>
              </div>
              @else
              <div class="col-md-2">
                <select class="form-control form-control-sm" name="status">
                  <option value="0" {{Request::input('status') == '0' ?'selected':''}}>Semua</option>
                  <option value="lunas" {{Request::input('status') == 'lunas' ?'selected':''}}>LUNAS</option>
                  <option value="piutang" {{Request::input('status') == 'piutang' ?'selected':''}}>PIUTANG</option>
                  <option value="pelunasan" {{Request::input('status') == 'pelunasan' ?'selected':''}}>PELUNASAN</option>

                </select>
              </div>
              @endif

              <div class="col-md-2">
                <input id="downloadble" type="hidden" name="pdf">
                <button type="submit" id="btn-filter" class="btn btn-sm btn-primary"><i class="nav-icon fas fa-eye"></i></button>
                <button id="btn-pdf" type="submit" class="btn btn-sm btn-primary"><i class="nav-icon fas fa-print"></i></button>
                <a href="#" onClick="window.location.reload();" class="btn btn-sm btn-primary"><i class="nav-icon fas fa-sync"></i></a>
              </div>
            </div>
          </form>
          @if (!Request::input('filter') || Request::input('filter') == "hari" || Request::input('filter') == "cabang"|| Request::input('filter') == "status")
          <table id="example1" style="width:100%" class="table table-striped display compact dt-responsive nowrap">
            <thead>
              <tr>
                <th class="py-2">No.</th>
                <th class="py-2">No. Nota Kas</th>
                <th class="py-2">Tanggal</th>
                <th class="py-2">Pelanggan</th>
                <th class="py-2 text-right">Total</th>
                <th class="py-2 text-right">Piutang</th>
                <th class="py-2">Status</th>
                <th class="py-2">Cabang</th>
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
                <td  class="py-2">{{$loop->iteration}}</td>
                <td class="py-2"><a href="{{route('penjualan.detail',$bill->id)}}">{{$bill->no_nota_kas}}</a></td>
                <td class="py-2">{{$bill->tanggal_nota->format('d F Y')}}</td>
                <td class="py-2"><a href="{{route('pelanggan.detail',$bill->customer->id)}}">{{$bill->customer->nama}}</a></td>
                <td class="py-2 text-right">Rp <span class="harga">{{$bill->total_nota}}</span>,-</td>
                @if($bill->kembalian_nota < 0)
                    <td class="py-2 text-right">Rp <span class="harga">{{abs($bill->kembalian_nota)}}</span>,-</td>
                @else
                    <td class="py-2 text-right">-</td>
                @endif
                  <td class="py-2">{{strtoupper($bill->status)}}</td>
                  <td class="py-2"><a href="{{route('cabang.detail',$bill->branch->id)}}">{{ $bill->branch->nama }}</a></td>
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
                <th class="text-right">Rp <span class="harga">{{$total}}</span>,-</th>
                <th class="text-right">Rp <span class="harga">{{$totalpiutang}}</span>,-</th>
                <th></th>
                <th></th>
              </tr>
              <tr>
                <th></th>
                <th></th>
                <th></th>
                <th>Jumlah Kas</th>
                <th class="text-right">Rp <span class="harga">{{$total-$totalpiutang}}</span>,-</th>
                <th></th>
                <th></th>
                <th></th>
              </tr>
            </tfoot>
          </table>
          @elseif(Request::input('filter') == "bulan" || Request::input('filter') == "tahun")
          <table id="table2" style="width:100%" class="table table-bordered table-striped display compact dt-responsive nowrap">
            <thead>
              <tr>
                <th>No.</th>
                <th>{{Request::input('filter') == "bulan"?"Tanggal":"Bulan"}}</th>
                <th>Penjualan</th>
                <th class="text-right">Nominal</th>
                <th>Piutang</th>
                <th class="text-right">Nominal</th>
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
                <td class="text-right">Rp {{$item['nominal_penjualan']}},-</td>
                <td>{{$item['piutang']}}</td>
                <td class="text-right">Rp <span class="harga">{{abs($item['nominal_piutang'])}}</span>,-</td>
                <td class="text-right">Rp {{$item['kas']}},-</td>
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
                <th class="text-right">Rp <span class="harga">{{$totalnominalpenjualan}}</span>,-</th>
                <th>{{$totalpiutang}}</th>
                <th class="text-right">Rp <span class="harga">{{abs($totalnominalpiutang)}}</span>,-</th>
                <th class="text-right">Rp {{$totalkas}},-</th>
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
<script src="/adminlte/plugins/number-divider.min.js"></script>
<script src="/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="/adminlte/plugins/select2/js/select2.full.min.js"></script>
<script src="/adminlte/plugins/moment/moment.min.js"></script>
<script src="/adminlte/plugins/daterangepicker/daterangepicker.js"></script>
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
    $("#table2").DataTable({
        "ordering": false,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Indonesian.json"
        },
        "pageLength": 50
    });
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
  $('#btn-filter').click((e)=>{
        e.preventDefault()
        $('#downloadble').val('')
        $('#form-filter').attr('target','_self')
        $('#form-filter').submit()
    })
  $('#btn-pdf').click((e)=>{
        e.preventDefault()
        $('#downloadble').val('download')
        $('#form-filter').attr('target','_blank')
        $('#form-filter').submit()
    })
    $('#radiohari').click((e)=>{
        const propCheck = $('#radiohari').is(':checked');
        const data = $('#radiohari').data('id');
        if(data == "0") {
            $("#radiohari").prop("checked", true);
            $('#radiohari').data('id','1');
        } else {
            $("#radiohari").prop("checked", false);
            $('#radiohari').data('id','0');
        }
    })
    $('#radiobulan').click((e)=>{
        const propCheck = $('#radiobulan').is(':checked');
        const data = $('#radiobulan').data('id');
        if(data == "0") {
            $("#radiobulan").prop("checked", true);
            $('#radiobulan').data('id','1');
        } else {
            $("#radiobulan").prop("checked", false);
            $('#radiobulan').data('id','0');
        }
    })

    $('#radiotahun').click((e)=>{
        const propCheck = $('#radiotahun').is(':checked');
        const data = $('#radiotahun').data('id');
        if(data == "0") {
            $("#radiotahun").prop("checked", true);
            $('#radiotahun').data('id','1');
        } else {
            $("#radiotahun").prop("checked", false);
            $('#radiotahun').data('id','0');
        }
    })

    $('#radiocabang').click((e)=>{
        const propCheck = $('#radiocabang').is(':checked');
        const data = $('#radiocabang').data('id');
        if(data == "0") {
            $("#radiocabang").prop("checked", true);
            $('#radiocabang').data('id','1');
        } else {
            $("#radiocabang").prop("checked", false);
            $('#radiocabang').data('id','0');
        }
    })
    $('#radiostatus').click((e)=>{
        const propCheck = $('#radiostatus').is(':checked');
        const data = $('#radiostatus').data('id');
        if(data == "0") {
            $("#radiostatus").prop("checked", true);
            $('#radiostatus').data('id','1');
        } else {
            $("#radiostatus").prop("checked", false);
            $('#radiostatus').data('id','0');
        }
    })
</script>
@endpush
