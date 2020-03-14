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
<li class="breadcrumb-item">Pelanggan</li>
<li class="breadcrumb-item active"><a href="#">Membuat</a></li>
@endsection

@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <form role="form-horizontal" action="{{ route('pelanggan.simpan') }}" method="POST">
                <div class="d-flex justify-content-between mb-3">
                    <div>
                        <h4 class="card-title mb-0 text-bold">Menambahkan Pelanggan</h4>
                    </div>
                    <div class="btn-toolbar d-none d-md-block" role="toolbar" aria-label="Toolbar with buttons">
                        <button type="submit" class="btn  btn-primary mr-5" style="width: 78px !important;"><i class="fa fa-save"></i></button>
                        <a class="btn btn-danger"  href="javascript:void(0)" onclick="history.back();"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                @csrf
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" value="{{ old('nama')}}" class="form-control form-control-sm {{ $errors->first('nama')?'is-invalid':'' }}" name="nama" placeholder="Masukkan Nama Pelanggan">
                        <div class="invalid-feedback">
                            {{$errors->first('nama')}}
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <input type="text" value="{{ old('alamat')}}" class="form-control form-control-sm {{ $errors->first('alamat')?'is-invalid':'' }}" name="alamat" placeholder="Masukkan Alamat Pelanggan">
                        <div class="invalid-feedback">
                            {{$errors->first('alamat')}}
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Telepon</label>
                    <div class="col-sm-10">
                        <input type="text" value="{{ old('telepon')}}" class="form-control form-control-sm {{ $errors->first('telepon')?'is-invalid':'' }}" name="telepon" placeholder="Masukkan Telepon Pelanggan">
                        <div class="invalid-feedback">
                            {{$errors->first('telepon')}}
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Cabang</label>
                    <div class="col-sm-10">
                        <input type="hidden" name="branch_id" value="{{auth()->user()->employee->branch_id}}">
                        <input type="text" class="form-control form-control-sm" value="{{auth()->user()->employee->branch->nama}}" disabled >
                    </div>
                </div>
            </form>
        </div>

        <div class="card-footer"  style="background:#C5C6C7">
            <p></p>
        </div>
    </div>
</div>
@endsection
