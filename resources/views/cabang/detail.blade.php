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
<li class="breadcrumb-item">Cabang</li>
<li class="breadcrumb-item active"><a href="#"  >Detail</a></li>
@endsection
@section('content')
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <div>
                    <h4 class="card-title mb-0 text-bold">Detail Cabang</h4>
                </div>
                <div class="btn-toolbar d-none d-md-block" role="toolbar" aria-label="Toolbar with buttons">
                    <a href="{{route('cabang.ubah',$branch->id)}}" class="btn mr-2 btn-primary" style="width: 78px !important;"><i class="fa fa-edit"></i></a>
                    <form class="d-inline" id="form-delete" action="{{route('cabang.hapus', $branch->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                    </form>
                    <button type="submit" id="delete" class="btn mr-5 btn-warning" style="width: 78px !important;">
                        <i class="fa fa-trash"></i></button>
                    <a class="btn btn-danger"  href="javascript:void(0)" onclick="history.back();"><i class="fa fa-times"></i></a>
                </div>
            </div>
          <table class="table table-sm table-striped">
            <tbody>
              <tr>
                <td style="width:10%">Nama</td>
                <td><strong>{{$branch->nama}}</strong> </td>
              </tr>
              <tr>
                <td style="width:10%">Kode Cabang</td>
                <td>{{$branch->kode}}</td>
              </tr>
              <tr>
                <td style="width:10%">Alamat</td>
                <td>{{$branch->alamat}}</td>
              </tr>
              <tr>
                <td style="width:10%">Telepon</td>
                <td>{{$branch->telepon}}</td>
              </tr>
              <tr>
                <td style="width:10%">Pimpinan</td>
                <td>{{$branch->pimpinan}}</td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="card-footer text-right" style="background:#C5C6C7">
          <span style="font-size: 12px">
            <strong>Dibuat pada: </strong>{{  $branch->created_at->dayName." | ".$branch->created_at->day." ".$branch->created_at->monthName." ".$branch->created_at->year}} | {{$branch->created_at->format('h:i:s')}} WIB | <a href="{{route('karyawan.detail',$branch->createdBy->employee->id)}}" >{{$branch->createdBy->employee->nama}}</a> / <strong>Diubah pada: </strong>{{  $branch->updated_at->dayName." | ".$branch->updated_at->day." ".$branch->updated_at->monthName." ".$branch->updated_at->year}} | {{$branch->updated_at->format('h:i:s')}} WIB | <a href="{{route('karyawan.detail',$branch->updatedBy->employee->id)}}" >{{$branch->updatedBy->employee->nama}}</a>
        </span>
        </div>
      </div>
    </div>
@endsection

@push('script')
<script src="/adminlte/plugins/sweetalert.min.js"></script>
<script>
    $('#delete').click(()=>{
      swal({
      title: "apakah anda yakin menghapus cabang {{$branch->nama}}?",
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
@endpush
