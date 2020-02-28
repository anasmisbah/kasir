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
<li class="breadcrumb-item">Pelanggan</li>
<li class="breadcrumb-item active"><a href="#"  class="text-info">Memperbarui</a></li>
@endsection

@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <div>
                    <h4 class="card-title mb-0 text-bold">Memperbarui Pelanggan</h4>
                </div>
                <div class="btn-toolbar d-none d-md-block" role="toolbar" aria-label="Toolbar with buttons">
                    <a class="btn btn-danger"  href="{{ route('pelanggan.index') }}"><i class="fa fa-times"></i></a>
                </div>
            </div>
            <form role="form-horizontal" action="{{ route('pelanggan.perbarui',$customer->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10"><input type="text" value="{{$customer->nama}}" class="form-control form-control-sm" name="nama" placeholder="Masukkan Nama Cabang"></div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10"><input type="text" value="{{$customer->alamat}}" class="form-control form-control-sm" name="alamat" placeholder="Masukkan Alamat Karyawan"></div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Telepon</label>
                    <div class="col-sm-10"><input type="text" value="{{$customer->telepon}}" class="form-control form-control-sm" name="telepon" placeholder="Masukkan Telepon Karwayan"></div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Cabang</label>
                    <div class="col-sm-10">
                        <input type="hidden" name="branch_id" value="{{$customer->branch_id}}">
                        <input type="text" class="form-control form-control-sm" value="{{$customer->branch->nama}}" disabled >
                    </div>
                </div>
                <button type="submit" class="btn  btn-info float-right" style="width: 78px !important;"><i class="fa fa-save"></i></button>
            </form>
        </div>
        <div class="card-footer text-right" style="background:#C5C6C7">
            <span style="font-size: 12px">
                <strong>Dibuat Pada: </strong>{{  $customer->created_at->dayName." | ".$customer->created_at->day." ".$customer->created_at->monthName." ".$customer->created_at->year}} | {{$customer->created_at->format('h:i:s A')}} | <a class="text-info" href="{{route('karyawan.detail',$customer->createdBy->employee->id)}}">{{$customer->createdBy->employee->nama}}</a> / <strong>Diubah Pada: </strong>{{  $customer->updated_at->dayName." | ".$customer->updated_at->day." ".$customer->updated_at->monthName." ".$customer->updated_at->year}} | {{$customer->updated_at->format('h:i:s A')}} | {{$customer->updated_at->format('h:i:s A')}} | <a class="text-info" href="{{route('karyawan.detail',$customer->updatedBy->employee->id)}}">{{$customer->updatedBy->employee->nama}}</a>
            </span>
        </div>
    </div>
</div>
@endsection
