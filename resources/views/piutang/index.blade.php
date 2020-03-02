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
        border-color: #39f;
        box-shadow: 0 0 0 0.2rem rgba(51, 153, 255, 0.25);
        color: black;
    }
    .page-item.active .page-link{
        background-color: #39f;
        border-color: #39f;
    }
    .btn-warning{
        color: white;
    }
    .page-link{
        color: #39f;
    }
    .page-link:focus{
        border-color: #39f;
        box-shadow: 0 0 0 0.2rem rgba(51, 153, 255, 0.25);
    }
    .page-link:hover{
        color: #39f;
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
</style>
@endpush
@section('breadcumb')
<li class="breadcrumb-item">Beranda</li>
<li class="breadcrumb-item active"><a href="#" class="text-info">Piutang</a></li>
@endsection
@section('content')

<section class="content">
  <div class="row">
    <div class="col-12">
      <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <div>
                <h4 class="card-title mb-0">Daftar Piutang</h4>
                </div>
            </div>
            <div class="col-8 pt-3 pb-3 mb-4"  style="background:#EBEBEB;">
                <form id="form-filter" action="{{route('piutang.index')}}" method="GET">
                  <div class="row">
                    <div class="col-md-5">
                        <label for="hari" class="">Pilih Tanggal</label>
                    </div>
                    @if (auth()->user()->level_id ==1)
                    <div class="col-md-2">
                        <label for="cabang" class="">Cabang</label>
                    </div>
                    @endif
                  </div>
                  <div class="row">
                    <div class="col-md-5">
                        <div class="input-group">
                          <input name="hari" type="text" value="{{Request::input('hari')}}" class="form-control form-control-sm float-right" id="tanggal">
                          <div class="input-group-append">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                          </div>
                        </div>
                    </div>
                    @if (auth()->user()->level_id == 1)
                    <div class="col-md-4">
                      <select class="form-control form-control-sm" name="cabang">
                        <option value="0">Semua</option>
                        @foreach ($branches as $branch)
                        <option value="{{$branch->id}}" {{Request::input('cabang') == $branch->id ?'selected':''}}>{{$branch->nama}}</option>
                        @endforeach
                      </select>
                    </div>
                    @endif

                    <div class="col-md-3">
                      <input id="downloadble" type="hidden" name="print">
                      <button type="submit" id="btn-filter" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></button>
                      <button id="btn-print" type="submit" class="btn btn-sm btn-info"><i class="fa fa-print"></i></button>
                      <a href="javascript:void(0)" onClick="location.reload(false);" class="btn btn-sm btn-info"><i class="fa fa-refresh"></i></a>
                    </div>
                  </div>
                </form>
            </div>
            @if (Request::input('hari'))
            <table id="example1" style="width:100%" class="table table-striped compact">
              <thead>
                <tr>
                  <th class="py-2">No.</th>
                  <th class="py-2">No. Nota Bon</th>
                  <th class="py-2 text-center">Nama</th>
                  <th class="py-2 text-center">Alamat</th>
                  <th class="py-2 text-center">Telepon</th>
                  <th class="py-2"></th>
                  <th class="py-2">Piutang</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($bills as $bill)
                  <tr>
                    <td class="py-2">{{$loop->iteration}}</td>
                    <td class="py-2"><a class="text-info" href="{{route('piutang.detail',$bill->id)}}">{{$bill->no_nota_kas}}</a></td>
                    <td class="py-2"><a class="text-info" href="{{route('pelanggan.detail',$bill->customer->id)}}">{{$bill->customer->nama}}</a></td>
                    <td class="py-2">{{$bill->customer->alamat}}</td>
                    <td class="py-2">{{$bill->customer->telepon}}</td>
                    <td class="py-2 text-right">Rp</td>
                    <td class="py-2 text-right"><span class="harga">{{abs($bill->kembalian_nota)}}</span>,-</td>
                  </tr>
                  @endforeach
              </tbody>
            </table>
            @else
            <table id="empty_table" style="width:100%" class="table table-striped compact">
                <thead>
                  <tr>
                    <th class="py-2">No.</th>
                    <th class="py-2">No. Nota Bon</th>
                    <th class="py-2">Nama</th>
                    <th class="py-2">Alamat</th>
                    <th class="py-2">Telepon</th>
                    <th class="py-2 text-right">Piutang</th>
                  </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center" colspan="6" style="font-size:12px">Silahkan Pilih Filter Untuk Melihat Daftar Piutang</td>
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
