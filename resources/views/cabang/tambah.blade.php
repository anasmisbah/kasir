@extends('layouts.master')

@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Cabang</h3>
        </div>

        <form role="form">
            <div class="card-body">
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama Cabang">
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" class="form-control" name="alamat" placeholder="Masukkan Alamat Cabang">
                </div>
                <div class="form-group">
                    <label>Telepon</label>
                    <input type="text" class="form-control" name="telepon" placeholder="Masukkan Telepon Cabang">
                </div>
                <div class="form-group">
                    <label>Pimpinan</label>
                    <input type="text" class="form-control" name="pimpinan" placeholder="Masukkan Nama Pimpinan Cabang">
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Tambahkan</button>
            </div>
        </form>
    </div>
</div>
@endsection