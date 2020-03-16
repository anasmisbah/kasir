@extends('layouts.master')
@push('css')
<!-- DataTables -->
<link rel="stylesheet" href="/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
<link rel="stylesheet" href="/adminlte/plugins/select2/css/select2.min.css">
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
    .table thead th{
        border-top: 1px solid black;
        border-bottom: 1px solid black;
    }
    .table th,.table td{
        padding-top: 0.3rem !important;
        padding-bottom: 0.3rem !important;
        text-align: center;
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
<li class="breadcrumb-item active"><a href="#" >Pelanggan</a></li>
@endsection
@section('content')
    <div class="col-12">
      <div class="card">
        <div class="card-header">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3">
                    <div>
                    <h4 class="card-title mb-0">Daftar Pelanggan Toko</h4>
                    </div>
                    <div class="btn-toolbar d-none d-md-block" role="toolbar" aria-label="Toolbar with buttons">
                        {{-- @if (auth()->user()->level_id == 2)
                        <a class="btn btn-primary"  href="{{ route('pelanggan.tambah') }}"><i class="fa fa-plus"></i></a>
                        @endif --}}
                    </div>
                </div>
          @if (auth()->user()->level_id == 1)
            <form id="form-filter" action="{{route('pelanggan.index')}}" method="GET">
                <div class="form-row col-5 mx-0 my-3 py-3" style="background:#EBEBEB;">
                    <div class="col-8">
                        <label for="cabang" class="">Cabang</label>
                        <select class="form-control form-control-sm" name="cabang">
                            <option value="0">Semua</option>
                            @foreach ($branches as $branch)
                            <option value="{{$branch->id}}" {{Request::input('cabang') == $branch->id ?'selected':''}}>{{$branch->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-4" style="margin-top:28px">
                        <input id="downloadble" type="hidden" name="print">
                        <button type="submit" id="btn-filter" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></button>
                        <button id="btn-print" type="submit" class="btn btn-sm btn-primary"><i class="fa fa-print"></i></button>
                        <a href="{{route('pelanggan.index')}}" class="btn btn-sm btn-primary"><i class="fa fa-refresh"></i></a>
                    </div>
                </div>
            </form>
          @endif
          <table id="example1" style="width:100%" class="table table-sm table-striped compact">
            <thead>
              <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Telepon</th>
                <th>Cabang</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($customers as $customer)
              <tr>
                <td class="text-center">{{$loop->iteration}}</td>
                <td class="text-left"><a  href="{{route('pelanggan.detail', $customer->id)}}">{{$customer->nama}}</a></td>
                <td class="text-left">{{$customer->alamat}}</td>
                <td>{{$customer->telepon}}</td>
                <td><a  href="{{route('cabang.detail', $customer->branch->id)}}">{{$customer->branch->nama}}</a></td>
              </tr>
              @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td class="border-atas p-0" colspan="5"></td>
                </tr>
            </tfoot>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
@endsection

@push('script')
<!-- DataTables -->
<script src="/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="/adminlte/plugins/select2/js/select2.full.min.js"></script>
<script>
  $(function() {
    $("#example1").DataTable({
        "ordering": false,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Indonesian.json"
        }
    });
    $('.select2').select2()
  });
  $('#btn-filter').click((e)=>{
        e.preventDefault()
        $('#downloadble').val('')
        $('#form-filter').attr('target','_self')
        $('#form-filter').submit()
    })
    $('#btn-print').click((e)=>{
        e.preventDefault()
        $('#downloadble').val('customer')
        $('#form-filter').attr('target','_blank')
        $('#form-filter').submit()
    })
</script>
@endpush
