@extends('layouts.master')

@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Ubah Karyawan</h3>
        </div>

        <form role="form" action="{{route('tentang.perbarui',$app->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label>Logo</label><br>
                    <img src="{{asset("/storage/".$app->logo)}}" id="img_foto" class="block" width="125px" style="margin-bottom:3px" alt="logo">
                    <input type="file" id="foto" class="form-control" name="logo">
                </div>
                <div class="form-group">
                    <label>Nama Aplikasi</label>
                    <input type="text" value="{{$app->nama}}" class="form-control" name="nama" placeholder="Masukkan Nama">
                </div>
                <div class="form-group">
                    <label>Nama Toko</label>
                    <input type="text" value="{{$app->toko}}" class="form-control" name="toko" placeholder="Masukkan Jabatan">
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" value="{{$app->alamat}}" class="form-control" name="alamat" placeholder="Masukkan Alamat Karyawan">
                </div>
                <div class="form-group">
                    <label>Telepon</label>
                    <input type="text" value="{{$app->telepon}}" class="form-control" name="telepon" placeholder="Masukkan Telepon Karwayan">
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-lg btn-primary float-right"><i class="fa fa-save"></i></button>
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
