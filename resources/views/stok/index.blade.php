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
</style>
@endpush
@section('breadcumb')
<li class="breadcrumb-item">Beranda</li>
<li class="breadcrumb-item active"><a href="#" >Stok Barang</a></li>
@endsection
@section('content')
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <div>
                  <h4 class="card-title mb-0">Daftar Stok Barang</h4>
                </div>
                <div class="btn-toolbar d-none d-md-block" role="toolbar" aria-label="Toolbar with buttons">
                    @if (auth()->user()->level_id == 2)
                    <a class="btn btn-primary"  href="{{ route('stok.tambah') }}"><i class="fa fa-plus"></i></a>
                    @endif
                </div>
              </div>
          <form id="form-filter" action="{{route('stok.index')}}" method="GET">
            @if (auth()->user()->level_id == 1)
                    <div class="col-5 pt-3 pb-3 mb-4" style="background:#EBEBEB">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="cabang" class="">Cabang</label>
                            </div>
                        </div>
                        <div class="row">
                          <div class="col-md-8">
                            <select class="form-control form-control-sm " name="cabang">
                              <option value="0">Semua</option>
                              @foreach ($branches as $branch)
                              <option value="{{$branch->id}}" {{Request::input('cabang') == $branch->id ?'selected':''}}>{{$branch->nama}}</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="col-md-4">
                            <input id="downloadble" type="hidden" name="print">
                            <button type="submit" id="btn-filter" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></button>
                            <button id="btn-print" type="submit" class="btn btn-sm btn-primary"><i class="fa fa-print"></i></button>
                            <a href="{{route('stok.index')}}" class="btn btn-sm btn-primary"><i class="fa fa-refresh"></i></a>
                          </div>
                        </div>
                    </div>
            @endif
          </form>
          <table id="example1" style="width:100%" class="table table-sm table-striped compact">
            <thead>
              <tr>
                <th style="width: 5%" >No.</th>
                <th style="width: 30%">Nama Barang</th>
                <th style="width: 15%" >Cabang</th>
                <th style="width: 10%" >Stok (Kg)</th>
                <th></th>
                <th style="min-width: 10%">Harga Pusat</th>
                <th></th>
                <th style="min-width: 10%">Harga Cabang</th>
                <th></th>
                <th style="min-width: 5%">Selisih</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($supplies as $supply)
              <tr>
                <td  class="text-center">{{ $loop->iteration }}</td>
                <td  class="text-left"><a  href="{{route('stok.detail', $supply->id)}}">{{$supply->item->nama}}</a></td>
                <td  class="text-center"><a  href="{{route('cabang.detail', $supply->branch->id)}}">{{$supply->branch->nama}}</a></td>
                <td  class="text-center">{{$supply->stok}}</td>
                <td class="text-right">Rp</td>
                <td  class="text-right"><span class="harga">{{$supply->item->harga}}</span>,-</td>
                <td class="text-right">Rp</td>
                <td  class="text-right"><span class="harga">{{$supply->harga_cabang}}</span>,-</td>
                <td class="text-right">Rp</td>
                <td  class="text-right"><span class="harga">{{$supply->harga_selisih}}</span>,-</td>
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
@endsection

@push('script')
<!-- DataTables -->
<script src="/adminlte/plugins/number-divider.min.js"></script>
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
    $('.select2').select2();
    $(".harga").divide({
      delimiter: '.',
      divideThousand: true
    });
  });
  $('#btn-filter').click((e) => {
    e.preventDefault()
    $('#downloadble').val('')
    $('#form-filter').attr('target', '_self')
    $('#form-filter').submit()
  })
  $('#btn-print').click((e) => {
    e.preventDefault()
    $('#downloadble').val('supply')
    $('#form-filter').attr('target', '_blank')
    $('#form-filter').submit()
  })
</script>
@endpush
