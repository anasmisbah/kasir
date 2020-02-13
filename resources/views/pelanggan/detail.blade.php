@extends('layouts.master')

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2 ">
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item">Beranda</li>
          <li class="breadcrumb-item">Pelanggan</li>
          <li class="breadcrumb-item active"><a href="#">Detail</a></li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<div class="col-12">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Pelanggan</h3>
      <div class="card-tools">
        <ul class="nav nav-pills ml-auto">
          <li class="nav-item">
            <a class="nav-link btn-danger active" href="{{ route('pelanggan.index') }}"><i class=" fas fa-times"></i></a>
          </li>
        </ul>
      </div>
    </div>
    <div class="card-body">
      <table class="table table-striped">
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
            <td><a href="{{route('cabang.detail',$customer->branch->id)}}">{{$customer->branch->nama}}</a></td>
          </tr>
        </tbody>
      </table>
      <form class="d-inline" id="form-delete" action="{{route('pelanggan.hapus', $customer->id)}}" method="POST">
        @csrf
        @method('DELETE')
        </form>
        <button id="delete" type="submit" class="btn ml-4 mt-2 btn-warning float-right" style="width: 78px !important;">
          <i class="fa fa-trash"></i></button>
      <a href="{{route('pelanggan.ubah',$customer->id)}}" class="btn mt-2 btn-primary float-right" style="width: 78px !important;"><i class="fa fa-edit"></i></a>
    </div>

    <div class="card-footer text-right">
      <span style="font-size: 12px">
        <strong>Dibuat Pada: </strong>{{  $customer->created_at->dayName." | ".$customer->created_at->day." ".$customer->created_at->monthName." ".$customer->created_at->year}} | {{$customer->created_at->format('h:i:s A')}} | <a href="{{route('karyawan.detail',$customer->createdBy->employee->id)}}">{{$customer->createdBy->employee->nama}}</a> / <strong>Diubah Pada: </strong>{{  $customer->updated_at->dayName." | ".$customer->updated_at->day." ".$customer->updated_at->monthName." ".$customer->updated_at->year}} | {{$customer->updated_at->format('h:i:s A')}} | {{$customer->updated_at->format('h:i:s A')}} | <a href="{{route('karyawan.detail',$customer->updatedBy->employee->id)}}">{{$customer->updatedBy->employee->nama}}</a>
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
