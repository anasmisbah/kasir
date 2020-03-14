@extends('layouts.master')

@push('css')
<link rel="stylesheet" href="/adminlte/plugins/select2/css/select2.min.css">
<style>
    .form-group{
        margin-bottom: .5rem !important;
    }
    .form-control.form-control-sm:focus{
        color: black;
    }
    .card-title{
        color: black;
    }
</style>
@endpush
@section('breadcumb')
<li class="breadcrumb-item">Beranda</li>
<li class="breadcrumb-item">Pengguna</li>
<li class="breadcrumb-item active"><a href="#">Membuat</a></li>
@endsection

@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <form role="form-horizontal" action="{{route('pengguna.simpan')}}" method="POST">
                <div class="d-flex justify-content-between mb-3">
                    <div>
                        <h4 class="card-title mb-0 text-bold">Menambahkan Pengguna</h4>
                    </div>
                    <div class="btn-toolbar d-none d-md-block" role="toolbar" aria-label="Toolbar with buttons">
                        <button type="submit" class="btn btn-primary mr-5" style="width: 78px !important;"><i class="fa fa-save"></i></button>
                        <a class="btn btn-danger" href="javascript:void(0)" onclick="history.back();"><i class="fa fa-times"></i></a>
                    </div>
                </div>

                @csrf
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Foto</label>
                    <div class="col-sm-10">
                        <img src="{{asset("/uploads/fotos/default.jpg")}}" id="img_foto" class="block" width="125px" style="margin-bottom:3px" alt="logo">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Karyawan</label>
                    <div class="col-10">
                        <select id="selectkaryawan" class="form-control form-control-sm select2 {{ $errors->first('employee_id')?'is-invalid':'' }}" name="employee_id">
                            <option value="" disabled selected>Pilih Karyawan</option>
                        @foreach ($employees as $employee)
                            <option value="{{$employee->id}}"{{ old('employee_id') == $employee->id?'selected':'' }} >{{$employee->nama}}</option>
                        @endforeach
                        </select>
                        <div class="invalid-feedback">
                            karwayan wajib dipilih
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Pengguna</label>
                    <div class="col-sm-10"><input type="text" value="{{ old('username')}}" class="form-control form-control-sm {{ $errors->first('username')?'is-invalid':'' }}" name="username" placeholder="Masukkan Nama Pengguna">
                        <div class="invalid-feedback">
                            {{$errors->first('username')}}
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10"><input type="email" value="{{ old('email')}}" class="form-control form-control-sm {{ $errors->first('email')?'is-invalid':'' }}" name="email" placeholder="Masukkan Email Pengguna">
                        <div class="invalid-feedback">
                            {{$errors->first('email')}}
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10"><input type="password" class="form-control form-control-sm {{ $errors->first('password')?'is-invalid':'' }}" name="password" placeholder="Masukkan Password Pengguna">
                        <div class="invalid-feedback">
                            {{$errors->first('password')}}
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Level</label>
                    <div class="col-sm-10"><select class="form-control form-control-sm {{ $errors->first('level_id')?'is-invalid':'' }} " name="level_id">
                        @foreach ($levels as $level)
                            <option value="{{$level->id}}" {{ old('level_id') == $level->id?'selected':'' }}>{{$level->nama}}</option>
                        @endforeach
                    </select>
                        <div class="invalid-feedback">
                            {{$errors->first('level_id')}}
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Cabang</label>
                    <div class="col-sm-10"><input type="text" id="cabang" disabled class="form-control form-control-sm" placeholder="Cabang"></div>
                </div>
            </form>
        </div>
            <div class="card-footer" style="background:#C5C6C7">
                <p></p>
            </div>
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
<script>
$(document).on('change', '#selectkaryawan', function () {
    let url = "{{ route('karyawan.data') }}"

    // $('#foto').attr('src','/uploads/'+data.foto)
    $.ajax({
        type: 'get',
        url: url,
        data: {
            'id': $("#selectkaryawan").val(),
        },
        success: function (data) {
            $('#img_foto').attr('src','/uploads/'+data.foto)
            $('#cabang').val(data.branch.nama)
        },
    });
});
</script>
@endpush
