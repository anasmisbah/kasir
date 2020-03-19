@extends('layouts.kasir')

@push('css')
    <style>
        div.custom-input {
            max-width: 120px;
            height: 35px;
            content: attr(title)"asasa";
            background-color: #321fdb !important;
            color: #fff;
            overflow: hidden;
            border-radius: 5px;
        }


        .custom-input input {
            margin-top: 0px;
            display: block !important;
            width: 120px !important;
            height: 35px !important;
            opacity: 0 !important;
            overflow: hidden !important;
        }
        div.custom-input:hover{
            background-color: #2a1ab9 !important;
            border-color:#2819ae;
            cursor: pointer !important;
        }
        .custom-input input:hover {
            cursor: pointer !important;
        }
    </style>
@endpush

@section('content')
<div class="col-md-8 offset-md-2">
    <div class="card">
        <div class="card-body">
                <form role="form" action="{{route('kasir.perbarui')}}" method="POST" enctype="multipart/form-data">
                        {{-- <input type="hidden" name="_token" value="fGtPmSkJYarVa6svMvyQHMLOM4b8YDuB63urqEr3"> <input type="hidden" --}}
                        @csrf
                        @method('PUT')
                            {{-- name="_method" value="PUT"> --}}

            <div class="d-flex justify-content-between mb-3">
                <div>
                    <h4 class="card-title mb-0 text-bold">Memperbarui Pengguna</h4>
                </div>
                <div class="btn-toolbar d-none d-md-block" role="toolbar" aria-label="Toolbar with buttons">
                    <button type="submit" class="btn  btn-primary mr-5" style="width: 78px !important;"><i
                            class="fa fa-save"></i></button>
                    <a class="btn btn-danger" href="javascript:void(0)" onclick="history.back();"><i class="fa fa-times"></i></a>
                </div>
            </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Avatar</label><br>
                    <div class="ml-3">
                        <img src="{{asset('/uploads/'.$user->employee->foto)}}" id="img_foto" class="block" width="125px" style="margin-bottom:3px" alt="">
                    </div>
                    <div class="col-2 pt-5 pl-2">
                        <div class="custom-input text-center" style="font-size:12px">
                                <input type="file" id="foto" name="foto">
                                <p style="z-index:9999; margin-top:-28px">
                                        Unggah Foto
                                    </p>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Karyawan</label>
                    <div class="col-sm-10"><select class="form-control form-control-sm select2" id="selectkaryawan" name="employee_id" disabled>
                    <option value="{{$user->employee_id}}" selected>{{$user->employee->nama}}</option>
                        </select></div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Pengguna</label>
                <div class="col-sm-10"><input type="text" value="{{ old('username')?old('username'):$user->username }}" class="form-control form-control-sm {{ $errors->first('username')?'is-invalid':'' }}"
                            name="username" placeholder="Masukkan Nama Pengguna">
                            <div class="invalid-feedback">
                                {{$errors->first('username')}}
                            </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10"><input type="email" value="{{ old('email')?old('email'):$user->email }}" class="form-control form-control-sm  {{ $errors->first('email')?'is-invalid':'' }}"
                            name="email" placeholder="Masukkan Email Karyawan">
                            <div class="invalid-feedback">
                                {{$errors->first('email')}}
                            </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Sandi</label>
                    <div class="col-sm-10"><input type="password" class="form-control form-control-sm {{ $errors->first('password')?'is-invalid':'' }}" name="password"
                            placeholder="*******">
                            <div class="invalid-feedback">
                                {{$errors->first('password')}}
                            </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Level</label>
                    <div class="col-sm-10"><select class="form-control form-control-sm" name="level_id" disabled>
                            <option value="1">Admin</option>
                            <option value="2">Admin Cabang</option>
                            <option value="3" selected>Kasir</option>
                        </select></div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Cabang</label>
                    <div class="col-sm-10">
                        <input type="text" id="cabang" value="Pusat" disabled class="form-control form-control-sm" placeholder="Cabang">
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer text-right" style="background:#C5C6C7">
            <span style="font-size: 12px">
                <strong>Dibuat pada:
                </strong>{{  $user->created_at->dayName." | ".$user->created_at->day." ".$user->created_at->monthName." ".$user->created_at->year}}
                | {{$user->created_at->format('H:i:s')}} WIB | <a
                    href="#"
                >{{$user->createdBy->employee->nama}}</a> / <strong>Diubah pada:
                </strong>{{  $user->updated_at->dayName." | ".$user->updated_at->day." ".$user->updated_at->monthName." ".$user->updated_at->year}}
                | {{$user->updated_at->format('H:i:s')}} WIB | <a
                    href="#"
                >{{$user->updatedBy->employee->nama}}</a>
            </span>
        </div>
    </div>
</div>
@endsection
@push('js')
<script src="/adminlte/plugins/jquery/jquery.min.js"></script>

<script>
    //menampilkan foto setiap ada perubahan pada modal tambah
    $('#foto').on('change', function () {
        readURL(this);
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#img_foto').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

</script>
@endpush
