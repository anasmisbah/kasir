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
                    <a class="btn btn-primary mr-5" style="width: 78px !important;" href="{{route('kasir.ubah')}}" id="delete"><i
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
                        <td><strong>{{$user->employee->nama}}</strong></td>
                    </tr>
                    <tr>
                        <td>Nama Pengguna</td>
                        <td>{{$user->username}}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                    <td>{{$user->email}}</td>
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
                        <td> <a href="#">Pusat</a></td>
                    </tr>
                </tbody>
            </table>
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
