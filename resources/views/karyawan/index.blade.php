@extends('layouts.master')

@push('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" href="{{asset('adminlte/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">

@endpush

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-6">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item active">Beranda</li>
          <li class="breadcrumb-item"><a href="#">Karyawan</a></li>
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
            <h3 class="card-title">Daftar Karyawan</h3>
            <div class="card-tools">
                <ul class="nav nav-pills ml-auto">
                  <li class="nav-item">
                    <a class="nav-link btn-primary active" href="{{ route('karyawan.tambah') }}"><i class=" fas fa-plus"></i></a>
                  </li>
                </ul>
              </div>
        </div>
        <div class="card-body">
          @if (auth()->user()->level_id == 1)
          <form id="form-filter" action="{{route('karyawan.index')}}" method="GET">
            <div class="row">
                <div class="col-md-2">
                    <label for="cabang" class="">Cabang</label>
                </div>
              </div>
            <div class="row mb-4">
              <div class="col-md-2">
                <select class="form-control form-control-sm" name="cabang">
                  <option value="0">Semua</option>
                  @foreach ($branches as $branch)
                  <option value="{{$branch->id}}" {{Request::input('cabang') == $branch->id ?'selected':''}}>{{$branch->nama}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-6">
                <input id="downloadble" type="hidden" name="pdf">
                <button type="submit" id="btn-filter" class="btn btn-sm btn-primary"><i class="nav-icon fas fa-eye"></i></button>
                <button id="btn-pdf" type="submit" class="btn btn-sm btn-primary" ><i class="nav-icon fas fa-print"></i></button>
                <a href="#" onClick="window.location.reload();" class="btn btn-sm btn-primary"><i class="nav-icon fas fa-sync"></i></a>
              </div>
            </div>
          </form>
          @endif
          <table id="example1" style="width:100%" class="display table table-striped compact dt-responsive nowrap">
            <thead>
              <tr>
                <th class="py-2">No.</th>
                <th class="py-2">Nama</th>
                <th class="py-2">Jabatan</th>
                <th class="py-2">Alamat</th>
                <th class="py-2">Telepon</th>
                <th class="py-2">cabang</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($employees as $employee)
              <tr>
                <td class="py-2">{{$loop->iteration}}</td>
                <td class="py-2"><a href="{{route('karyawan.detail',$employee->id)}}">{{$employee->nama}}</a></td>
                <td class="py-2">{{$employee->jabatan}}</td>
                <td class="py-2">{{$employee->alamat}}</td>
                <td class="py-2">{{$employee->telepon}}</td>
                <td class="py-2"><a href="{{route('cabang.detail',$employee->branch->id)}}">{{$employee->branch->nama}}</a></td>
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
<script src="{{asset('adminlte/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{asset('adminlte/plugins/select2/js/select2.full.min.js')}}"></script>
<script src="/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script>
  $(function() {
    $('.select2').select2();
    $("#example1").DataTable({
        "ordering": false,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Indonesian.json"
        }
    });
    $('#btn-filter').click((e)=>{
        e.preventDefault()
        $('#downloadble').val('')
        $('#form-filter').attr('target','_self')
        $('#form-filter').submit()
    });
    $('#btn-pdf').click((e)=>{
        e.preventDefault()
        $('#downloadble').val('download')
        $('#form-filter').attr('target','_blank')
        $('#form-filter').submit()
    });
  });
</script>
@endpush
