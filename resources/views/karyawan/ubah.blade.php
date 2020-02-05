@extends('layouts.master')

@push('css')
  <link rel="stylesheet" href="/adminlte/plugins/select2/css/select2.min.css">
@endpush

@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Ubah Karyawan</h3>
        </div>

        <form role="form" action="{{route('karyawan.perbarui',$employee->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label>Foto</label><br>
                    <img src="{{asset("/storage/".$employee->foto)}}" id="img_foto" class="block" width="125px" style="margin-bottom:3px" alt="">
                    <input type="file" id="foto" class="form-control" name="foto">
                </div>
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" value="{{$employee->nama}}" class="form-control" name="nama" placeholder="Masukkan Nama">
                </div>
                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <select class="form-control" name="jenis_kelamin">
                        <option value="laki-laki" {{$employee->jenis_kelamin == "laki-laki"?"selected":""}}>Laki-Laki</option>
                        <option value="perempuan" {{$employee->jenis_kelamin == "perempuan"?"selected":""}}>Perempuan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Jabatan</label>
                    <input type="text" value="{{$employee->jabatan}}" class="form-control" name="jabatan" placeholder="Masukkan Jabatan">
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" value="{{$employee->alamat}}" class="form-control" name="alamat" placeholder="Masukkan Alamat Karyawan">
                </div>
                <div class="form-group">
                    <label>Telepon</label>
                    <input type="text" value="{{$employee->telepon}}" class="form-control" name="telepon" placeholder="Masukkan Telepon Karwayan">
                </div>
                <div class="form-group">
                    <label>Cabang</label>
                    <select class="form-control select2" name="branch_id">
                            @foreach ($branches as $branch)
                                <option value="{{$branch->id}}" {{$employee->branch_id == $branch->id?"selected":""}} >{{$branch->nama}}</option>
                            @endforeach
                    </select>
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
