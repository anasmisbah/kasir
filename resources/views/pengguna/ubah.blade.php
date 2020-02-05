@extends('layouts.master')

@push('css')
<link rel="stylesheet" href="/adminlte/plugins/select2/css/select2.min.css">
@endpush

@section('content')
<div class="col-12">
    <div class="card mt-3">
        <div class="card-header">
            <h3 class="card-title">Tambah Pengguna</h3>
        </div>

        <form role="form" action="{{route('pengguna.perbarui',$user->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label>Nama Karyawan</label>
                    <select class="form-control select2" name="employee_id">
                        @foreach ($employees as $employee)
                            <option value="{{$employee->id}}" {{ $employee->id === $user->employee_id?"selected":"" }}>{{$employee->nama}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Nama Pengguna</label>
                    <input type="text" value="{{$user->username}}" class="form-control" name="username" placeholder="Masukkan Nama Pengguna">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" value="{{$user->email}}" class="form-control" name="email" placeholder="Masukkan Email Karyawan">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Masukkan Password Karyawan">
                </div>
                <div class="form-group">
                    <label>Level</label>
                    <select class="form-control select2" name="level_id">
                        @foreach ($levels as $level)
                            <option value="{{$level->id}}" {{ $level->id === $user->level_id?"selected":"" }}>{{$level->nama}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-lg btn-primary float-right"><i class="fa fa-save"></i></button>
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
