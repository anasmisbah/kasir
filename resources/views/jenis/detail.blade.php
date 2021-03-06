@extends('layouts.master')
@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-6">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item">Beranda</li>
          <li class="breadcrumb-item">Jenis Barang</li>
          <li class="breadcrumb-item active"><a href="#">Detail</a></li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<div class="container-fluid">
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Detail Jenis Barang</h3>
          <div class="card-tools">
            <ul class="nav nav-pills ml-auto">
              <li class="nav-item">
                <a class="nav-link btn-danger active" href="{{ route('jenis.index') }}"><i class=" fas fa-times"></i></a>
              </li>
            </ul>
          </div>
        </div>
        <div class="card-body">
          <table class="table table-striped">
            <tbody>
              <tr>
                <td style="width:10%">Nama</td>
                <td>{{$category->nama}}</td>
              </tr>
              </tr>

            </tbody>
          </table>
          <a href="{{route('jenis.ubah',$category->id)}}" class="btn mt-2 btn-primary float-right" style="width: 78px !important;"><i class="fa fa-edit"></i></a>
        </div>

        <div class="card-footer text-right">
          <span style="font-size: 12px">
            <strong>Dibuat Pada: </strong>{{  $category->created_at->dayName." | ".$category->created_at->day." ".$category->created_at->monthName." ".$category->created_at->year}} | {{$category->created_at->format('h:i:s A')}} | <a href="{{route('karyawan.detail',$category->createdBy->employee->id)}}">{{$category->createdBy->employee->nama}}</a> / <strong>Diubah Pada: </strong>{{  $category->updated_at->dayName." | ".$category->updated_at->day." ".$category->updated_at->monthName." ".$category->updated_at->year}} | {{$category->updated_at->format('h:i:s A')}} | {{$category->updated_at->format('h:i:s A')}} | <a href="{{route('karyawan.detail',$category->updatedBy->employee->id)}}">{{$category->updatedBy->employee->nama}}</a>
        </span>

        </div>


      </div>
    </div>
  </div>
</div>
@endsection
