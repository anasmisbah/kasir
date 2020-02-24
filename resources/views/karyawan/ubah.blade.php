@extends('layouts.master')

@push('css')
  <link rel="stylesheet" href="/adminlte/plugins/select2/css/select2.min.css">
  <style>
    .form-group{
      margin-bottom: .5rem !important;
    }
</style>
@endpush

@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-6">
          <ol class="breadcrumb float-sm-left">
            <li class="breadcrumb-item">Beranda</li>
            <li class="breadcrumb-item">Karyawan</li>
            <li class="breadcrumb-item active"><a href="#">Memperbarui</a></li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Ubah Karyawan</h3>
            <div class="card-tools">
                <ul class="nav nav-pills ml-auto">
                  <li class="nav-item">
                    <a class="nav-link btn-danger active" href="{{ route('karyawan.index') }}"><i class=" fas fa-times"></i></a>
                  </li>
                </ul>
              </div>
        </div>

        <form role="form-horizontal" action="{{route('karyawan.perbarui',$employee->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Foto</label><br>
                    <div class="col-sm-4">
                        <img src="{{asset("/storage/".$employee->foto)}}" id="img_foto" class="block" width="125px" style="margin-bottom:3px" alt="">
                        <div class="btn btn-primary btn-file">
                            Unggah Foto
                            <input type="file" id="foto" name="foto">
                        </div>
                        <div class="invalid-feedback">
                            {{$errors->first('foto')}}
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10"><input type="text" value="{{ old('nama')?old('nama'):$employee->nama }}" class="form-control form-control-sm {{ $errors->first('nama')?'is-invalid':'' }}" name="nama" placeholder="Masukkan Nama">
                        <div class="invalid-feedback">
                            {{$errors->first('nama')}}
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-10"><select class="form-control form-control-sm {{ $errors->first('jenis_kelamin')?'is-invalid':'' }}" name="jenis_kelamin">
                        <option value="laki-laki" {{$employee->jenis_kelamin == "laki-laki"?"selected":""}}>Laki-Laki</option>
                        <option value="perempuan" {{$employee->jenis_kelamin == "perempuan"?"selected":""}}>Perempuan</option>
                    </select>
                        <div class="invalid-feedback">
                            {{$errors->first('jenis_kelamin')}}
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Jabatan</label>
                    <div class="col-sm-10"><input type="text" value="{{ old('jabatan')?old('jabatan'):$employee->jabatan }}" class="form-control form-control-sm {{ $errors->first('jabatan')?'is-invalid':'' }}" name="jabatan" placeholder="Masukkan Jabatan">
                        <div class="invalid-feedback">
                            {{$errors->first('jabatan')}}
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10"><input type="text" value="{{ old('alamat')?old('alamat'):$employee->alamat }}" class="form-control form-control-sm {{ $errors->first('alamat')?'is-invalid':'' }}" name="alamat" placeholder="Masukkan Alamat Karyawan">
                        <div class="invalid-feedback">
                            {{$errors->first('alamat')}}
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Telepon</label>
                    <div class="col-sm-10"><input type="text" value="{{ old('telepon')?old('telepon'):$employee->telepon }}" class="form-control form-control-sm {{ $errors->first('telepon')?'is-invalid':'' }}" name="telepon" placeholder="Masukkan Telepon Karwayan">
                        <div class="invalid-feedback">
                            {{$errors->first('telepon')}}
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Cabang</label>
                    <div class="col-sm-10"><select class="form-control form-control-sm {{ $errors->first('branch_id')?'is-invalid':'' }}" name="branch_id">
                            @foreach ($branches as $branch)
                                <option value="{{$branch->id}}" {{$employee->branch_id == $branch->id?"selected":""}} >{{$branch->nama}}</option>
                            @endforeach
                    </select>
                        <div class="invalid-feedback">
                            cabang wajib dipilih
                        </div>
                    </div>
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
<script src="/adminlte/plugins/select2/js/select2.full.min.js"></script>
<script>
  $(function () {
    $('.select2').select2()

  });
</script>
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
