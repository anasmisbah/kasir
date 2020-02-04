@extends('layouts.master')

@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Pelanggan</h3>
        </div>

        <form role="form">
            <div class="card-body">
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" disabled value="{{ $customer->nama }}" class="form-control" name="nama" placeholder="Masukkan Nama Cabang">
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" disabled value="{{ $customer->alamat }}" class="form-control" name="alamat" placeholder="Masukkan Alamat Karyawan">
                </div>
                <div class="form-group">
                    <label>Telepon</label>
                    <input type="text" disabled value="{{ $customer->telepon }}" class="form-control" name="telepon" placeholder="Masukkan Telepon Karwayan">
                </div>
                <div class="form-group">
                    <label>Cabang</label>
                    <input type="text" disabled value="{{ $customer->branch->nama }}" class="form-control" name="telepon" placeholder="Masukkan Telepon Karwayan">
                </div>
            </div>
            <div class="card-footer">
                <a href="{{route('pelanggan.ubah',$customer->id)}}" class="btn btn-lg btn-primary float-right"><i class="fa fa-edit"></i></a>
            </div>
        </form>
    </div>
</div>
@endsection
