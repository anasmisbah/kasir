@extends('layouts.master')

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-6">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item">Beranda</li>
          <li class="breadcrumb-item">Tentang Aplikasi</li>
          <li class="breadcrumb-item active"><a href="#">Detail</a></li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<div class="col-12">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Tentang Aplikasi Toko</h3>
      <div class="card-tools">
        <ul class="nav nav-pills ml-auto">
          <li class="nav-item">
            <a class="nav-link btn-danger active" href="{{ route('tentang.index') }}"><i class=" fas fa-times"></i></a>
          </li>
        </ul>
      </div>
    </div>
    <div class="card-body">
      <table class="table table-striped">
        <tbody>
          <tr>
            <td style="width:10%">Logo</td>
            <td><img src="{{asset("/storage/".$app->logo)}}" id="img_foto" class="block" width="125px" style="margin-bottom:3px" alt="logo"></td>
          </tr>
          <tr>
            <td style="width:10%">Nama Aplikasi</td>
            <td>{{$app->nama}}</td>
          </tr>
          <tr>
            <td style="width:10%">Nama Toko</td>
            <td>{{$app->toko}}</td>
          </tr>
          <tr>
            <td style="width:10%">Alamat</td>
            <td>{{$app->alamat}}</td>
          </tr>
          <tr>
            <td style="width:10%">Telepon</td>
            <td>{{$app->telepon}}</td>
          </tr>
        </tbody>
      </table>
      <a href="{{route('tentang.ubah',$app->id)}}" class="btn mt-2 btn-primary float-right" style="width: 78px !important;"><i class="fa fa-edit"></i></a>
    </div>

    <div class="card-footer text-right">
      <span style="font-size: 12px">
        <strong>Dibuat Pada: </strong>{{  $app->created_at->dayName." | ".$app->created_at->day." ".$app->created_at->monthName." ".$app->created_at->year}} | {{$app->created_at->format('h:i:s A')}} | <a href="{{route('karyawan.detail',$app->createdBy->employee->id)}}">{{$app->createdBy->employee->nama}}</a> / <strong>Diubah Pada: </strong>{{  $app->updated_at->dayName." | ".$app->updated_at->day." ".$app->updated_at->monthName." ".$app->updated_at->year}} | {{$app->updated_at->format('h:i:s A')}} | {{$app->updated_at->format('h:i:s A')}} | <a href="{{route('karyawan.detail',$app->updatedBy->employee->id)}}">{{$app->updatedBy->employee->nama}}</a>
      </span>
    </div>
  </div>
</div>
@endsection

@push('script')
<script>
  //menampilkan foto setiap ada perubahan pada modal tambah
  $('#foto').on('change', function() {
    readURL(this);
  });

  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
        $('#img_foto').attr('src', e.target.result);
      };

      reader.readAsDataURL(input.files[0]);
    }
  }
</script>
@endpush
