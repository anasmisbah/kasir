@extends('layouts.master')
@push('css')
<!-- DataTables -->
<link rel="stylesheet" href="/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
<link rel="stylesheet" href="/adminlte/plugins/daterangepicker/daterangepicker.css">
<style>
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
    .border-bawah{
        border-bottom: 1px solid black !important;
    }
    table.dataTable.table-sm > thead > tr > th{
        padding-right: 0;
    }
    .border-atas{
        border-top: 1px solid black !important;
    }
</style>
@endpush
@section('breadcumb')
<li class="breadcrumb-item">Beranda</li>
<li class="breadcrumb-item active"><a href="#" >Piutang</a></li>
@endsection
@section('content')
    <div class="col-12">
      <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <div>
                    <h4 class="card-title mb-0">Daftar Piutang</h4>
                </div>
            </div>

            <form id="form-filter" action="{{route('piutang.index')}}" method="GET">
                <div class="form-row col-8 mx-0 my-3 py-3" style="background:#EBEBEB;">
                    <div class="col-5">
                        <label for="hari" class="">Tanggal</label>
                        <div class="input-group">
                            <input name="hari" type="text" value="{{Request::input('hari')}}" class="form-control form-control-sm float-right" id="tanggal">
                            <div class="input-group-append">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <label for="cabang" class="">Cabang</label>
                        <select class="form-control form-control-sm" name="cabang">
                            <option value="0">Semua</option>
                            @foreach ($branches as $branch)
                            <option value="{{$branch->id}}" {{Request::input('cabang') == $branch->id ?'selected':''}}>{{$branch->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                  <div class="col" style="margin-top:28px">
                    <input id="downloadble" type="hidden" name="print">
                    <button type="submit" id="btn-filter" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></button>
                    <button id="btn-print" type="submit" class="btn btn-sm btn-primary"><i class="fa fa-print"></i></button>
                    <a href="{{route('piutang.index')}}" class="btn btn-sm btn-primary"><i class="fa fa-refresh"></i></a>
                  </div>
                </div>
            </form>
            @if (Request::input('hari'))
            <table id="example1" style="width:100%" class="table table-sm table-striped">
              <thead>
                <tr>
                  <th style="width:3%" class="text-center">No.</th>
                  <th style="width:10%" class="text-center">No. Nota Bon</th>
                  <th style="width:15%" class="text-center">Nama Pelanggan</th>
                  <th style="width:25%" class="text-center">Alamat</th>
                  <th style="width:10%" class="text-center">Telepon</th>
                  <th style="width:3%" class="text-right"></th>
                  <th style="width:10%" class="text-center">Utang</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($bills as $bill)
                  <tr>
                    <td class=" text-center">{{$loop->iteration}}</td>
                    <td class=" text-center"><a  href="{{route('piutang.detail',$bill->id)}}">{{$bill->no_nota_kas}}</a></td>
                    <td ><a  href="{{route('pelanggan.detail',$bill->customer->id)}}">{{$bill->customer->nama}}</a></td>
                    <td >{{$bill->customer->alamat}}</td>
                    <td class="text-center">{{$bill->customer->telepon}}</td>
                    <td class="text-right">Rp</td>
                    <td class="text-right"><span class="harga">{{abs($bill->kembalian_nota)}}</span>,-</td>
                  </tr>
                  @endforeach
              </tbody>
                <tfoot>
                    <tr>
                        <td class="border-atas p-0" colspan="7"></td>
                    </tr>
                </tfoot>
            </table>
            @else
            <table id="empty_table" style="width:100%" class="table table-sm compact">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>No. Nota Bon</th>
                    <th>Nama Pelanggan</th>
                    <th>Alamat</th>
                    <th>Telepon</th>
                    <th>Utang</th>
                  </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center border-bawah" colspan="7" style="font-size:12px">Silahkan Pilih Filter Untuk Melihat Daftar Piutang</td>
                    </tr>
                </tbody>
              </table>
            @endif
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
        $('#downloadble').val('bill')
        $('#form-filter').attr('target','_blank')
        $('#form-filter').submit()
        $('#downloadble').val('')
    })

    $('#hari').click((e)=>{
        const propCheck = $('#hari').is(':checked');
        const data = $('#hari').data('id');
        if(data == "0") {
            $("#hari").prop("checked", true);
            $('#hari').data('id','1');
        } else {
            $("#hari").prop("checked", false);
            $('#hari').data('id','0');
        }
    })

    $('#cabang').click((e)=>{
        const propCheck = $('#cabang').is(':checked');
        const data = $('#cabang').data('id');
        if(data == "0") {
            $("#cabang").prop("checked", true);
            $('#cabang').data('id','1');
        } else {
            $("#cabang").prop("checked", false);
            $('#cabang').data('id','0');
        }
    })
</script>
@endpush
