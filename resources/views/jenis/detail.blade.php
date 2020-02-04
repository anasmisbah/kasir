@extends('layouts.master')
@section('content')
<div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Jenis Barang</h3>
          </div>
            <form class="form-horizontal">
                <div class="card-body">
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                    <input type="text" disabled value="{{$category->nama}}" class="form-control" id="inputEmail3" placeholder="Nama">
                    </div>
                  </div>
                  <a href="{{route('jenis.ubah',$category->id)}}" class="btn btn-primary float-right"><i class="fa fa-edit"></i></a>
                </div>
                <div class="card-footer">
                    <p class="text-right"><b>Di buat pada </b>: tanggal | <a href="">nama</a> / <b>Diperbarui pada:</b> tanggal | <a href="">nama</a></p>
                </div>
              </form>
            <!-- /.card-body -->


        </div>
      </div>
    </div>
</div>
@endsection
