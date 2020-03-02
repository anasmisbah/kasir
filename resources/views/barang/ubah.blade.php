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
<li class="breadcrumb-item active"><a href="#"  class="text-info">Memperbarui</a></li>
@endsection

@section('content')
<div class="col-12 mt-1">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <div>
                <h4 class="card-title mb-0 text-bold">Memperbarui Barang</h4>
                </div>
                <div class="btn-toolbar d-none d-md-block" role="toolbar" aria-label="Toolbar with buttons">
                <a class="btn btn-danger"  href="{{ route('barang.index') }}"><i class="fa fa-times"></i></a>
                </div>
            </div>
            <form class="form" action="{{route('barang.perbarui',$item->id)}}" method="POST">
            @csrf
            @method('PUT')
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                    <input type="text" value="{{ old('nama')?old('nama'):$item->nama }}"  name="nama" class="form-control form-control-sm form-control form-control-sm-sm form-control form-control-sm form-control form-control-sm-sm-sm {{ $errors->first('nama')?'is-invalid':'' }}" id="inputEmail3" placeholder="Nama">
                    <div class="invalid-feedback">
                        {{$errors->first('nama')}}
                    </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputjenis" class="col-sm-2 col-form-label">Jenis</label>
                    <div class="col-sm-10 " style="width: 100%;">
                        <select name="category_id" id="inputjenis" class="form-control form-control-sm form-control form-control-sm-sm form-control form-control-sm form-control form-control-sm-sm-sm " >
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}" {{ $category->id == $item->category_id?"selected":"" }} >{{$category->nama}}</option>
                        @endforeach
                        </select>
                        <div class="invalid-feedback">
                            jenis barang wajib dipilih
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputharga" class="col-sm-2 col-form-label">Harga</label>
                    <div class="col-sm-10">
                    <input type="text" value="{{ old('harga')?old('harga'):$item->harga }}" min="0" oninput="validity.valid||(value='');" class="form-control form-control-sm form-control form-control-sm-sm form-control form-control-sm form-control form-control-sm-sm-sm {{ $errors->first('harga')?'is-invalid':'' }} divide" id="inputharga" name="harga" placeholder="Harga">
                    <div class="invalid-feedback">
                        {{$errors->first('harga')}}
                    </div>
                    </div>
                </div>
            <button type="submit" class="btn  btn-info float-right" style="width: 78px !important;"><i class="fa fa-save"></i></button>
        </form>
    </div>

        <div class="card-footer text-right" style="background:#C5C6C7">
        <span style="font-size: 12px">
            <strong>Dibuat Pada: </strong>{{  $item->created_at->dayName." | ".$item->created_at->day." ".$item->created_at->monthName." ".$item->created_at->year}} | {{$item->created_at->format('h:i:s')}} WIB | <a href="{{route('karyawan.detail',$item->createdBy->employee->id)}}" class="text-info">{{$item->createdBy->employee->nama}}</a> / <strong>Diubah Pada: </strong>{{  $item->updated_at->dayName." | ".$item->updated_at->day." ".$item->updated_at->monthName." ".$item->updated_at->year}} | {{$item->updated_at->format('h:i:s')}} WIB | <a href="{{route('karyawan.detail',$item->updatedBy->employee->id)}}" class="text-info">{{$item->updatedBy->employee->nama}}</a>      </span>
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
