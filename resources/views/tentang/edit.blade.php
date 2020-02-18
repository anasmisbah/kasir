@extends('layouts.master')

@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-6">
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
            <h3 class="card-title">Ubah Aplikasi Toko</h3>
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
                    <label class="col-2">Logo</label>
                    <img id="img_foto" class="block" width="125px" style="margin-bottom:3px" alt="logo" src="{{asset('/storage/'.$app->logo)}}">
                    <div class="col-4"><input type="file" id="foto" style="margin-top:10%" class="form-control form-control-sm {{ $errors->first('logo')?'is-invalid':'' }}" name="logo">
                        <div class="invalid-feedback">
                            {{$errors->first('logo')}}
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2">Nama Aplikasi:</label>
                    <div class="col-6"><input type="text" value="{{ old('nama')?old('nama'):$app->nama }}" class="form-control form-control-sm {{ $errors->first('nama')?'is-invalid':'' }}" name="nama" placeholder="Masukkan Nama">
                        <div class="invalid-feedback">
                            {{$errors->first('nama')}}
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2">Nama Toko:</label>
                    <div class="col-6"><input type="text" value="{{ old('toko')?old('toko'):$app->toko }}" class="form-control form-control-sm {{ $errors->first('toko')?'is-invalid':'' }}" name="toko" placeholder="Masukkan Jabatan">
                        <div class="invalid-feedback">
                            {{$errors->first('toko')}}
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2">Alamat:</label>
                    <div class="col-6"><input type="text" value="{{ old('alamat')?old('alamat'):$app->alamat }}" class="form-control form-control-sm {{ $errors->first('alamat')?'is-invalid':'' }}" name="alamat" placeholder="Masukkan Alamat Karyawan">
                        <div class="invalid-feedback">
                            {{$errors->first('alamat')}}
                        </div>

                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2">Telepon</label>
                    <div class="col-6"><input type="text" value="{{ old('telepon')?old('telepon'):$app->telepon }}" class="form-control form-control-sm {{ $errors->first('telepon')?'is-invalid':'' }} {{ $errors->first('telepon')?'is-invalid':'' }}" name="telepon" placeholder="Masukkan Telepon Karwayan">
                        <div class="invalid-feedback">
                            {{$errors->first('telepon')}}
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn  btn-primary float-right " style="width: 78px !important;"><i class="fa fa-save"></i></button>
            </div>
            <div class="card-footer">
                <p></p>
            </div>
    </div>
    </form>
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
