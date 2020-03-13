@extends('layouts.master')

@push('css')
<link rel="stylesheet" href="/adminlte/plugins/select2/css/select2.min.css">
<style>
    .form-group{
        margin-bottom: .5rem !important;
    }
    .form-control.form-control-sm:focus{
        border-color: #39f;
        box-shadow: 0 0 0 0.2rem rgba(51, 153, 255, 0.25);
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
<li class="breadcrumb-item active"><a href="#"  class="text-info">Memperbarui</a></li>
@endsection

@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <div>
                    <h4 class="card-title mb-0 text-bold">Memperbarui Pengguna</h4>
                </div>
                <div class="btn-toolbar d-none d-md-block" role="toolbar" aria-label="Toolbar with buttons">
                    <a class="btn btn-danger"  href="javascript:void(0)" onclick="history.back();"><i class="fa fa-times"></i></a>
                </div>
            </div>
            <form role="form" action="{{route('pengguna.perbarui',$user->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Foto</label>
                    <div class="col-sm-10">
                        <img src="{{asset("/uploads/".$user->employee->foto)}}" id="img_foto" class="block" width="125px" style="margin-bottom:3px" alt="logo">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Karyawan</label>
                    <div class="col-sm-10"><select class="form-control form-control-sm select2" id="selectkaryawan" name="employee_id">
                        <option value="{{$user->employee->id}}" selected>{{$user->employee->nama}}</option>
                        @foreach ($employees as $employee)
                            <option value="{{$employee->id}}" {{ $employee->id === $user->employee_id?"selected":"" }}>{{$employee->nama}}</option>
                        @endforeach
                    </select></div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Pengguna</label>
                    <div class="col-sm-10"><input type="text" value="{{ old('username')?old('username'):$user->username }}" class="form-control form-control-sm {{ $errors->first('username')?'is-invalid':'' }}" name="username" placeholder="Masukkan Nama Pengguna">
                        <div class="invalid-feedback">
                            {{$errors->first('username')}}
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10"><input type="email" value="{{ old('email')?old('email'):$user->email }}" class="form-control form-control-sm  {{ $errors->first('email')?'is-invalid':'' }}" name="email" placeholder="Masukkan Email Pengguna">
                        <div class="invalid-feedback">
                            {{$errors->first('email')}}
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10"><input type="password" class="form-control form-control-sm" name="password" placeholder="Masukkan Password Pengguna"></div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Level</label>
                    <div class="col-sm-10"><select class="form-control form-control-sm" name="level_id">
                        @foreach ($levels as $level)
                            <option value="{{$level->id}}" {{ $level->id === $user->level_id?"selected":"" }}>{{$level->nama}}</option>
                        @endforeach
                    </select></div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Cabang</label>
                    <div class="col-sm-10"><input type="text" id="cabang"  value="{{$user->employee->branch->nama}}" disabled class="form-control form-control-sm" placeholder="Cabang"></div>
                </div>
                <button type="submit" class="btn btn-info float-right" style="width: 78px !important;"><i class="fa fa-save"></i></button>
            </form>
        </div>
        <div class="card-footer text-right" style="background:#C5C6C7">
            <span style="font-size: 12px">
                <strong>Dibuat pada: </strong>{{  $user->created_at->dayName." | ".$user->created_at->day." ".$user->created_at->monthName." ".$user->created_at->year}} | {{$user->created_at->format('h:i:s')}} WIB | <a class="text-info" href="{{route('karyawan.detail',$user->createdBy->employee->id)}}">{{$user->createdBy->employee->nama}}</a> / <strong>Diubah pada: </strong>{{  $user->updated_at->dayName." | ".$user->updated_at->day." ".$user->updated_at->monthName." ".$user->updated_at->year}} | {{$user->updated_at->format('h:i:s')}} WIB | <a class="text-info" href="{{route('karyawan.detail',$user->updatedBy->employee->id)}}">{{$user->updatedBy->employee->nama}}</a>
            </span>
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
