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
    <div class="row class="py-2"">
      <div class="col-6">
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
        <div class="card-header">
            <h3 class="card-title">Daftar Piutang</h3>
          </div>
        <div class="card-body">
          <form id="form-filter" action="{{route('piutang.index')}}" method="GET">
            <div class="row">
              <div class="col-md-4">
                <div class="custom-control custom-radio">
                  <input class="custom-control-input" data-id="0" type="radio" id="hari" name="filter" value="hari" {{Request::input('filter') == 'hari' ?'checked':''}}>
                  <label for="hari" class="custom-control-label">Pilih Tanggal</label>
                </div>
              </div>
              @if (auth()->user()->level_id ==1)
              <div class="col-md-2">
                <div class="custom-control custom-radio">
                  <input class="custom-control-input" data-id="0" type="radio" id="cabang" name="filter2" value="cabang" {{Request::input('filter2') == 'cabang' ?'checked':''}}>
                  <label for="cabang" class="custom-control-label">Cabang</label>
                </div>
              </div>
              @endif
            </div>
            <div class="row mb-4">
              <div class="col-md-4">
                <div class="form-group">
                  <div class="input-group">
                    <input name="hari" type="text" value="{{Request::input('filter') == 'hari' ?Request::input('hari'):''}}" class="form-control form-control-sm float-right" id="tanggal">
                    <div class="input-group-append">
                      <span class="input-group-text"><i class="far fa-calendar"></i></span>
                    </div>
                  </div>
                </div>
              </div>
              @if (auth()->user()->level_id == 1)
              <div class="col-md-2">
                <select class="form-control form-control-sm" name="cabang">
                  <option value="0">Semua</option>
                  @foreach ($branches as $branch)
                  <option value="{{$branch->id}}" {{Request::input('filter2') == 'cabang' ?Request::input('cabang') == $branch->id ?'selected':'':''}}>{{$branch->nama}}</option>
                  @endforeach
                </select>
              </div>
              @endif

              <div class="col-md-3">
                <input id="downloadble" type="hidden" name="pdf">
                <button type="submit" id="btn-filter" class="btn btn-sm btn-primary"><i class="nav-icon fas fa-eye"></i></button>
                <button id="btn-pdf" type="submit" class="btn btn-sm btn-primary"><i class="nav-icon fas fa-print"></i></button>
                <a href="#" onClick="window.location.reload();" class="btn btn-sm btn-primary"><i class="nav-icon fas fa-sync"></i></a>
              </div>
            </div>
          </form>
          <table id="example1" class="table table-striped compact">
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
              @foreach ($bills as $bill)
              <tr>
                <td class="py-2">{{$loop->iteration}}</td>
                <td class="py-2"><a href="{{route('piutang.detail',$bill->id)}}">{{$bill->no_nota_kas}}</a></td>
                <td class="py-2"><a href="{{route('pelanggan.detail',$bill->customer->id)}}">{{$bill->customer->nama}}</a></td>
                <td class="py-2">{{$bill->customer->alamat}}</td>
                <td class="py-2">{{$bill->customer->telepon}}</td>
                <td class="py-2 text-right">Rp <span class="harga">{{abs($bill->kembalian_nota)}}</span>,-</td>
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
    $('#btn-pdf').click((e)=>{
        e.preventDefault()
        $('#downloadble').val('download')
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
