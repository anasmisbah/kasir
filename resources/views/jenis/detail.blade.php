@extends('layouts.master')
@section('breadcumb')
<li class="breadcrumb-item">Beranda</li>
<li class="breadcrumb-item">Jenis Barang</li>
<li class="breadcrumb-item active"><a href="#"  class="text-info">Detail</a></li>
@endsection
@section('content')
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <div>
                    <h4 class="card-title mb-0 text-bold">Detail jenis Barang</h4>
                    </div>
                    <div class="btn-toolbar d-none d-md-block" role="toolbar" aria-label="Toolbar with buttons">
                    <a class="btn btn-danger" href="javascript:void(0)" onclick="history.back();"><i class="fa fa-times"></i></a>
                </div>
            </div>
          <table class="table table-striped">
            <tbody>
              <tr>
                <td style="width:10%">Nama</td>
                <td> <b>{{$category->nama}}</b></td>
              </tr>
            </tbody>
          </table>
          <a href="{{route('jenis.ubah',$category->id)}}" class="btn mt-2 btn-info float-right" style="width: 78px !important;"><i class="fa fa-edit"></i></a>
        </div>

        <div class="card-footer text-right" style="background:#C5C6C7">
          <span style="font-size: 12px">
            <strong>Dibuat Pada: </strong>{{  $category->created_at->dayName." | ".$category->created_at->day." ".$category->created_at->monthName." ".$category->created_at->year}} | {{$category->created_at->format('h:i:s')}} WIB | <a href="{{route('karyawan.detail',$category->createdBy->employee->id)}}" class="text-info">{{$category->createdBy->employee->nama}}</a> / <strong>Diubah Pada: </strong>{{  $category->updated_at->dayName." | ".$category->updated_at->day." ".$category->updated_at->monthName." ".$category->updated_at->year}} | {{$category->updated_at->format('h:i:s')}} WIB | <a href="{{route('karyawan.detail',$category->updatedBy->employee->id)}}" class="text-info">{{$category->updatedBy->employee->nama}}</a>
        </span>

        </div>


      </div>
    </div>
  </div>
@endsection
