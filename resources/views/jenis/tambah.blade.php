@extends('layouts.master')
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2 ">
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-left">
            <li class="breadcrumb-item">Beranda</li>
            <li class="breadcrumb-item">Jenis Barang</li>
            <li class="breadcrumb-item active"><a href="#">Membuat</a></li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
<div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Jenis Barang</h3>
            <div class="card-tools">
                <ul class="nav nav-pills ml-auto">
                  <li class="nav-item">
                    <a class="nav-link btn-danger active" href="{{ route('jenis.index') }}"><i class=" fas fa-times"></i></a>
                  </li>
                </ul>
              </div>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
            <form class="form-horizontal" action="{{route('jenis.simpan')}}" method="POST">
                @csrf
                <div class="card-body">
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                    <input type="text"  name="nama" class="form-control form-control-sm {{ $errors->first('nama')?'is-invalid':'' }}" id="inputEmail3" placeholder="Nama">
                    <div class="invalid-feedback">
                        {{$errors->first('nama')}}
                    </div>
                </div>

                </div>
                <button type="submit" class="btn  btn-primary float-right" style="width: 78px !important;"><i class="fa fa-save"></i></button>
            </div>

            <div class="card-footer">
                <p></p>
            </div>
            </form>
        </div>
      </div>
    </div>
</div>
@endsection
