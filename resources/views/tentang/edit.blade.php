@extends('layouts.master')
@push('css')
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
<li class="breadcrumb-item">Tentang Aplikasi</li>
<li class="breadcrumb-item active"><a href="#"  class="text-info">Memperbarui</a></li>
@endsection
@section('content')
<div  class="col-12">
    <div class="card">
        <div class="card-body">
        <div class="d-flex justify-content-between mb-3">
            <div>
                <h4 class="card-title mb-0 text-bold">Memperbarui Tentang Aplikasi</h4>
                </div>
                <div class="btn-toolbar d-none d-md-block" role="toolbar" aria-label="Toolbar with buttons">
                <a class="btn btn-danger"  href="{{ route('tentang.index') }}"><i class="fa fa-times"></i></a>
            </div>
        </div>

        <form class="form-horizontal" action="{{route('tentang.perbarui',$app->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
                <div class="form-group row">
                    <label class="col-2">Logo</label>
                    <div class="col-4">
                        <img id="img_foto" width="125px" style="margin-bottom:3px" alt="logo" src="{{asset('/storage/'.$app->logo)}}">
                        <input type="file" id="foto" name="logo">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2">Nama Aplikasi:</label>
                    <div class="col-10"><input type="text" value="{{ old('nama')?old('nama'):$app->nama }}" class="form-control form-control-sm {{ $errors->first('nama')?'is-invalid':'' }}" name="nama" placeholder="Masukkan Nama">
                        <div class="invalid-feedback">
                            {{$errors->first('nama')}}
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2">Nama Toko:</label>
                    <div class="col-10"><input type="text" value="{{ old('toko')?old('toko'):$app->toko }}" class="form-control form-control-sm {{ $errors->first('toko')?'is-invalid':'' }}" name="toko" placeholder="Masukkan Jabatan">
                        <div class="invalid-feedback">
                            {{$errors->first('toko')}}
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2">Alamat:</label>
                    <div class="col-10"><input type="text" value="{{ old('alamat')?old('alamat'):$app->alamat }}" class="form-control form-control-sm {{ $errors->first('alamat')?'is-invalid':'' }}" name="alamat" placeholder="Masukkan Alamat Karyawan">
                        <div class="invalid-feedback">
                            {{$errors->first('alamat')}}
                        </div>

                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2">Telepon</label>
                    <div class="col-10"><input type="text" value="{{ old('telepon')?old('telepon'):$app->telepon }}" class="form-control form-control-sm {{ $errors->first('telepon')?'is-invalid':'' }} {{ $errors->first('telepon')?'is-invalid':'' }}" name="telepon" placeholder="Masukkan Telepon Karwayan">
                        <div class="invalid-feedback">
                            {{$errors->first('telepon')}}
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn  btn-info float-right " style="width: 78px !important;"><i class="fa fa-save"></i></button>
            </form>
            </div>
            <div class="card-footer text-right" style="background:#C5C6C7">
                <span style="font-size: 12px">
                    <strong>Dibuat Pada: </strong>{{  $app->created_at->dayName." | ".$app->created_at->day." ".$app->created_at->monthName." ".$app->created_at->year}} | {{$app->created_at->format('h:i:s')}} WIB | <a href="{{route('karyawan.detail',$app->createdBy->employee->id)}}" class="text-info">{{$app->createdBy->employee->nama}}</a> / <strong>Diubah Pada: </strong>{{  $app->updated_at->dayName." | ".$app->updated_at->day." ".$app->updated_at->monthName." ".$app->updated_at->year}} | {{$app->updated_at->format('h:i:s')}} WIB | <a href="{{route('karyawan.detail',$app->updatedBy->employee->id)}}"  class="text-info">{{$app->updatedBy->employee->nama}}</a>
                  </span>
            </div>
    </div>
</div>
@endsection

@push('script')
<script>
    //menampilkan foto setiap ada perubahan pada modal tambah
    $('#foto').on('change', function() {
        readURL(this);
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#img_foto').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
