@extends('layouts.master')

@push('css')
<link rel="stylesheet" href="/adminlte/plugins/select2/css/select2.min.css">
<style>
    .form-group{
        margin-bottom: .5rem !important;
    }
    .form-control.form-control-sm:focus{
        border-color: #39f;
        box-shadow: 0 0 0 0.2rem rgba(51, 153, 255, 0.25);
        color: black;
    }
    .card-title{
        color: black;
    }
</style>
@endpush
@section('breadcumb')
<li class="breadcrumb-item">Beranda</li>
<li class="breadcrumb-item">Stok Barang</li>
<li class="breadcrumb-item active"><a href="#"  class="text-info">Membuat</a></li>
@endsection

@section('content')
<div class="col-12 ">
    <div class="card">
        <div class="card-body">
        <div class="d-flex justify-content-between mb-3">
            <div>
            <h4 class="card-title mb-0 text-bold">Menambahkan Stok Barang</h4>
            </div>
            <div class="btn-toolbar d-none d-md-block" role="toolbar" aria-label="Toolbar with buttons">
            <a class="btn btn-danger"  href="javascript:void(0)" onclick="history.back();"><i class="fa fa-times"></i></a>
            </div>
        </div>

        <form role="form-horizontal" action="{{route('stok.simpan')}}" method="POST">
            @csrf
                <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Barang</label>
                        <div class="col-sm-10"><select id="barang" class="form-control  form-control-sm select2 {{ $errors->first('item_id')?'is-invalid':'' }}" name="item_id">
                            <option selected>--Pilih Barang--</option>
                            @foreach ($items as $item)
                                <option value="{{$item->id}}">{{$item->nama}}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Barang wajib dipilih
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Cabang</label>
                    <div class="col-sm-10"><input type="text" value="{{$branch->nama}}" disabled class="form-control  form-control-sm" ></div>
                    <input type="hidden" value="{{$branch->id}}" name="branch_id">
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Harga Pusat</label>
                    <div class="col-sm-10"><input type="text" id="harga_pusat" disabled class="form-control  form-control-sm inputharga" name="harga_pusat" placeholder="harga pusat"></div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Harga Cabang</label>
                    <div class="col-sm-10"><input type="text" value="{{ old('harga_cabang')}}"  id="harga_cabang" disabled class="form-control  form-control-sm {{ $errors->first('harga_cabang')?'is-invalid':'' }} inputharga" name="harga_cabang" placeholder="Masukkan Harga Cabang {{$branch->nama}}">
                        <div class="invalid-feedback">
                            {{$errors->first('harga_cabang')}}
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Selisih</label>
                    <div class="col-sm-10"><input type="text" id="selisih" disabled class="form-control  form-control-sm inputharga" name="harga_selisih" placeholder="selisih"></div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Stok (Kg)</label>
                    <div class="col-sm-10"><input type="number" step="0.01"  value="{{ old('stok')}}" class="form-control  form-control-sm {{ $errors->first('stok')?'is-invalid':'' }}" name="stok" placeholder="Masukkan Stok Barang">
                        <div class="invalid-feedback">
                            {{$errors->first('stok')}}
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn  btn-info float-right" style="width: 78px !important;"><i class="fa fa-save"></i></button>
            </form>
            </div>

            <div class="card-footer"  style="background:#C5C6C7">
                <p></p>
            </div>
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
            delimiter:'.',
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
