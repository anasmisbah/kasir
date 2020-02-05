@extends('layouts.master')
@section('content')
<div class="col-12">
    <div class="card mt-3">
        <div class="card-header">
            <h3 class="card-title">Tambah Pengguna</h3>
        </div>

        <form role="form">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label>Nama Karyawan</label>
                    <input type="text" disabled value="{{$user->employee->nama}}" class="form-control" name="username" placeholder="Masukkan Nama Pengguna">
                </div>
                <div class="form-group">
                    <label>Nama Pengguna</label>
                    <input type="text" disabled value="{{$user->username}}" class="form-control" name="username" placeholder="Masukkan Nama Pengguna">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" disabled value="{{$user->email}}" class="form-control" name="email" placeholder="Masukkan Email Karyawan">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" disabled value="qweqwe" class="form-control" name="password" placeholder="Masukkan Password Karyawan">
                </div>
                <div class="form-group">
                    <label>Level</label>
                    <input type="text" disabled value="{{$user->level->nama}}" class="form-control" name="username" placeholder="Masukkan Nama Pengguna">
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('pengguna.ubah',$user->id) }}" class="btn btn-lg btn-primary float-right"><i class="fa fa-edit"></i></a>
            </div>
        </form>
    </div>
</div>
@endsection
