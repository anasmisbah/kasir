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
                    <td> <a href="{{route('cabang.detail',$user->employee->branch->id)}}">{{$user->employee->branch->nama}}</a></td>
                  </tr>
                </tbody>
              </table>
              <form class="d-inline" id="form-delete" action="{{route('pengguna.hapus', $user->id)}}" method="POST">
                @csrf
                @method('DELETE')
            </form>
                <button type="submit" id="delete" class="btn ml-4 mt-2 btn-warning float-right" style="width: 78px !important;">
                  <i class="fa fa-trash"></i></button>

              <a href="{{route('pengguna.ubah',$user->id)}}" class="btn mt-2 btn-primary float-right" style="width: 78px !important;"><i class="fa fa-edit"></i></a>
            </div>

                <div class="card-footer text-right">
                    <strong>Dibuat Pada: </strong>{{  $user->created_at->dayName." | ".$user->created_at->day." ".$user->created_at->monthName." ".$user->created_at->year}} | {{$user->created_at->format('h:i:s A')}} | <a href="{{route('karyawan.detail',$user->createdBy->employee->id)}}">{{$user->createdBy->employee->nama}}</a> / <strong>Diubah Pada: </strong>{{  $user->updated_at->dayName." | ".$user->updated_at->day." ".$user->updated_at->monthName." ".$user->updated_at->year}} | {{$user->updated_at->format('h:i:s A')}} | {{$user->updated_at->format('h:i:s A')}} | <a href="{{route('karyawan.detail',$user->updatedBy->employee->id)}}">{{$user->updatedBy->employee->nama}}</a>                </div>
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
