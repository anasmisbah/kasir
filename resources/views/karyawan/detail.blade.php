@extends('layouts.master')

@push('css')
    <style>
    .btn-warning{
        color: white;
    }
    .btn-warning:hover{
        color: white;
    }
    </style>
@endpush
@section('breadcumb')
<li class="breadcrumb-item">Beranda</li>
<li class="breadcrumb-item">Karyawan</li>
<li class="breadcrumb-item active"><a href="#" >Detail</a></li>
@endsection

@section('content')
<div class="col-12">
  <div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between mb-3">
            <div>
                <h4 class="card-title mb-0 text-bold">Detail Karyawan</h4>
            </div>
            <div class="btn-toolbar d-none d-md-block" role="toolbar" aria-label="Toolbar with buttons">
                @if (auth()->user()->level_id == 1)
                <a href="{{route('karyawan.ubah',$employee->id)}}" class="btn btn-primary" style="width: 78px !important;"><i class="fa fa-edit"></i></a>

                    <form class="d-inline" id="form-delete"  action="{{route('karyawan.hapus', $employee->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                    </form>
                    <button type="submit" id="delete" class="btn ml-2 btn-warning" style="width: 78px !important;">
                        <i class="fa fa-trash"></i>
                    </button>
                @endif
                <a class="btn btn-danger ml-5"  href="javascript:void(0)" onclick="history.back();"><i class="fa fa-times"></i></a>
            </div>
        </div>
      <table class="table table-sm table-striped">
        <tbody>
          <tr>
            <td style="width:10%">Foto</td>
            <td><img src="{{asset("/uploads/".$employee->foto)}}" id="img_foto" class="block" width="125px" style="margin-bottom:3px" alt="logo"></td>
          </tr>
          <tr>
            <td style="width:10%">Kode</td>
            <td><b>{{$employee->kode}}</b></td>
          </tr>
          <tr>
            <td style="width:10%">Nama</td>
            <td><b>{{$employee->nama}}</b></td>
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
            <td> <a  href="{{route('cabang.detail',$employee->branch->id)}}">{{$employee->branch->nama}}</a></td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="card-footer text-right" style="background:#C5C6C7">
      <span style="font-size: 12px">
        <strong>Dibuat pada: </strong>{{  $employee->created_at->dayName." | ".$employee->created_at->day." ".$employee->created_at->monthName." ".$employee->created_at->year}} | {{$employee->created_at->format('h:i:s')}} WIB | <a  href="{{route('karyawan.detail',$employee->createdBy->employee->id)}}">{{$employee->createdBy->employee->nama}}</a> / <strong>Diubah pada: </strong>{{  $employee->updated_at->dayName." | ".$employee->updated_at->day." ".$employee->updated_at->monthName." ".$employee->updated_at->year}} | {{$employee->updated_at->format('h:i:s A')}} WIB | <a  href="{{route('karyawan.detail',$employee->updatedBy->employee->id)}}">{{$employee->updatedBy->employee->nama}}</a>
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
