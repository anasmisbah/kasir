@extends('layouts.master')

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-6">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item">Beranda</li>
          <li class="breadcrumb-item">Barang</li>
          <li class="breadcrumb-item active"><a href="#">Detail</a></li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<div class="col-12 mt-1">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Barang</h3>
      <div class="card-tools">
        <ul class="nav nav-pills ml-auto">
          <li class="nav-item">
            <a class="nav-link btn-danger active" href="{{ route('barang.index') }}"><i class=" fas fa-times"></i></a>
          </li>
        </ul>
      </div>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <div class="card-body">
      <table class="table table-striped">
        <tbody>
          <tr>
            <td style="width:10%">Nama</td>
            <td>{{$item->nama}}</td>
          </tr>
          <tr>
            <td style="width:10%">Jenis</td>
            <td> <a href="{{route('jenis.detail',$item->category->id)}}">{{$item->category->nama}}</a></td>
          </tr>
          <tr>
            <td style="width:10%">Harga</td>
            <td>{{$item->harga}}</td>
          </tr>

        </tbody>
      </table>
      <form class="d-inline" id="form-delete" action="{{route('barang.hapus', $item->id)}}" method="POST">
        @csrf
        @method('DELETE')
        </form>
        <button type="submit" id="delete" class="btn ml-4 mt-2 btn-warning float-right" style="width: 78px !important;">
        <i class="fa fa-trash"></i></button>
        <a href="{{route('barang.ubah',$item->id)}}" class="btn mt-2 btn-primary float-right" style="width: 78px !important;"><i class="fa fa-edit"></i></a>
    </div>

    <div class="card-footer text-right">
      <span style="font-size: 12px">
        <strong>Dibuat Pada: </strong>{{  $item->created_at->dayName." | ".$item->created_at->day." ".$item->created_at->monthName." ".$item->created_at->year}} | {{$item->created_at->format('h:i:s A')}} | <a href="{{route('karyawan.detail',$item->createdBy->employee->id)}}">{{$item->createdBy->employee->nama}}</a> / <strong>Diubah Pada: </strong>{{  $item->updated_at->dayName." | ".$item->updated_at->day." ".$item->updated_at->monthName." ".$item->updated_at->year}} | {{$item->updated_at->format('h:i:s A')}} | {{$item->updated_at->format('h:i:s A')}} | <a href="{{route('karyawan.detail',$item->updatedBy->employee->id)}}">{{$item->updatedBy->employee->nama}}</a>      </span>
    </div>
  </div>
</div>
@endsection

@push('script')
<script src="/adminlte/plugins/sweetalert.min.js"></script>
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
