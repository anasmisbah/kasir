@extends('layouts.master')
@push('css')
<style>
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
<li class="breadcrumb-item">Jenis Barang</li>
<li class="breadcrumb-item active"><a href="#"  class="text-info">Memperbarui</a></li>
@endsection
@section('content')
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="card">
            <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <div>
                <h4 class="card-title mb-0 text-bold">Memperbarui jenis Barang</h4>
                </div>
                <div class="btn-toolbar d-none d-md-block" role="toolbar" aria-label="Toolbar with buttons">
                <a class="btn btn-danger"  href="javascript:void(0)" onclick="history.back();"><i class="fa fa-times"></i></a>
                </div>
            </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form class="form-horizontal" action="{{route('jenis.perbarui',$category->id)}}" method="POST">
            @csrf
            @method('PUT')
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                <input type="text" value="{{ old('nama')?old('nama'):$category->nama }}" name="nama" class="form-control form-control-sm {{ $errors->first('nama')?'is-invalid':'' }}" id="inputEmail3" placeholder="Nama">
                <div class="invalid-feedback">
                    {{$errors->first('nama')}}
                </div>
            </div>
              </div>
              <button type="submit" class="btn  btn-info float-right" style="width: 78px !important;"><i class="fa fa-save"></i></button>
            </form>
          </div>

          <div class="card-footer text-right" style="background:#C5C6C7">
            <span style="font-size: 12px">
                <strong>Dibuat Pada: </strong>{{  $category->created_at->dayName." | ".$category->created_at->day." ".$category->created_at->monthName." ".$category->created_at->year}} | {{$category->created_at->format('h:i:s')}} WIB | <a href="{{route('karyawan.detail',$category->createdBy->employee->id)}}" class="text-info">{{$category->createdBy->employee->nama}}</a> / <strong>Diubah Pada: </strong>{{  $category->updated_at->dayName." | ".$category->updated_at->day." ".$category->updated_at->monthName." ".$category->updated_at->year}} | {{$category->updated_at->format('h:i:s')}} WIB | <a href="{{route('karyawan.detail',$category->updatedBy->employee->id)}}" class="text-info">{{$category->updatedBy->employee->nama}}</a>
            </span>
          </div>
        </div>
      </div>
    </div>
@endsection
