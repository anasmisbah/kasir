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
<li class="breadcrumb-item">Barang</li>
<li class="breadcrumb-item active"><a href="#"  class="text-info">Detail</a></li>
@endsection
@section('content')
<div class="col-12">
  <div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between mb-3">
            <div>
            <h4 class="card-title mb-0 text-bold">Detail Barang</h4>
            </div>
            <div class="btn-toolbar d-none d-md-block" role="toolbar" aria-label="Toolbar with buttons">
            <a class="btn btn-danger"  href="javascript:void(0)" onclick="history.back();"><i class="fa fa-times"></i></a>
            </div>
        </div>
      <table class="table table-sm table-striped">
        <tbody>
          <tr>
            <td style="width:10%">Nama</td>
            <td><strong>{{$item->nama}}</strong></td>
          </tr>
          <tr>
            <td style="width:10%">Jenis</td>
            <td> <a class="text-info" href="{{route('jenis.detail',$item->category->id)}}">{{$item->category->nama}}</a></td>
          </tr>
          <tr>
            <td style="width:10%">Harga</td>
            <td>Rp <span class="harga">{{$item->harga}}</span>,-</td>
          </tr>

        </tbody>
      </table>
      <form class="d-inline" id="form-delete" action="{{route('barang.hapus', $item->id)}}" method="POST">
        @csrf
        @method('DELETE')
        </form>
        <button type="submit" id="delete" class="btn ml-4 mt-2 btn-warning float-right" style="width: 78px !important;">
        <i class="fa fa-trash"></i></button>
        <a href="{{route('barang.ubah',$item->id)}}" class="btn mt-2 btn-info float-right" style="width: 78px !important;"><i class="fa fa-edit"></i></a>
    </div>

    <div class="card-footer text-right" style="background:#C5C6C7">
      <span style="font-size: 12px">
        <strong>Dibuat Pada: </strong>{{  $item->created_at->dayName." | ".$item->created_at->day." ".$item->created_at->monthName." ".$item->created_at->year}} | {{$item->created_at->format('h:i:s')}} WIB | <a href="{{route('karyawan.detail',$item->createdBy->employee->id)}}" class="text-info">{{$item->createdBy->employee->nama}}</a> / <strong>Diubah Pada: </strong>{{  $item->updated_at->dayName." | ".$item->updated_at->day." ".$item->updated_at->monthName." ".$item->updated_at->year}} | {{$item->updated_at->format('h:i:s')}} WIB | <a href="{{route('karyawan.detail',$item->updatedBy->employee->id)}}" class="text-info">{{$item->updatedBy->employee->nama}}</a>      </span>
    </div>
  </div>
</div>
@endsection

@push('script')
<script src="/adminlte/plugins/sweetalert.min.js"></script>
<script src="/adminlte/plugins/number-divider.min.js"></script>
<script>
    $(function () {
        // Number Divide
        $(".harga").divide({
            delimiter:'.',
            divideThousand:true
        });
    });
</script>
<script>
    $('#delete').click(()=>{
      swal({
      title: "apakah anda yakin menghapus {{$item->nama}} ?",
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
