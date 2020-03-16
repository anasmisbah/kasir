@extends('layouts.master')
@section('breadcumb')
<li class="breadcrumb-item">Beranda</li>
<li class="breadcrumb-item">Tentang Aplikasi</li>
<li class="breadcrumb-item active"><a href="#" >Detail</a></li>
@endsection
@section('content')
<div class="col-12">
  <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between mb-3">
            <div>
                <h4 class="card-title mb-0 text-bold">Detail Tentang Aplikasi</h4>
            </div>
            <div class="btn-toolbar d-none d-md-block" role="toolbar" aria-label="Toolbar with buttons">
                <a href="{{route('tentang.ubah')}}" class="btn btn-primary mr-5" style="width: 78px !important;"><i class="fa fa-edit"></i></a>
                <a class="btn btn-danger"  href="javascript:void(0)" onclick="history.back();"><i class="fa fa-times"></i></a>
            </div>
        </div>
      <table class="table table-sm table-striped">
        <tbody>
          <tr>
            <td style="width:10%">Logo</td>
            <td><img src="{{asset("/uploads/".$app->logo)}}" id="img_foto" class="block" width="125px" style="margin-bottom:3px" alt="logo"></td>
          </tr>
          <tr>
            <td style="width:10%">Nama Aplikasi</td>
            <td><strong>{{$app->nama}}</strong></td>
          </tr>
          <tr>
            <td style="width:10%">Nama Toko</td>
            <td><strong>{{$app->toko}}</strong></td>
          </tr>
          <tr>
            <td style="width:10%">Telepon</td>
            <td>{{$app->telepon}}</td>
          </tr>
          <tr>
            <td style="width:10%">Alamat</td>
            <td>{{$app->alamat}}, {{$app->kecamatan}}, {{$app->kota}}, {{$app->provinsi}}</td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="card-footer text-right" style="background:#C5C6C7">
      <span style="font-size: 12px">
        <strong>Dibuat pada: </strong>{{  $app->created_at->dayName." | ".$app->created_at->day." ".$app->created_at->monthName." ".$app->created_at->year}} | {{$app->created_at->format('h:i:s')}} WIB | <a href="{{route('karyawan.detail',$app->createdBy->employee->id)}}">{{$app->createdBy->employee->nama}}</a> / <strong>Diubah pada: </strong>{{  $app->updated_at->dayName." | ".$app->updated_at->day." ".$app->updated_at->monthName." ".$app->updated_at->year}} | {{$app->updated_at->format('h:i:s')}} WIB | <a href="{{route('karyawan.detail',$app->updatedBy->employee->id)}}" >{{$app->updatedBy->employee->nama}}</a>
      </span>
    </div>
  </div>
</div>
@endsection
