@extends('layouts.master')
@section('content')
<div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12 mt-3">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Cabang</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
            <form class="form-horizontal">
                <div class="card-body">
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                    <input type="text" disabled value="{{$branch->nama}}" name="nama" class="form-control" id="inputEmail3" placeholder="Nama">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Telepon</label>
                    <div class="col-sm-10">
                    <input type="text" disabled value="{{$branch->telepon}}" name="telepon" class="form-control" id="inputEmail3" placeholder="Telepon">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Pimpinan</label>
                    <div class="col-sm-10">
                    <input type="text" disabled value="{{$branch->pimpinan}}" name="pimpinan" class="form-control" id="inputEmail3" placeholder="Pimpinan">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <textarea disabled name="alamat" class="form-control" rows="3" placeholder="Alamat">{{$branch->alamat}}</textarea>
                    </div>
                </div>
                <a href="{{ route('cabang.ubah',$branch->id) }}" class="btn btn-primary float-right"><i class="fa fa-edit"></i></a>
                </div>
                <div class="card-footer">
                    <p class="text-right"><b>Di buat pada </b>: tanggal | <a href="">nama</a> / <b>Diperbarui pada:</b> tanggal | <a href="">nama</a></p>
                </div>
            </form>
        </div>
      </div>
    </div>
</div>
@endsection
