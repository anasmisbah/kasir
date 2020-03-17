@extends('layouts.kasir')

@section('css')
<style>
    div.custom-input {
        max-width: 120px;
        height: 35px;
        content: attr(title)"asasa";
        background-color: #3399fe !important;
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
</style>
@endsection

@section('content')
<div class="col-md-8 offset-md-2">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <div>
                    <h4 class="card-title mb-0 text-bold">Memperbarui Pengguna</h4>
                </div>
                <div class="btn-toolbar d-none d-md-block" role="toolbar" aria-label="Toolbar with buttons">
                    <button type="submit" class="btn  btn-info mr-5" style="width: 78px !important;"><i
                            class="fa fa-save"></i></button>
                    <a class="btn btn-danger" href="javascript:void(0)" onclick="history.back();"><i class="fa fa-times"></i></a>
                </div>
            </div>
            <form role="form" action="http://project03.test/pengguna/1" method="POST">
                <input type="hidden" name="_token" value="fGtPmSkJYarVa6svMvyQHMLOM4b8YDuB63urqEr3"> <input type="hidden"
                    name="_method" value="PUT">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Avatar</label>
                    <div class="col-sm-10">
                        <img src="http://project03.test/storage/fotos/3OFxnnZ1lYNDOzfzDaqwnnCK8hrYO3sesCzVxUAS.png" id="img_foto"
                            class="block" width="125px" style="margin-bottom:3px" alt="logo">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Karyawan</label>
                    <div class="col-sm-10"><select class="form-control form-control-sm select2" id="selectkaryawan"
                            name="employee_id" disabled>
                            <option value="1" selected>David Beckham</option>
                        </select></div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Pengguna</label>
                    <div class="col-sm-10"><input type="text" value="kasircabang" class="form-control form-control-sm "
                            name="username" placeholder="Masukkan Nama Pengguna">
                        <div class="invalid-feedback">

                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10"><input type="email" value="admin@pusat.com" class="form-control form-control-sm  "
                            name="email" placeholder="Masukkan Email Karyawan">
                        <div class="invalid-feedback">

                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Sandi</label>
                    <div class="col-sm-10"><input type="password" class="form-control form-control-sm" name="password"
                            placeholder="Masukkan sandi">
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
                    <div class="col-sm-10"><input type="text" id="cabang" value="Pusat" disabled
                            class="form-control form-control-sm" placeholder="Cabang"></div>
                </div>
            </form>
        </div>
        <div class="card-footer text-right" style="background:#C5C6C7">
            <span style="font-size: 12px">
                <strong>Dibuat pada: </strong>Selasa | 25 Februari 2020 | 11:27:35 AM | <a class="text-info"
                    href="http://project03.test/karyawan/detail/1">David Beckham</a> / <strong>Diubah pada: </strong>Senin | 9
                Maret 2020 | 01:09:45 WIB | <a class="text-info" href="http://project03.test/karyawan/detail/1">David
                    Beckham</a>
            </span>
        </div>
    </div>
</div>
@endsection
