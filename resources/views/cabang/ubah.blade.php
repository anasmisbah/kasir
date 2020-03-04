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
<li class="breadcrumb-item">Cabang</li>
<li class="breadcrumb-item active"><a href="#"  class="text-info">Memperbarui</a></li>
@endsection
@section('content')
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <div>
                    <h4 class="card-title mb-0 text-bold">Memperbarui Cabang</h4>
                </div>
                <div class="btn-toolbar d-none d-md-block" role="toolbar" aria-label="Toolbar with buttons">
                    <a class="btn btn-danger"  href="javascript:void(0)" onclick="history.back();"><i class="fa fa-times"></i></a>
                </div>
            </div>
            <form class="form-horizontal" action="{{route('cabang.perbarui',$branch->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                    <input type="text"  value="{{$branch->nama}}" name="nama" class="form-control form-control-sm" id="inputEmail3" placeholder="Nama">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Telepon</label>
                    <div class="col-sm-10">
                    <input type="text"  value="{{$branch->telepon}}" name="telepon" class="form-control form-control-sm" id="inputEmail3" placeholder="Telepon">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Pimpinan</label>
                    <div class="col-sm-10">
                    <input type="text"  value="{{$branch->pimpinan}}" name="pimpinan" class="form-control form-control-sm" id="inputEmail3" placeholder="Pimpinan">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <textarea  name="alamat" class="form-control form-control-sm" rows="3" placeholder="Alamat">{{$branch->alamat}}</textarea>
                    </div>
                </div>
                <button type="submit" class="btn  btn-info float-right" style="width: 78px !important;"><i class="fa fa-save"></i></button>
            </form>
            </div>

            <div class="card-footer text-right" style="background:#C5C6C7">
                <span style="font-size: 12px">
                    <strong>Dibuat Pada: </strong>{{  $branch->created_at->dayName." | ".$branch->created_at->day." ".$branch->created_at->monthName." ".$branch->created_at->year}} | {{$branch->created_at->format('h:i:s') }} WIB | <a href="{{route('karyawan.detail',$branch->createdBy->employee->id)}}" class="text-info">{{$branch->createdBy->employee->nama}}</a> / <strong>Diubah Pada: </strong>{{  $branch->updated_at->dayName." | ".$branch->updated_at->day." ".$branch->updated_at->monthName." ".$branch->updated_at->year}} | {{$branch->updated_at->format('h:i:s')}} WIB | <a href="{{route('karyawan.detail',$branch->updatedBy->employee->id)}}" class="text-info">{{$branch->updatedBy->employee->nama}}</a>
                </span>
            </div>
        </div>
      </div>
@endsection
