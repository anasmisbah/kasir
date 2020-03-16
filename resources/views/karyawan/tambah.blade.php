@extends('layouts.master')

@push('css')
  <link rel="stylesheet" href="/adminlte/plugins/select2/css/select2.min.css">
  <style>
    .form-group{
        margin-bottom: .5rem !important;
    }
    .form-control.form-control-sm:focus{
        color: black;
    }
    .card-title{
        color: black;
    }
    div.custom-input {

        max-width: 120px;
        height: 35px;
        content: attr(title)"asasa";
        background-color: #321fdb !important;
        color: #fff;
        overflow: hidden;
        border-radius: 5px;
    }


    .custom-input input {
        margin-top: 0px;
        display: block !important;
        width: 120px; !important;
        height: 35px !important;
        opacity: 0 !important;
        overflow: hidden !important;
    }
</style>
@endpush
@section('breadcumb')
<li class="breadcrumb-item">Beranda</li>
<li class="breadcrumb-item">Karyawan</li>
<li class="breadcrumb-item active"><a href="#">Membuat</a></li>
@endsection

@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <form role="form-horizontal" action="{{route('karyawan.simpan')}}" method="POST" enctype="multipart/form-data">
                <div class="d-flex justify-content-between mb-3">
                    <div>
                        <h4 class="card-title mb-0 text-bold">Menambahkan Karyawan</h4>
                    </div>
                    <div class="btn-toolbar d-none d-md-block" role="toolbar" aria-label="Toolbar with buttons">
                        <button type="submit" class="btn  btn-primary mr-5" style="width: 78px !important;"><i class="fa fa-save"></i></button>
                        <a class="btn btn-danger"  href="javascript:void(0)" onclick="history.back();"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                @csrf
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Foto</label><br>
                        <div class="ml-3">
                            <img src="{{asset('img/default.png')}}" id="img_foto" class="block" width="125px" style="margin-bottom:3px" alt="">
                        </div>
                        <div class="col-2 pt-5 pl-2">
                            <div class="custom-input text-center" style="font-size:12px">
                                    <input type="file" id="foto" name="foto">
                                    <p style="z-index:9999; margin-top:-28px">
                                        Unggah Foto
                                    </p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10"><input type="text" value="{{ old('nama')}}" class="form-control form-control-sm {{ $errors->first('nama')?'is-invalid':'' }}" name="nama" placeholder="Masukkan Nama">
                            <div class="invalid-feedback">
                                {{$errors->first('nama')}}
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-10"><select class="form-control form-control-sm {{ $errors->first('jenis_kelamin')?'is-invalid':'' }}" name="jenis_kelamin">
                            <option value="laki-laki" {{ old('jenis_kelamin') == 'laki-laki'?'selected':''}}>Laki-Laki</option>
                            <option value="perempuan" {{ old('jenis_kelamin') == 'perempuan'?'selected':''}}>Perempuan</option>
                        </select>
                            <div class="invalid-feedback">
                                {{$errors->first('jenis_kelamin')}}
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Jabatan</label>
                        <div class="col-sm-10"><input type="text" value="{{ old('jabatan')}}" class="form-control form-control-sm {{ $errors->first('jabatan')?'is-invalid':'' }}" name="jabatan" placeholder="Masukkan Jabatan">
                            <div class="invalid-feedback">
                                {{$errors->first('jabatan')}}
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10"><input type="text" value="{{ old('alamat')}}" class="form-control form-control-sm {{ $errors->first('alamat')?'is-invalid':'' }}" name="alamat" placeholder="Masukkan Alamat Karyawan">
                            <div class="invalid-feedback">
                                {{$errors->first('alamat')}}
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Telepon</label>
                        <div class="col-sm-10"><input type="text" value="{{ old('telepon')}}" class="form-control form-control-sm {{ $errors->first('telepon')?'is-invalid':'' }}" name="telepon" placeholder="Masukkan Telepon Karwayan">
                            <div class="invalid-feedback">
                                {{$errors->first('telepon')}}
                            </div>
                        </div>
                    </div>
                    @if (auth()->user()->level_id == 1)
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Cabang</label>
                        <div class="col-sm-10"><select class="form-control form-control-sm {{ $errors->first('branch_id')?'is-invalid':'' }}" name="branch_id">
                                @foreach ($branches as $branch)
                                    <option value="{{$branch->id}}" {{ old('branch_id') == $branch->id?'selected':''}}>{{$branch->nama}}</option>
                                @endforeach
                        </select>
                            <div class="invalid-feedback">
                                cabang wajib dipilih
                            </div>
                        </div>
                    </div>
                    @else
                        <input type="hidden" name="branch_id" value="{{auth()->user()->employee->branch_id}}">
                    @endif
                </form>
            </div>

            <div class="card-footer" style="background:#C5C6C7">
                <p></p>
            </div>
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
