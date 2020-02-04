@extends('layouts.master')

@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Barang</h3>
        </div>

        <form role="form">
            <div class="card-body">
                <div class="form-group">
                    <label>Nama</label>
                    <input type="email" class="form-control" name="nama" placeholder="Masukkan Nama Barang">
                </div>
                <div class="form-group">
                    <label>Cabang</label>
                    <select class="form-control" name="cabang">
                        <option>Samarinda</option>
                        <option>Bontang</option>
                        <option>Sangatta</option>
                        <option>Tenggarong</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Harga Pusat</label>
                    <input type="text" class="form-control" name="harga_pusat">
                </div>
                <div class="form-group">
                    <label>Harga Cabang</label>
                    <input type="text" class="form-control" name="harga_pusat" placeholder="Masukkan Harga Cabang">
                </div>
                <div class="form-group">
                    <label>Selisih</label>
                    <input type="text" class="form-control" name="selisih">
                </div>
                <div class="form-group">
                    <label>Stok</label>
                    <input type="text" class="form-control" name="stok" placeholder="Masukkan Stok Barang">
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Tambahkan</button>
            </div>
        </form>
    </div>
</div>
@endsection