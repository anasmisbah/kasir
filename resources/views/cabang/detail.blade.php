@extends('layouts.master')
@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-6">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item">Beranda</li>
          <li class="breadcrumb-item">Cabang</li>
          <li class="breadcrumb-item active"><a href="#">Detail</a></li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<div class="container-fluid">
  <div class="row">
    <!-- left column -->
    <div class="col-md-12 mt-3">
      <!-- general form elements -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Cabang</h3>
          <div class="card-tools">
            <ul class="nav nav-pills ml-auto">
              <li class="nav-item">
                <a class="nav-link btn-danger active" href="{{ route('cabang.index') }}"><i class=" fas fa-times"></i></a>
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
                <td> <strong>{{$branch->nama}}</strong> </td>
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
          <form class="d-inline" id="form-delete" action="{{route('cabang.hapus', $branch->id)}}" method="POST">
            @csrf
            @method('DELETE')
            </form>
            <button type="submit" id="delete" class="btn ml-4 mt-2 btn-warning float-right" style="width: 78px !important;">
              <i class="fa fa-trash"></i></button>
            <a href="{{route('cabang.ubah',$branch->id)}}" class="btn mt-2 btn-primary float-right" style="width: 78px !important;"><i class="fa fa-edit"></i></a>
        </div>

        <div class="card-footer text-right">
          <span style="font-size: 12px">
            <strong>Dibuat Pada: </strong>{{  $branch->created_at->dayName." | ".$branch->created_at->day." ".$branch->created_at->monthName." ".$branch->created_at->year}} | {{$branch->created_at->format('h:i:s A')}} | <a href="{{route('karyawan.detail',$branch->createdBy->employee->id)}}">{{$branch->createdBy->employee->nama}}</a> / <strong>Diubah Pada: </strong>{{  $branch->updated_at->dayName." | ".$branch->updated_at->day." ".$branch->updated_at->monthName." ".$branch->updated_at->year}} | {{$branch->updated_at->format('h:i:s A')}} | {{$branch->updated_at->format('h:i:s A')}} | <a href="{{route('karyawan.detail',$branch->updatedBy->employee->id)}}">{{$branch->updatedBy->employee->nama}}</a>
        </span>
        </div>
      </div>
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
