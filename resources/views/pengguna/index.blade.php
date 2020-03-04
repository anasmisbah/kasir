@extends('layouts.master')

@push('css')
<!-- DataTables -->
<link rel="stylesheet" href="/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
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
    .table thead th{
        border-top: 1px solid black;
        border-bottom: 1px solid black;
    }
</style>
@endpush
@section('breadcumb')
<li class="breadcrumb-item">Beranda</li>
<li class="breadcrumb-item active"><a href="#" class="text-info">Pengguna</a></li>
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
                    <a class="btn btn-info"  href="{{ route('pengguna.tambah') }}"><i class="fa fa-plus"></i></a>
                </div>
            </div>
            <div class="col-5 pt-3 pb-3 mb-4" style="background:#EBEBEB">
                <form id="form-filter" action="{{route('pengguna.index')}}" method="GET">
                    <div class="row">
                        <div class="col-md-2">
                            <label for="cabang" class="">Cabang</label>
                        </div>
                      </div>
                    <div class="row">
                      <div class="col-md-8">
                        <select class="form-control form-control-sm" name="cabang">
                          <option value="0">Semua</option>
                          @foreach ($branches as $branch)
                          <option value="{{$branch->id}}" {{Request::input('cabang') == $branch->id ?'selected':''}}>{{$branch->nama}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="col-md-4">
                        <input id="downloadble" type="hidden" name="print">
                        <button type="submit" id="btn-filter" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></button>
                        <button id="btn-print" type="submit" class="btn btn-sm btn-info" ><i class="fa fa-print"></i></button>
                        <a href="javascript:void(0)" onClick="window.location.reload();" class="btn btn-sm btn-info"><i class="fa fa-refresh"></i></a>
                      </div>
                    </div>
                </form>
            </div>
          <table id="example1" style="width:100%" class="table table-striped display compact dt-responsive nowrap">
            <thead>
              <tr>
                <th class="py-2">No.</th>
                <th class="py-2">Nama Pengguna</th>
                <th class="py-2">Nama lengkap</th>
                <th class="py-2">Email</th>
                <th class="py-2">Level</th>
                <th class="py-2">Cabang</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($users as $user)
              <tr>
                <td class="py-2 text-left" min-height= "10px">{{$loop->iteration}}</td>
                <td class="py-2 text-left" min-height= "10px"><a class="text-info" href="{{route('pengguna.detail',$user->id)}}">{{ $user->username }}</a></td>
                <td class="py-2 text-left" min-height= "10px"><a class="text-info" href="{{route('karyawan.detail',$user->employee->id)}}">{{ $user->employee->nama }}</a></td>
                <td class="py-2 text-left" min-height= "10px">{{ $user->email }}</td>
                <td class="py-2" min-height= "10px">{{ $user->level->nama }}</td>
                <td class="py-2" min-height= "10px"><a class="text-info" href="{{route('cabang.detail',$user->employee->branch->id)}}">{{ $user->employee->branch->nama }}</a></td>
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
