@extends('layouts.master')
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2 ">
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-left">
            <li class="breadcrumb-item">Beranda</li>
            <li class="breadcrumb-item">Cabang</li>
            <li class="breadcrumb-item active"><a href="#">Memperbarui</a></li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
<div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12 mt-3">
        <!-- general form elements -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Cabang</h3>
            <div class="card-tools">
                <ul class="nav nav-pills ml-auto">
                  <li class="nav-item">
                    <a class="nav-link btn-danger active" href="{{ route('cabang.index') }}"><i class=" fas fa-times"></i></a>
                  </li>
                </ul>
              </div>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
            <form class="form-horizontal" action="{{route('cabang.perbarui',$branch->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                    <input type="text"  value="{{$branch->nama}}" name="nama" class="form-control" id="inputEmail3" placeholder="Nama">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Telepon</label>
                    <div class="col-sm-10">
                    <input type="text"  value="{{$branch->telepon}}" name="telepon" class="form-control" id="inputEmail3" placeholder="Telepon">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Pimpinan</label>
                    <div class="col-sm-10">
                    <input type="text"  value="{{$branch->pimpinan}}" name="pimpinan" class="form-control" id="inputEmail3" placeholder="Pimpinan">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <textarea  name="alamat" class="form-control" rows="3" placeholder="Alamat">{{$branch->alamat}}</textarea>
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
