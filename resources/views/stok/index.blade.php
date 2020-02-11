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
          <li class="breadcrumb-item">Beranda</li>
          <li class="breadcrumb-item active"><a href="#">Stok Barang</a></li>
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
          <form id="form-filter" action="{{route('stok.index')}}" method="GET">
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
                <select class="form-control form-control-sm " name="cabang">
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
                <a href="{{ route('stok.tambah') }}" class="btn btn-sm btn-primary"><i class="nav-icon fas fa-plus"></i></a>
              </div>
            </div>
          </form>
          <table id="example1" class="table table-striped compact">
            <thead>
              <tr>
                <th style="width: 5%" class="text-left">No.</th>
                <th style="width: 30%" class="text-left">Nama</th>
                <th style="width: 20%" class="text-left">Cabang</th>
                <th style="width: 15%" class="text-right">Harga Pusat</th>
                <th style="width: 15%" class="text-right">Harga Cabang</th>
                <th style="width: 15%" class="text-right">Selisih</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($supplies as $supply)
              <tr>
                <td style="width: 5%" class="text-left">{{ $loop->iteration }}</td>
                <td style="width: 30%" class="text-left"><a href="{{route('stok.detail', $supply->id)}}">{{$supply->item->nama}}</a></td>
                <td style="width: 20%" class="text-left"><a href="{{route('cabang.detail', $supply->branch->id)}}">{{$supply->branch->nama}}</a></td>
                <td style="width: 15%" class="text-right">Rp <span class="harga">{{$supply->item->harga}}</span>,-</td>
                <td style="width: 15%" class="text-right">Rp <span class="harga">{{$supply->harga_cabang}}</span>,-</td>
                <td style="width: 15%" class="text-right">Rp <span class="harga">{{$supply->harga_selisih}}</span>,-</td>
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
<script src="/adminlte/plugins/number-divider.min.js"></script>
<script src="/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="/adminlte/plugins/select2/js/select2.full.min.js"></script>
<script>
  $(function() {
    $("#example1").DataTable();
    $('.select2').select2();
    $(".harga").divide({
      delimiter: '.',
      divideThousand: true
    });
  });

    $('#btn-pdf').click((e)=>{
        e.preventDefault()
        $('#downloadble').val('download')
        $('#form-filter').attr('target','_blank')
        $('#form-filter').submit()
    })
</script>
@endpush
