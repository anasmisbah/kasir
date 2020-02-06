@extends('layouts.master')

@push('css')
<!-- DataTables -->
<link rel="stylesheet" href="/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
@endpush

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
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
          <div class="card-tools">
            <ul class="nav nav-pills ml-auto">
              <li class="nav-item">
                <a class="nav-link active" href="{{ route('karyawan.tambah') }}"><i class="nav-icon fas fa-plus"></i></a>
              </li>
            </ul>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          @if (auth()->user()->level_id == 1)
          <form action="{{route('karyawan.index')}}" method="GET">
            <div class="row">
              <div class="col-md-2">
                <div class="custom-control custom-radio">
                  <input class="custom-control-input" type="radio" id="customRadio1" name="filter" value="cabang" checked>
                  <label for="customRadio1" class="custom-control-label">Cabang</label>
                </div>
              </div>
            </div>
            <div class="row mb-4">
              <div class="col-md-2">
                <select class="form-control select2" name="cabang">
                  <option value="0">Semua</option>
                  @foreach ($branches as $branch)
                  <option value="{{$branch->id}}">{{$branch->nama}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-6">
                <button type="submit" class="btn btn-primary"><i class="nav-icon fas fa-eye"></i></button>
                <button type="submit" class="btn btn-primary" name="pdf" value="download"><i class="nav-icon fas fa-print"></i></button>
                <a href="#" onClick="window.location.reload();" class="btn btn-primary"><i class="nav-icon fas fa-sync"></i></a>
              </div>
            </div>
          </form>
          @endif
          <table id="example1" class="display table table-bordered table-striped">
            <thead>
              <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Alamat</th>
                <th>Telepon</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($employees as $employee)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td><a href="{{route('karyawan.detail',$employee->id)}}">{{$employee->nama}}</a></td>
                <td>{{$employee->jabatan}}</td>
                <td>{{$employee->alamat}}</td>
                <td>{{$employee->telepon}}</td>
              </tr>
              @endforeach

            </tbody>
            <tfoot>
              <th>No.</th>
              <th>Nama</th>
              <th>Alamat</th>
              <th>Jabatan</th>
              <th>Telepon</th>
            </tfoot>
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
<script src="/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script>
  $(function() {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>
@endpush
