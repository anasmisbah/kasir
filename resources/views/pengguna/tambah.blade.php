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
                    <label>Nama Lengkap</label>
                    <input type="text" class="form-control" name="nama_lengkap" placeholder="Masukkan Nama Lengkap">
                </div>
                <div class="form-group">
                    <label>Nama Pengguna</label>
                    <input type="text" class="form-control" name="nama_pengguna" placeholder="Masukkan Nama Pengguna">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Masukkan Email Karyawan">
                </div>
                <div class="form-group">
                    <label>Level</label>
                    <select class="form-control" name="level">
                        <option>Admin Pusat</option>
                        <option>Admin Cabang</option>
                        <option>Kasir</option>                        
                    </select>
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