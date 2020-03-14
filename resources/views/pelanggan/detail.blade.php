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
<li class="breadcrumb-item">Pelanggan</li>
<li class="breadcrumb-item active"><a href="#"  >Detail</a></li>
@endsection
@section('content')
<div class="col-12">
  <div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between mb-3">
            <div>
                <h4 class="card-title mb-0 text-bold">Detail Pelanggan</h4>
            </div>
            <div class="btn-toolbar d-none d-md-block" role="toolbar" aria-label="Toolbar with buttons">
                @if (auth()->user()->level_id == 2)
                    <a href="{{route('pelanggan.ubah',$customer->id)}}" class="btn mr-2 btn-primary" style="width: 78px !important;"><i class="fa fa-edit"></i></a>
                @endif
                <form class="d-inline" id="form-delete" action="{{route('pelanggan.hapus', $customer->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                </form>
                <button id="delete" type="submit" class="btn mr-5  btn-warning" style="width: 78px !important;">
                    <i class="fa fa-trash"></i>
                </button>
                <a class="btn btn-danger"  href="javascript:void(0)" onclick="history.back();"><i class="fa fa-times"></i></a>
            </div>
        </div>
        <table class="table table-sm table-striped">
            <tbody>
            <tr>
                <td style="width:10%">Nama</td>
                <td> <strong>{{$customer->nama}}</strong> </td>
            </tr>
            <tr>
                <td style="width:10%">Alamat</td>
                <td>{{$customer->alamat}}</td>
            </tr>
            <tr>
                <td style="width:10%">Telepon</td>
                <td>{{$customer->telepon}}</td>
            </tr>
            <tr>
                <td style="width:10%">Cabang</td>
                <td><a  href="{{route('cabang.detail',$customer->branch->id)}}">{{$customer->branch->nama}}</a></td>
            </tr>
            </tbody>
        </table>
    </div>

    <div class="card-footer text-right" style="background:#C5C6C7">
      <span style="font-size: 12px">
        <strong>Dibuat pada: </strong>{{  $customer->created_at->dayName." | ".$customer->created_at->day." ".$customer->created_at->monthName." ".$customer->created_at->year}} | {{$customer->created_at->format('h:i:s')}} WIB | <a  href="{{route('karyawan.detail',$customer->createdBy->employee->id)}}">{{$customer->createdBy->employee->nama}}</a> / <strong>Diubah pada: </strong>{{  $customer->updated_at->dayName." | ".$customer->updated_at->day." ".$customer->updated_at->monthName." ".$customer->updated_at->year}} | {{$customer->updated_at->format('h:i:s')}} WIB | <a  href="{{route('karyawan.detail',$customer->updatedBy->employee->id)}}">{{$customer->updatedBy->employee->nama}}</a>
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
      title: "apakah anda yakin menghapus pelanggan {{$customer->nama}}?",
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
