@extends('layouts.master')

@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2 ">
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-left">
            <li class="breadcrumb-item">Beranda</li>
            <li class="breadcrumb-item">Tentang Aplikasi</li>
            <li class="breadcrumb-item active"><a href="#">Memperbarui</a></li>
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

        <form class="form-horizontal" action="{{route('tentang.perbarui',$app->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Logo</label>
                    <div class="col-sm-10"><img src="{{asset("/storage/".$app->logo)}}" id="img_foto" class="block" width="125px" style="margin-bottom:3px" alt="logo">
                        <input type="file"  id="foto" class="btn" name="logo" >
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Aplikasi</label>
                    <div class="col-sm-10"><input type="text" value="{{$app->nama}}" class="form-control" name="nama" placeholder="Masukkan Nama"></div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Toko</label>
                    <div class="col-sm-10"><input type="text" value="{{$app->toko}}" class="form-control" name="toko" placeholder="Masukkan Jabatan"></div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10"><input type="text" value="{{$app->alamat}}" class="form-control" name="alamat" placeholder="Masukkan Alamat Karyawan"></div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Telepon</label>
                    <div class="col-sm-10"><input type="text" value="{{$app->telepon}}" class="form-control" name="telepon" placeholder="Masukkan Telepon Karwayan"></div>
                </div>
                <button type="submit" class="btn  btn-primary float-right" style="width: 78px !important;"><i class="fa fa-save"></i></button>
            </div>

            <div class="card-footer">
                <p></p>
            </div>
        </form>
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

      reader.onload = function (e) {
          $('#img_foto').attr('src', e.target.result);
      };

      reader.readAsDataURL(input.files[0]);
  }
}
    </script>
@endpush
