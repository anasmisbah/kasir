@extends('layouts.master')

@push('css')
  <style>
    .form-group{
        margin-bottom: .5rem !important;
    }
    .form-control.form-control-sm:focus{
        border-color: #39f;
        box-shadow: 0 0 0 0.2rem rgba(51, 153, 255, 0.25);
        color: black;
    }
    .card-title{
        color: black;
    }

    div.custom-input {
        max-width: 120px;
        height: 35px;
        content: attr(title)"asasa";
        background-color: #3399fe !important;
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
<li class="breadcrumb-item active"><a href="#"  class="text-info">Memperbarui</a></li>
@endsection

@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <div>
                    <h4 class="card-title mb-0 text-bold">Memperbarui Karyawan</h4>
                </div>
                <div class="btn-toolbar d-none d-md-block" role="toolbar" aria-label="Toolbar with buttons">
                    <a class="btn btn-danger"  href="{{ route('karyawan.index') }}"><i class="fa fa-times"></i></a>
                </div>
            </div>
            <form role="form-horizontal" action="{{route('karyawan.perbarui',$employee->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Foto</label><br>
                    <div class="ml-3">
                        <img src="{{asset("/storage/".$employee->foto)}}" id="img_foto" class="block" width="125px" style="margin-bottom:3px" alt="">
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
                <button type="submit" class="btn  btn-info float-right" style="width: 78px !important;"><i class="fa fa-save"></i></button>
            </form>
        </div>
        <div class="card-footer text-right" style="background:#C5C6C7">
            <span style="font-size: 12px">
                <strong>Dibuat Pada: </strong>{{  $employee->created_at->dayName." | ".$employee->created_at->day." ".$employee->created_at->monthName." ".$employee->created_at->year}} | {{$employee->created_at->format('h:i:s A')}} | <a class="text-info" href="{{route('karyawan.detail',$employee->createdBy->employee->id)}}">{{$employee->createdBy->employee->nama}}</a> / <strong>Diubah Pada: </strong>{{  $employee->updated_at->dayName." | ".$employee->updated_at->day." ".$employee->updated_at->monthName." ".$employee->updated_at->year}} | {{$employee->updated_at->format('h:i:s')}} WIB | <a class="text-info" href="{{route('karyawan.detail',$employee->updatedBy->employee->id)}}">{{$employee->updatedBy->employee->nama}}</a>
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

      reader.onload = function (e) {
          $('#img_foto').attr('src', e.target.result);
      };

      reader.readAsDataURL(input.files[0]);
  }
}
    </script>
@endpush
