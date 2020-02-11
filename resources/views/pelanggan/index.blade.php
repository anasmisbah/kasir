@extends('layouts.master')
@push('css')
<!-- DataTables -->
<link rel="stylesheet" href="/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
<link rel="stylesheet" href="/adminlte/plugins/select2/css/select2.min.css">
@endpush
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item ">Beranda</li>
          <li class="breadcrumb-item active"><a href="#">Pelanggan</a></li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<section class="content">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          @if (auth()->user()->level_id == 1)
          <form id="form-filter" action="{{route('pelanggan.index')}}" method="GET">
            <div class="row">
              <div class="col-md-2">
                <div class="custom-control custom-radio">
                  <input class="custom-control-input" type="radio" id="customRadio1" name="filter" value="cabang" {{Request::input('filter') == 'cabang' ?'checked':''}}>
                  <label for="customRadio1" class="custom-control-label">Cabang</label>
                </div>
              </div>
            </div>
            <div class="row mb-4">
              <div class="col-md-2">
                <select class="form-control form-control-sm" name="cabang">
                  <option value="0">Semua</option>
                  @foreach ($branches as $branch)
                  <option value="{{$branch->id}}" {{Request::input('filter') == 'cabang' ?Request::input('cabang') == $branch->id ?'selected':'':''}}>{{$branch->nama}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-6">
                <input id="downloadble" type="hidden" name="pdf">
                <button type="submit" class="btn btn-sm btn-primary"><i class="nav-icon fas fa-eye"></i></button>
                <button id="btn-pdf" type="submit" class="btn btn-sm btn-primary"><i class="nav-icon fas fa-print"></i></button>
                <a href="#" onClick="window.location.reload();" class="btn btn-sm btn-primary"><i class="nav-icon fas fa-sync"></i></a>
                <a href="{{ route('pelanggan.tambah') }}" class="btn btn-sm btn-primary"><i class="nav-icon fas fa-plus"></i></a>
              </div>
            </div>
          </form>
          @endif
          <table id="example1" class="table table-striped compact">
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
                <td>{{$loop->iteration}}</td>
                <td><a href="{{route('pelanggan.detail', $customer->id)}}">{{$customer->nama}}</a></td>
                <td>{{$customer->alamat}}</td>
                <td>{{$customer->telepon}}</td>
                <td><a href="{{route('cabang.detail', $customer->branch->id)}}">{{$customer->branch->nama}}</a></td>
              </tr>
              @endforeach
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
<script src="/adminlte/plugins/select2/js/select2.full.min.js"></script>
<script>
  $(function() {
    $("#example1").DataTable();
    $('.select2').select2()
  });
    $('#btn-pdf').click((e)=>{
        e.preventDefault()
        $('#downloadble').val('download')
        $('#form-filter').attr('target','_blank')
        $('#form-filter').submit()
    })
</script>
@endpush
