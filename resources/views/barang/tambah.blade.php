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
<li class="breadcrumb-item">Barang</li>
<li class="breadcrumb-item active"><a href="#"  class="text-info">Membuat</a></li>
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <div>
                        <h4 class="card-title mb-0 text-bold">Membuat Barang Barang</h4>
                        </div>
                        <div class="btn-toolbar d-none d-md-block" role="toolbar" aria-label="Toolbar with buttons">
                        <a class="btn btn-danger"  href="{{ route('barang.index') }}"><i class="fa fa-times"></i></a>
                        </div>
                    </div>
                <form class="form" action="{{route('barang.simpan')}}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label for="inputEmail3"  class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                        <input type="text" value="{{ old('nama')}}" name="nama" class="form-control form-control-sm form-control form-control-sm-sm form-control form-control-sm form-control form-control-sm-sm-sm {{ $errors->first('nama')?'is-invalid':'' }}" id="inputEmail3" placeholder="Nama">
                            <div class="invalid-feedback">
                                {{$errors->first('nama')}}
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputjenis" class="col-sm-2 col-form-label">Jenis</label>
                        <div class="col-sm-10 " style="width: 100%;">
                            <select name="category_id" id="inputjenis" class="form-control form-control-sm form-control form-control-sm-sm form-control form-control-sm form-control form-control-sm-sm-sm" >
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}" {{ old('category_id') == $category->id?'selected':''}}>{{$category->nama}}</option>
                            @endforeach
                            </select>
                        </div>
                            <div class="invalid-feedback">
                                jenis barang wajib dipilih
                            </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputharga" class="col-sm-2 col-form-label">Harga</label>
                        <div class="col-sm-10">
                        <input type="text" value="{{ old('harga')}}" min="0" oninput="validity.valid||(value='');" class="form-control form-control-sm form-control form-control-sm-sm form-control form-control-sm form-control form-control-sm-sm-sm {{ $errors->first('harga')?'is-invalid':'' }} divide" id="inputharga" name="harga" placeholder="Harga">
                            <div class="invalid-feedback">
                                {{$errors->first('harga')}}
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn  btn-info float-right" style="width: 78px !important;"><i class="fa fa-save"></i></button>
                </form>
            </div>
            <div class="card-footer" style="background:#C5C6C7">
                <p></p>
            </div>
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

    // Number Divide
    $("#inputharga").divide({
        delimiter:'.',
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
