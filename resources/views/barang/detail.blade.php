@extends('layouts.master')

@push('css')
<link rel="stylesheet" href="/adminlte/plugins/select2/css/select2.min.css">
@endpush

@section('content')
<div class="col-12 mt-1">
<div class="card">
              <div class="card-header">
                <h3 class="card-title">Barang</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form">
                @csrf
                <div class="card-body">
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                    <input type="text" disabled value="{{$item->nama}}"  name="nama" class="form-control" id="inputEmail3" placeholder="Nama">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputjenis" class="col-sm-2 col-form-label">Jenis</label>
                    <div class="col-sm-10 " style="width: 100%;">
                        <input type="text" disabled value="{{$item->category->nama}}"  name="nama" class="form-control" id="inputEmail3" placeholder="Nama">
                    </div>
                  </div>

                <div class="form-group row">
                    <label for="inputharga" class="col-sm-2 col-form-label">Harga</label>
                    <div class="col-sm-10">
                    <input type="text" disabled value="{{$item->harga}}" min="0" oninput="validity.valid||(value='');" class="form-control divide" id="inputharga" name="harga" placeholder="Harga">
                    </div>
                </div>
                <a href="{{ route('barang.ubah',$item->id) }}" class="btn btn-primary float-right"><i class="fa fa-edit"></i></a>
                </div>
            </form>
            </div>
</div>
@endsection

@push('script')
<script src="/adminlte/plugins/number-divider.min.js"></script>
<script src="/adminlte/plugins/select2/js/select2.full.min.js"></script>
<script>
$(function () {
    $('.select2').select2()

    // Number Divide
    $("#inputharga").divide({
        delimiter:',',
        divideThousand:true
    });

    // Cegah Paid Amount Diisi dengan Huruf
    $("#inputharga").on('keypress', function(keys){
        if(keys.keyCode > 31 && (keys.keyCode < 48 || keys.keyCode > 57)) {
            keys.preventDefault();
        }
    });
});
</script>

@endpush
