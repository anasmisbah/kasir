@extends('layouts.master')

@push('css')
<link rel="stylesheet" href="/adminlte/plugins/select2/css/select2.min.css">
@endpush

@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-6">
          <ol class="breadcrumb float-sm-left">
            <li class="breadcrumb-item">Beranda</li>
            <li class="breadcrumb-item">Stok Barang</li>
            <li class="breadcrumb-item active"><a href="#">Memperbarui</a></li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
<div class="col-12 ">
    <div class="card mt-3">
        <div class="card-header">
            <h3 class="card-title">Ubah Stok Barang</h3>
            <div class="card-tools">
                <ul class="nav nav-pills ml-auto">
                  <li class="nav-item">
                    <a class="nav-link btn-danger active" href="{{ route('stok.index') }}"><i class=" fas fa-times"></i></a>
                  </li>
                </ul>
              </div>
        </div>

        <form role="form-horizontal" action="{{route('stok.perbarui',$supply->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Barang</label>
                        <div class="col-sm-10"><select id="barang" class="form-control form-control-sm select2" name="item_id">
                            @foreach ($items as $item)
                                <option value="{{$item->id}}" {{$item->id == $supply->item_id?"selected":""}}>{{$item->nama}}</option>
                            @endforeach
                        </select></div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Cabang</label>
                    <div class="col-sm-10"><input type="text" value="{{$supply->branch->nama}}" disabled class="form-control form-control-sm" >
                    <input type="hidden" value="{{$supply->branch->id}}" name="branch_id"></div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Harga Pusat</label>
                    <div class="col-sm-10"><input type="text" value="{{$supply->item->harga}}" id="harga_pusat" disabled class="form-control form-control-sm inputharga" name="harga_pusat" placeholder="harga pusat"></div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Harga Cabang</label>
                    <div class="col-sm-10"><input type="text" value="{{$supply->harga_cabang}}" id="harga_cabang" class="form-control form-control-sm {{ $errors->first('harga_cabang')?'is-invalid':'' }} inputharga" name="harga_cabang" placeholder="Masukkan Harga Cabang"></div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Selisih</label>
                    <div class="col-sm-10"><input type="text" value="{{$supply->harga_selisih}}" id="selisih" disabled class="form-control form-control-sm inputharga" name="harga_selisih" placeholder="selisih"></div>
                    <div class="invalid-feedback">
                        {{$errors->first('harga_cabang')}}
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Stok</label>
                    <div class="col-sm-10"><input type="text" value="{{$supply->stok}}" class="form-control form-control-sm {{ $errors->first('stok')?'is-invalid':'' }}" name="stok" placeholder="Masukkan Stok Barang"></div>
                    <div class="invalid-feedback">
                        {{$errors->first('stok')}}
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-lg btn-primary float-right"><i class="fa fa-save"></i></button>
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
});
</script>
<script>
$(document).on('change', '#barang', function () {
    let url = "{{ route('barang.data') }}"
    $.ajax({
        type: 'get',
        url: url,
        data: {
            'id': $("#barang").val(),
        },
        success: function (data) {
            //Menampilkan Error
            $('#harga_pusat').val(data.data.harga)
            $("#harga_cabang").removeAttr('disabled')
            $("#harga_cabang").val(0)
            $("#selisih").val(0)
        },
    });
});

$("#harga_cabang").keyup(function(){
  let hargaPusat = $('#harga_pusat').val()
  let hargaCabang = $(this).val()
  let selisih = hargaCabang - hargaPusat
  $("#selisih").val(selisih)
});
</script>
<script>
    $(function () {
        // Number Divide
        $(".inputharga").divide({
            delimiter:',',
            divideThousand:true
        });

        // Cegah Paid Amount Diisi dengan Huruf
        $(".inputharga").on('keypress', function(keys){
            if(keys.keyCode > 31 && (keys.keyCode < 48 || keys.keyCode > 57)) {
                keys.preventDefault();
            }
        });
    });
    </script>
@endpush
