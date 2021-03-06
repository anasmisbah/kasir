@extends('layouts.master')

@push('css')
<link rel="stylesheet" href="/adminlte/plugins/select2/css/select2.min.css">
<style>
    .form-group{
        margin-bottom: .5rem !important;
    }
</style>
@endpush

@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-6">
          <ol class="breadcrumb float-sm-left">
            <li class="breadcrumb-item">Beranda</li>
            <li class="breadcrumb-item">Pelanggan</li>
            <li class="breadcrumb-item active"><a href="#">Membuat</a></li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Pelanggan</h3>
            <div class="card-tools">
                <ul class="nav nav-pills ml-auto">
                  <li class="nav-item">
                    <a class="nav-link btn-danger active" href="{{ route('pelanggan.index') }}"><i class=" fas fa-times"></i></a>
                  </li>
                </ul>
              </div>
        </div>

        <form role="form-horizontal" action="{{ route('pelanggan.simpan') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10"><input type="text" class="form-control form-control-sm form-control form-control-sm-sm form-control form-control-sm form-control form-control-sm-sm-sm" name="nama" placeholder="Masukkan Nama Pelanggan"></div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10"><input type="text" class="form-control form-control-sm form-control form-control-sm-sm form-control form-control-sm form-control form-control-sm-sm-sm" name="alamat" placeholder="Masukkan Alamat Pelanggan"></div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Telepon</label>
                    <div class="col-sm-10"><input type="text" class="form-control form-control-sm form-control form-control-sm-sm form-control form-control-sm form-control form-control-sm-sm-sm" name="telepon" placeholder="Masukkan Telepon Pelanggan"></div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Cabang</label>
                    <div class="col-sm-10"><select class="form-control form-control-sm form-control form-control-sm-sm form-control form-control-sm form-control form-control-sm-sm-sm" name="branch_id">
                        @foreach ($branches as $branch)
                            <option value="{{$branch->id}}">{{$branch->nama}}</option>
                        @endforeach
                    </select></div>
                </div>
                <button type="submit" class="btn  btn-primary float-right" style="width: 78px !important;"><i class="fa fa-save"></i></button>
            </div>

            <div class="card-footer">
                <p></p>
            </div>
        </form>
    </div>
</div>
@endsection

@push('script')
<script src="/adminlte/plugins/select2/js/select2.full.min.js"></script>
<script>
$(function () {
    $('.select2').select2()
});
</script>
@endpush
