@extends('layouts.kasir')

@section('content')
<div class="col-md-8 offset-md-2">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <div>
                    <h4 class="card-title mb-0 text-bold">Detail Pengguna</h4>
                </div>
                <div class="btn-toolbar d-none d-md-block" role="toolbar" aria-label="Toolbar with buttons">
                    <a class="btn btn-info mr-5" style="width: 78px !important;" href="{{route('kasir.ubah')}}" id="delete"><i
                            class=" fa fa-edit"></i></a>
                    <a class="btn btn-danger" href="javascript:void(0)" onclick="history.back();"><i class="fa fa-times"></i></a>
                </div>
            </div>
            <table class="table table-sm table-striped">
                <tbody>
                    <tr>
                        <td style="width:20%">Avatar</td>
                        <td><img src="{{asset('/uploads/'.$user->employee->foto)}}"
                                id="img_foto" class="block" width="125px" style="margin-bottom:3px" alt="logo"></td>
                    </tr>
                    <tr>
                        <td>Nama Karyawan</td>
                        <td><strong>David Beckham</strong></td>
                    </tr>
                    <tr>
                        <td>Nama Pengguna</td>
                        <td>kasircabang</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>kasir@cabang.com</td>
                    </tr>
                    <tr>
                        <td>Sandi</td>
                        <td>*******</td>
                    </tr>
                    <tr>
                        <td>Level</td>
                        <td>Kasir</td>
                    </tr>
                    <tr>
                        <td>Cabang</td>
                        <td> <a class="text-info" href="http://project03.test/cabang/detail/1">Pusat</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="card-footer text-right" style="background:#C5C6C7">
            <span style="font-size: 12px">
                <strong>Dibuat pada: </strong>Selasa | 25 Februari 2020 | 11:27:35 WIB | <a class="text-info"
                    href="http://project03.test/karyawan/detail/1">David Beckham</a> / <strong>Diubah pada: </strong>Senin | 9
                Maret 2020 | 01:16:20 WIB | <a class="text-info" href="http://project03.test/karyawan/detail/1">David
                    Beckham</a>
            </span>
        </div>
    </div>
</div>
@endsection
