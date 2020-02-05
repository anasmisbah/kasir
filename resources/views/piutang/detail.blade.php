@extends('layouts.master')
@section('content')
<div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Piutang</h3>
          </div>
            <form class="form-horizontal">
                <div class="card-body">
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">No Nota Kas</label>
                    <div class="col-sm-10">
                    <input type="text" disabled value="{{$bill->no_nota_kas}}" class="form-control" id="inputEmail3" placeholder="Nama">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Tanggal</label>
                    <div class="col-sm-10">
                    <input type="text" disabled value="{{$bill->tanggal_nota}}" class="form-control" id="inputEmail3" placeholder="Nama">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Cabang</label>
                    <div class="col-sm-10">
                    <input type="text" disabled value="{{$bill->branch->nama}}" class="form-control" id="inputEmail3" placeholder="Nama">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Pelanggan</label>
                    <div class="col-sm-10">
                    <input type="text" disabled value="{{$bill->customer->nama}}" class="form-control" id="inputEmail3" placeholder="Nama">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                    <input type="text" disabled value="{{$bill->customer->alamat}}" class="form-control" id="inputEmail3" placeholder="Nama">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Telepon</label>
                    <div class="col-sm-10">
                    <input type="text" disabled value="{{$bill->customer->telepon}}" class="form-control" id="inputEmail3" placeholder="Nama">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Kasir</label>
                    <div class="col-sm-10">
                    <input type="text" disabled value="{{$bill->user->employee->nama}}" class="form-control" id="inputEmail3" placeholder="Nama">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">status</label>
                    <div class="col-sm-10">
                    <input type="text" disabled value="{{ strtoupper($bill->status)}}" class="form-control" id="inputEmail3" placeholder="Nama">
                    </div>
                  </div>
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
