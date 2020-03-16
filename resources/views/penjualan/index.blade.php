@extends('layouts.master')
@push('css')
<!-- DataTables -->
<link rel="stylesheet" href="/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
<link rel="stylesheet" href="/adminlte/plugins/daterangepicker/daterangepicker.css">
<style>
    .min-padding{
        padding-top: 0.2rem !important;
        padding-bottom: 0.2rem !important;
    }
    .form-control-sm{
        padding-right: 1rem;
    }
    .form-control.form-control-sm:focus{
        color: black;
    }
    .btn-warning{
        color: white;
    }
    .filter{
        padding-right: 0rem !important;
    }
    .table thead th{
        border-top: 1px solid black;
        border-bottom: 1px solid black;
    }
    .table tfoot th{
        border-top: 1px solid black;
    }
    .border-bawah{
        border-bottom: 1px solid black !important;
    }
    @media (min-width: 768px){
        .col-md-4 {
            max-width: 30%;
        }
        .col-md-2.butn {
            margin-top: 28px;
            max-width: 10% !important;
        }
        .col-md-1.thn{
            min-width: 10% !important;
        }
        .col-md-2.cbng {
            max-width: 16% !important;
        }
    }
</style>
@endpush
@section('breadcumb')
<li class="breadcrumb-item">Beranda</li>
<li class="breadcrumb-item active"><a href="#" >Penjualan</a></li>
@endsection
@section('content')
    <div class="col-12">
      <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <div>
                <h4 class="card-title mb-0">Daftar Penjualan</h4>
                </div>
            </div>

            <form id="form-filter" action="{{route('penjualan.index')}}" method="GET">
                <div class="row col-md-12 mx-0 my-3 py-3" style="background:#ebebeb">
                    {{-- GROUP 1 FILTER PER HARI --}}
                    <div class="col-md-4">
                        <div class="custom-control custom-radio mb-2">
                        <input class="custom-control-input" data-id="0" type="radio" id="radiohari" name="filter" value="hari" {{Request::input('filter') == 'hari' ?'checked':''}}>
                        <label for="radiohari" class="custom-control-label">Per Hari</label>
                        </div>
                        <div class="input-group">
                            <input name="hari" type="text" value="{{Request::input('filter') == 'hari' ?Request::input('hari'):''}}" class="filter form-control form-control-sm float-right " id="tanggal">
                            <div class="input-group-append">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                    </div>

                    {{-- GROUP 2 FILTER PER BULAN --}}
                    <div class="col-md-2">
                        <div class="custom-control custom-radio mb-2">
                        <input class="custom-control-input" data-id="0" type="radio" id="radiobulan" name="filter" value="bulan" {{Request::input('filter') == 'bulan' ?'checked':''}}>
                        <label for="radiobulan" class="custom-control-label">Per Bulan</label>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <select class="form-control form-control-sm" name="bulan">
                                    <option value="01" {{Request::input('filter') == 'bulan' ?Request::input('bulan') == '01' ?'selected':'':''}}>Januari</option>
                                    <option value="02" {{Request::input('filter') == 'bulan' ?Request::input('bulan') == '02' ?'selected':'':''}}>Februari</option>
                                    <option value="03" {{Request::input('filter') == 'bulan' ?Request::input('bulan') == '03' ?'selected':'':''}}>Maret</option>
                                    <option value="04" {{Request::input('filter') == 'bulan' ?Request::input('bulan') == '04' ?'selected':'':''}}>April</option>
                                    <option value="05" {{Request::input('filter') == 'bulan' ?Request::input('bulan') == '05' ?'selected':'':''}}>Mei</option>
                                    <option value="06" {{Request::input('filter') == 'bulan' ?Request::input('bulan') == '06' ?'selected':'':''}}>Juni</option>
                                    <option value="07" {{Request::input('filter') == 'bulan' ?Request::input('bulan') == '07' ?'selected':'':''}}>Juli</option>
                                    <option value="08" {{Request::input('filter') == 'bulan' ?Request::input('bulan') == '08' ?'selected':'':''}}>Agustus</option>
                                    <option value="09" {{Request::input('filter') == 'bulan' ?Request::input('bulan') == '09' ?'selected':'':''}}>September</option>
                                    <option value="10" {{Request::input('filter') == 'bulan' ?Request::input('bulan') == '10' ?'selected':'':''}}>Oktober</option>
                                    <option value="11" {{Request::input('filter') == 'bulan' ?Request::input('bulan') == '11' ?'selected':'':''}}>November</option>
                                    <option value="12" {{Request::input('filter') == 'bulan' ?Request::input('bulan') == '12' ?'selected':'':''}}>Desember</option>
                                </select>
                            </div>
                            <div class="col">
                                <select class="filter form-control form-control-sm" name="bulantahun">
                                    @foreach ($tahun as $key=> $item)
                                    <option value="{{$key}}" {{Request::input('filter') == 'bulan' ?Request::input('bulantahun') == $key ?'selected':'':''}}>{{$key}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- GROUP 3 FILTER PER TAHUN --}}
                    <div class="thn col-md-1">
                        <div class="custom-control custom-radio mb-2">
                        <input class="custom-control-input" data-id="0" type="radio" id="radiotahun" name="filter" value="tahun" {{Request::input('filter') == 'tahun' ?'checked':''}}>
                        <label for="radiotahun" class="custom-control-label">Per Tahun</label>
                        </div>
                        <select class="filter form-control form-control-sm" name="tahun">
                            @foreach ($tahun as $key=> $item)
                            <option value="{{$key}}" {{Request::input('filter') == 'tahun' ?Request::input('tahun') == $key ?'selected':'':''}}>{{$key}}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- GROUP 4 FILTER PER CABANG --}}
                    @if (auth()->user()->level_id == 1)
                    <div class="cbng col-md-2">
                        <label for="radiocabang">Cabang</label>
                        <select class="form-control form-control-sm" name="cabang">
                            <option value="0" {{Request::input('filter') == 'cabang' ?Request::input('cabang') == '0' ?'selected':'':''}}>Semua</option>
                            @foreach ($branches as $branch)
                            <option value="{{$branch->id}}" {{Request::input('cabang') == $branch->id ?'selected':''}}>{{$branch->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                    {{-- GROUP 5 FILTER STATUS --}}
                    <div class="col-md-2">
                        <label for="radiostatus">Status</label>
                        <select class="form-control form-control-sm" name="status">
                            <option value="0" {{Request::input('status') == '0' ?'selected':''}}>Semua</option>
                            <option value="lunas" {{Request::input('status') == 'lunas' ?'selected':''}}>Lunas</option>
                            <option value="utang" {{Request::input('status') == 'utang' ?'selected':''}}>Utang</option>
                            <option value="pelunasan" {{Request::input('status') == 'pelunasan' ?'selected':''}}>Pelunasan</option>
                        </select>
                    </div>

                    {{-- GROUP 6 BUTTON FILTER --}}
                    <div class="butn col-md-2">
                        <input id="downloadble" type="hidden" name="print">
                        <div class="form-row">
                            <div class="col p-0">
                                <button type="submit" id="btn-filter" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></button>
                            </div>
                            <div class="col p-0">
                                <button id="btn-print" type="submit" class="btn btn-sm btn-primary"><i class="fa fa-print"></i></button>
                            </div>
                            <div class="col p-0">
                                <a href="{{route('penjualan.index')}}" class="btn btn-sm btn-primary"><i class="fa fa-refresh"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
          @if ( Request::input('filter') == "hari")
          <table id="example1" style="width:100%" class="table table-sm table-striped display compact">
            <thead>
              <tr class="header">
                <th style="width:5%" class="py-2 text-center">No</th>
                <th style="width:10%" class="py-2 text-center">Nota Kas</th>
                <th style="width:17%" class="py-2 text-center">Tanggal</th>
                <th style="width:24%" class="py-2 text-center">Pelanggan</th>
                <th style="width:2%" class="py-2 text-right"></th>
                <th style="width:14%" class="py-2 text-center">Total</th>
                <th style="width:2%" class="py-2 text-right"></th>
                <th style="width:14%" class="py-2 text-center">Utang</th>
                <th style="width:10%" class="py-2 text-center">Status</th>
                <th style="width:10%" class="py-2 text-center">Cabang</th>
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
                <td class="text-center">{{$loop->iteration}}</td>
                <td class="text-center"><a  href="{{route('penjualan.detail',$bill->id)}}">{{$bill->no_nota_kas}}</a></td>
                <td class="text-center">{{$bill->tanggal_nota->day.' '.$bill->tanggal_nota->monthName.' '.$bill->tanggal_nota->year}}</td>
                <td><a  href="{{route('pelanggan.detail',$bill->customer->id)}}">{{$bill->customer->nama}}</a></td>
                <td class="text-right">Rp</td>
                <td class="text-right"><span class="harga">{{$bill->total_nota}}</span>,-</td>
                <td class="text-right">Rp</td>
                @if($bill->kembalian_nota < 0)
                    <td class="text-right"><span class="harga">{{abs($bill->kembalian_nota)}}</span>,-</td>
                @else
                    <td class="text-right">0,-</td>
                @endif
                  <td class="text-center">{{strtoupper($bill->status)}}</td>
                  <td class="text-center"><a  href="{{route('cabang.detail',$bill->branch->id)}}">{{ $bill->branch->nama }}</a></td>
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
                <th class="text-right">Jumlah</th>
                <th class="text-right">Rp </th>
                <th class="text-right"><span class="harga">{{$total}}</span>,-</th>
                <th class="text-right">Rp </th>
                <th class="text-right"><span class="harga">{{$totalpiutang}}</span>,-</th>
                <th></th>
                <th></th>
              </tr>
              <tr>
                <th class="border-bawah"></th>
                <th class="border-bawah"></th>
                <th class="border-bawah"></th>
                <th class="border-bawah text-right">Jumlah Kas</th>
                <th class="text-right border-bawah">Rp </th>
                <th class="text-right border-bawah"><span class="harga">{{$total-$totalpiutang}}</span>,-</th>
                <th class="border-bawah"></th>
                <th class="border-bawah"></th>
                <th class="border-bawah"></th>
                <th class="border-bawah"></th>
              </tr>
            </tfoot>
          </table>
          @elseif(Request::input('filter') == "bulan" || Request::input('filter') == "tahun")
          <table id="table2" style="width:100%" class="table table-sm table-striped display compact dt-responsive nowrap">
            <thead>
              <tr>
                <th style="width:5%" class="py-2 text-center">No</th>
                <th style="width:10%" class="py-2 text-center">{{Request::input('filter') == "bulan"?"Tanggal":"Bulan"}}</th>
                <th style="width:15%" class="py-2 text-center">Penjualan</th>
                <th style="width:2%" class="py-2 text-right"></th>
                <th style="width:13%" class="py-2 text-center">Nominal</th>
                <th style="width:15%" class="py-2 text-center">Utang</th>
                <th style="width:2%" class="py-2 text-right"></th>
                <th style="width:13%" class="py-2 text-center">Nominal</th>
                <th style="width:2%" class="py-2 text-right"></th>
                <th style="width:13%" class="py-2 text-center">Kas</th>
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
                <td class="text-center">{{$loop->iteration}}</td>
                <td class="text-center">{{$item['tanggal']}}</td>
                <td class="text-center">{{$item['penjualan']}}</td>
                <td class="text-right">Rp</td>
                <td class="text-right"><span class="harga">{{$item['nominal_penjualan']}}</span>,-</td>
                <td class="text-center">{{$item['piutang']}}</td>
                <td class="text-right">Rp</td>
                <td class="text-right"><span class="harga">{{abs($item['nominal_piutang'])}}</span>,-</td>
                <td class="text-right">Rp</td>
                <td class="text-right"><span class="harga">{{$item['kas']}}</span>,-</td>
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
                <th class="border-bawah"></th>
                <th class="border-bawah text-center">JUMLAH</th>
                <th class="border-bawah text-center">{{$totalpenjualan}}</th>
                <th class="border-bawah text-right">Rp</th>
                <th class="text-right border-bawah"><span class="harga">{{$totalnominalpenjualan}}</span>,-</th>
                <th class="border-bawah text-center">{{$totalpiutang}}</th>
                <th class="border-bawah text-right">Rp</th>
                <th class="text-right border-bawah"><span class="harga">{{abs($totalnominalpiutang)}}</span>,-</th>
                <th class="border-bawah text-right">Rp</th>
                <th class="text-right border-bawah"><span class="harga"> {{$totalkas}}</span>,-</th>
              </tr>
            </tfoot>
          </table>
          @else
          <table id="empty_table" style="width:100%" class="table table-sm display compact">
            <thead>
              <tr class="header">
                <th style="width:5%" class="py-2 text-center">No</th>
                <th style="width:15%" class="py-2 text-center">Nota Kas</th>
                <th style="width:15%" class="py-2 text-center">Tanggal</th>
                <th style="width:25%" class="py-2 text-center">Pelanggan</th>
                <th style="width:2%" class="py-2 text-right"></th>
                <th style="min-width:2%" class="py-2 text-center">Total</th>
                <th style="width:2%" class="py-2 text-right"></th>
                <th style="min-width:2%" class="py-2 text-center">Utang</th>
                <th style="width:10%" class="py-2 text-center">Status</th>
                <th style="width:10%"class="py-2 text-center">Cabang</th>
              </tr>
            </thead>
            <tbody>
              @php
              $total = 0;
              $totalkas = 0;
              $totalpiutang =0;
              @endphp
              <tr>
                <td class="text-center border-bawah" colspan="10" style="font-size:12px">Silahkan pilih filter untuk melihat daftar penjualan!</td>
             </tr>
            </tbody>

            {{-- <tfoot>
              <tr>
                <th></th>
                <th></th>
                <th></th>
                <th>Jumlah</th>
                <th class="text-right">Rp </th>
                <th class="text-right"><span class="harga">{{$total}}</span>,-</th>
                <th class="text-right">Rp </th>
                <th class="text-right"><span class="harga">{{$totalpiutang}}</span>,-</th>
                <th></th>
                <th></th>
              </tr>
              <tr>
                <th class="border-bawah"></th>
                <th class="border-bawah"></th>
                <th class="border-bawah"></th>
                <th class="border-bawah">Jumlah Kas</th>
                <th class="text-right border-bawah">Rp </th>
                <th class="text-right border-bawah"><span class="harga">{{$total-$totalpiutang}}</span>,-</th>
                <th class="border-bawah"></th>
                <th class="border-bawah"></th>
                <th class="border-bawah"></th>
                <th class="border-bawah"></th>
              </tr>
            </tfoot> --}}
          </table>
          @endif
        </form>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col -->
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
  $('#btn-print').click((e)=>{
        e.preventDefault()
        $('#downloadble').val('print')
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
