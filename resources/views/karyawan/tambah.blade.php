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
                    <label>Foto</label>
                    <input type="file" name="foto">
                </div>
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama Cabang">
                </div>
                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <select class="form-control" name="jenis_kelamin">
                        <option>Laki-Laki</option>
                        <option>Perempuan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Jabatan</label>
                    <input type="text" class="form-control" name="jabatan" placeholder="Masukkan Jabatan">
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" class="form-control" name="alamat" placeholder="Masukkan Alamat Karyawan">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Masukkan Email Karyawan">
                </div>
                <div class="form-group">
                    <label>Telepon</label>
                    <input type="text" class="form-control" name="telepon" placeholder="Masukkan Telepon Karwayan">
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
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Tambahkan</button>
            </div>
        </form>
    </div>
</div>
@endsection