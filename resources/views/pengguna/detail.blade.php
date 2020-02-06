@extends('layouts.master')
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2 ">
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-left">
            <li class="breadcrumb-item">Beranda</li>
            <li class="breadcrumb-item">Pengguna</li>
            <li class="breadcrumb-item active"><a href="#">Detail</a></li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
<div class="col-12">
    <div class="card mt-3">
        <div class="card-header">
            <h3 class="card-title">Pengguna</h3>
            <div class="card-tools">
                <ul class="nav nav-pills ml-auto">
                  <li class="nav-item">
                    <a class="nav-link btn-danger active" href="{{ route('pengguna.index') }}"><i class=" fas fa-times"></i></a>
                  </li>
                </ul>
              </div>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <tbody>
                  <tr>
                    <td style="width:10%">Avatar</td>
                    <td><img src="{{asset("/storage/".$user->employee->foto)}}" id="img_foto" class="block" width="125px" style="margin-bottom:3px" alt="logo"></td>
                  </tr>
                  <tr>
                    <td style="width:10%">Nama</td>
                    <td>{{$user->employee->nama}}</td>
                  </tr>
                  <tr>
                    <td style="width:10%">Username</td>
                    <td>{{$user->username}}</td>
                  </tr>
                  <tr>
                    <td style="width:10%">Password</td>
                    <td>*******</td>
                  </tr>
                  <tr>
                    <td style="width:10%">Level</td>
                    <td>{{$user->level->nama}}</td>
                  </tr>
                  <tr>
                    <td style="width:10%">Cabang</td>
                    <td>{{$user->employee->branch->nama}}</td>
                  </tr>
                </tbody>
              </table>
              <form class="d-inline" onsubmit="return confirm('Apakah anda ingin menghapus Pengguna secara permanen?')" action="{{route('pengguna.hapus', $user->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn ml-4 mt-2 btn-warning float-right" style="width: 78px !important;">
                  <i class="fa fa-trash"></i></button>
              </form>
              <a href="{{route('pengguna.ubah',$user->id)}}" class="btn mt-2 btn-primary float-right" style="width: 78px !important;"><i class="fa fa-edit"></i></a>
            </div>

                <div class="card-footer text-right">
                    <strong>Dibuat Pada:</strong>{{$user->created_at->format('l | d F Y')}} | {{$user->created_at->format('h:i:s A')}} / <strong>Diubah Pada:</strong>{{$user->updated_at->format('l | d F Y')}} | {{$user->updated_at->format('h:i:s A')}}
                </div>
    </div>
</div>
@endsection
