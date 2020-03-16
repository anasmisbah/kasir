@extends('layouts.master')

@push('css')
<!-- DataTables -->
<link rel="stylesheet" href="/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
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
      text-align: center;
        border-top: 1px solid black;
        border-bottom: 1px solid black;
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
<li class="breadcrumb-item active"><a href="#">Pengguna</a></li>
@endsection

@section('content')
    <div class="col-12">
      <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <div>
                <h4 class="card-title mb-0">Daftar Pengguna</h4>
                </div>
                <div class="btn-toolbar d-none d-md-block" role="toolbar" aria-label="Toolbar with buttons">
                    <a class="btn btn-primary"  href="{{ route('pengguna.tambah') }}"><i class="fa fa-plus"></i></a>
                </div>
            </div>
            @if (auth()->user()->level_id == 1)
            <form id="form-filter" action="{{route('pengguna.index')}}" method="GET">
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
                        <a href="{{route('pengguna.index')}}" class="btn btn-sm btn-primary"><i class="fa fa-refresh"></i></a>
                    </div>
                </div>
            </form>
            @endif
            <table id="example1" style="width:100%" class="table table-sm table-striped display compact">
                <thead>
                <tr>
                    <th class="py-2">No</th>
                    <th class="py-2">Nama Pengguna</th>
                    <th class="py-2">Nama Lengkap</th>
                    <th class="py-2">Email</th>
                    <th class="py-2">Level</th>
                    <th class="py-2">Cabang</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                        <tr>
                            <td class="text-center">{{$loop->iteration}}</td>
                            <td><a href="{{route('pengguna.detail',$user->id)}}">{{ $user->username }}</a></td>
                            <td><a href="{{route('karyawan.detail',$user->employee->id)}}">{{ $user->employee->nama }}</a></td>
                            <td class="text-center">{{ $user->email }}</td>
                            <td class="text-center">{{ $user->level->nama }}</td>
                            <td class="text-center"><a href="{{route('cabang.detail',$user->employee->branch->id)}}">{{ $user->employee->branch->nama }}</a></td>
                        </tr>
                @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td class="border-atas p-0" colspan="6"></td>
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
<script>
  $(function() {
    $("#example1").DataTable({
        "ordering": false,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Indonesian.json"
        }
    });

    $('#btn-print').click((e)=>{
        e.preventDefault()
        $('#downloadble').val('bill')
        $('#form-filter').attr('target','_blank')
        $('#form-filter').submit()
        $('#downloadble').val('')
    })
  });
</script>
@endpush
