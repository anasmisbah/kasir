@extends('layouts.master')

@push('css')
<link rel="stylesheet" href="/adminlte/plugins/select2/css/select2.min.css">
@endpush

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2 ">
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item">Beranda</li>
          <li class="breadcrumb-item">Karyawan</li>
          <li class="breadcrumb-item active"><a href="#">Detail</a></li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<div class="col-12">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Tambah Karyawan</h3>
      <div class="card-tools">
        <ul class="nav nav-pills ml-auto">
          <li class="nav-item">
            <a class="nav-link btn-danger active" href="{{ route('karyawan.index') }}"><i class=" fas fa-times"></i></a>
          </li>
        </ul>
      </div>
    </div>

    <div class="card-body">
      <table class="table table-striped">
        <tbody>
          <tr>
            <td style="width:10%">Foto</td>
            <td><img src="{{asset("/storage/".$employee->foto)}}" id="img_foto" class="block" width="125px" style="margin-bottom:3px" alt="logo"></td>
          </tr>
          <tr>
            <td style="width:10%">Nama</td>
            <td>{{$employee->nama}}</td>
          </tr>
          <tr>
            <td style="width:10%">Jenis Kelamin</td>
            <td>{{$employee->jenis_kelamin}}</td>
          </tr>
          <tr>
            <td style="width:10%">Jabatan</td>
            <td>{{$employee->jabatan}}</td>
          </tr>
          <tr>
            <td style="width:10%">Alamat</td>
            <td>{{$employee->alamat}}</td>
          </tr>
          <tr>
            <td style="width:10%">Telepon</td>
            <td>{{$employee->telepon}}</td>
          </tr>
          <tr>
            <td style="width:10%">Cabang</td>
            <td> <a href="{{route('cabang.detail',$employee->branch->id)}}">{{$employee->branch->nama}}</a></td>
          </tr>
        </tbody>
      </table>
      <form class="d-inline" id="form-delete"  action="{{route('karyawan.hapus', $employee->id)}}" method="POST">
        @csrf
        @method('DELETE')
        </form>
        <button type="submit" id="delete" class="btn ml-4 mt-2 btn-warning float-right" style="width: 78px !important;">
        <i class="fa fa-trash"></i></button>
        <a href="{{route('karyawan.ubah',$employee->id)}}" class="btn mt-2 btn-primary float-right" style="width: 78px !important;"><i class="fa fa-edit"></i></a>
    </div>

    <div class="card-footer text-right">
      <span style="font-size: 12px">
        <strong>Dibuat Pada: </strong>{{  $employee->created_at->dayName." | ".$employee->created_at->day." ".$employee->created_at->monthName." ".$employee->created_at->year}} | {{$employee->created_at->format('h:i:s A')}} | <a href="{{route('karyawan.detail',$employee->createdBy->employee->id)}}">{{$employee->createdBy->employee->nama}}</a> / <strong>Diubah Pada: </strong>{{  $employee->updated_at->dayName." | ".$employee->updated_at->day." ".$employee->updated_at->monthName." ".$employee->updated_at->year}} | {{$employee->updated_at->format('h:i:s A')}} | {{$employee->updated_at->format('h:i:s A')}} | <a href="{{route('karyawan.detail',$employee->updatedBy->employee->id)}}">{{$employee->updatedBy->employee->nama}}</a>
        </span>
    </div>
  </div>
</div>
@endsection

@push('script')
<script src="/adminlte/plugins/select2/js/select2.full.min.js"></script>
<script src="/adminlte/plugins/sweetalert.min.js"></script>
<script>
    $('#delete').click(()=>{
      swal({
      title: "apakah anda yakin menghapus {{$employee->nama}} ?",
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
<script>
  $(function() {
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

      reader.onload = function(e) {
        $('#img_foto').attr('src', e.target.result);
      };

      reader.readAsDataURL(input.files[0]);
    }
  }
</script>
@endpush
