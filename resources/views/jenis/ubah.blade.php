@extends('layouts.master')
@section('content')
<div class="container-fluid">
    <div class="row mt-1">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Jenis Barang</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form class="form-horizontal" action="{{route('jenis.perbarui',$category->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                <input type="text" value="{{$category->nama}}" name="nama" class="form-control" id="inputEmail3" placeholder="Nama">
                </div>
              </div>
              <button type="submit" class="btn btn-primary float-right"><i class="fa fa-save"></i></button>
            </div>
          </form>
        </div>
      </div>
    </div>
</div>
@endsection
