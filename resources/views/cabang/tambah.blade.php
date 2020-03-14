@extends('layouts.master')
@push('css')
<style>
    .form-group{
        margin-bottom: .5rem !important;
    }
    .form-control.form-control-sm:focus{
        color: black;
    }
    .card-title{
        color: black;
    }
</style>
@endpush
@section('breadcumb')
<li class="breadcrumb-item">Beranda</li>
<li class="breadcrumb-item">Cabang</li>
<li class="breadcrumb-item active"><a href="#">Membuat</a></li>
@endsection
@section('content')
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="card">
            <div class="card-body">
                <form class="form-horizontal" action="{{route('cabang.simpan')}}" method="POST">
                    <div class="d-flex justify-content-between mb-3">
                        <div>
                            <h4 class="card-title mb-0 text-bold">Menambahkan Cabang</h4>
                        </div>
                        <div class="btn-toolbar d-none d-md-block" role="toolbar" aria-label="Toolbar with buttons">
                            <button type="submit" class="btn  btn-primary mr-5" style="width: 78px !important;"><i class="fa fa-save"></i></button>
                            <a class="btn btn-danger"  href="javascript:void(0)" onclick="history.back();"><i class="fa fa-times"></i></a>
                        </div>
                    </div>
                    @csrf
                    <div class="form-group row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" value="{{ old('nama')}}" name="nama" class="form-control form-control-sm {{ $errors->first('nama')?'is-invalid':'' }}" id="nama" placeholder="Nama">
                            <div class="invalid-feedback">
                                {{$errors->first('nama')}}
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kode" class="col-sm-2 col-form-label">Kode</label>
                        <div class="col-sm-10">
                            <input type="text" value="{{ old('kode')}}" name="kode" class="form-control form-control-sm {{ $errors->first('kode')?'is-invalid':'' }}" id="kode" placeholder="2 digit kode">
                            <div class="invalid-feedback">
                                {{$errors->first('kode')}}
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="telepon" class="col-sm-2 col-form-label">Telepon</label>
                        <div class="col-sm-10">
                            <input type="text" value="{{ old('telepon')}}" name="telepon" class="form-control form-control-sm {{ $errors->first('telepon')?'is-invalid':'' }}" id="telepon" placeholder="Telepon">
                            <div class="invalid-feedback">
                                {{$errors->first('telepon')}}
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="pimpinan" class="col-sm-2 col-form-label">Pimpinan</label>
                        <div class="col-sm-10">
                            <input type="text" value="{{ old('pimpinan')}}" name="pimpinan" class="form-control form-control-sm {{ $errors->first('pimpinan')?'is-invalid':'' }}" id="pimpinan" placeholder="Pimpinan">
                            <div class="invalid-feedback">
                                {{$errors->first('pimpinan')}}
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <textarea for="alamat" name="alamat" class="form-control form-control-sm {{ $errors->first('alamat')?'is-invalid':'' }}" rows="3" placeholder="Alamat">{{ old('alamat')}}</textarea>
                            <div class="invalid-feedback">
                                {{$errors->first('alamat')}}
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="card-footer" style="background:#C5C6C7">
                <p></p>
            </div>
        </div>
      </div>
@endsection
