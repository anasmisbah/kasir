@extends('layouts.master')
@push('css')
    <style>
    .btn-warning{
        color: white;
    }
    .btn-warning:hover{
        color: white;
    }
    </style>
@endpush
@section('breadcumb')
<li class="breadcrumb-item">Beranda</li>
<li class="breadcrumb-item">Pengguna</li>
<li class="breadcrumb-item active"><a href="#"  class="text-info">Detail</a></li>
@endsection
@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <div>
                <h4 class="card-title mb-0 text-bold">Detail Pengguna</h4>
                </div>
                <div class="btn-toolbar d-none d-md-block" role="toolbar" aria-label="Toolbar with buttons">
                <a class="btn btn-danger"  href="javascript:void(0)" onclick="history.back();"><i class="fa fa-times"></i></a>
                </div>
            </div>
            <table class="table table-striped">
                <tbody>
                  <tr>
                    <td style="width:10%">Avatar</td>
                    <td><img src="{{asset("/uploads/".$user->employee->foto)}}" id="img_foto" class="block" width="125px" style="margin-bottom:3px" alt="logo"></td>
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
                    <td> <a class="text-info" href="{{route('cabang.detail',$user->employee->branch->id)}}">{{$user->employee->branch->nama}}</a></td>
                  </tr>
                </tbody>
              </table>
              <form class="d-inline" id="form-delete" action="{{route('pengguna.hapus', $user->id)}}" method="POST">
                @csrf
                @method('DELETE')
            </form>
                <button type="submit" id="delete" class="btn ml-4 mt-2 btn-warning float-right" style="width: 78px !important;">
                  <i class="fa fa-trash"></i></button>

              <a href="{{route('pengguna.ubah',$user->id)}}" class="btn mt-2 btn-info float-right" style="width: 78px !important;"><i class="fa fa-edit"></i></a>
            </div>

            <div class="card-footer text-right" style="background:#C5C6C7">
                <span style="font-size: 12px">
                    <strong>Dibuat Pada: </strong>{{  $user->created_at->dayName." | ".$user->created_at->day." ".$user->created_at->monthName." ".$user->created_at->year}} | {{$user->created_at->format('h:i:s')}} WIB | <a class="text-info" href="{{route('karyawan.detail',$user->createdBy->employee->id)}}">{{$user->createdBy->employee->nama}}</a> / <strong>Diubah Pada: </strong>{{  $user->updated_at->dayName." | ".$user->updated_at->day." ".$user->updated_at->monthName." ".$user->updated_at->year}} | {{$user->updated_at->format('h:i:s')}} WIB | <a class="text-info" href="{{route('karyawan.detail',$user->updatedBy->employee->id)}}">{{$user->updatedBy->employee->nama}}</a>
                </span>
            </div>
        </div>
</div>
@endsection

@push('script')
<script src="/adminlte/plugins/sweetalert.min.js"></script>
<script>
    $('#delete').click(()=>{
      swal({
      title: "apakah anda yakin menghapus {{$user->employee->nama}} ?",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        swal("berhasil menghapus", {
          icon: "success",
          button:false,
          timer:750
        });
        $('#form-delete').submit()
      }
    });

    })
</script>
@endpush
