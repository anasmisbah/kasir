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
<li class="breadcrumb-item">Stok Barang</li>
<li class="breadcrumb-item active"><a href="#"  class="text-info">Detail</a></li>
@endsection
@section('content')
<div class="col-12 ">
    <div class="card mt-3">
        <div class="card-body">
        <div class="d-flex justify-content-between mb-3">
            <div>
            <h4 class="card-title mb-0 text-bold">Detail Stok Barang</h4>
            </div>
            <div class="btn-toolbar d-none d-md-block" role="toolbar" aria-label="Toolbar with buttons">
            <a class="btn btn-danger"  href="{{ route('stok.index') }}"><i class="fa fa-times"></i></a>
            </div>
        </div>
            <table class="table table-striped">
                <tbody>
                  <tr>
                    <td style="width:10%">Nama</td>
                    <td><a class="text-info" href="{{route('barang.detail',$supply->item->id)}}">{{$supply->item->nama}}</a></td>
                  </tr>
                  <tr>
                    <td style="width:10%">Cabang</td>
                    <td> <a class="text-info" href="{{route('cabang.detail',$supply->branch->id)}}">{{$supply->branch->nama}}</a></td>
                  </tr>
                  <tr>
                    <td style="width:10%">Harga Pusat</td>
                    <td>Rp <span class="harga">{{$supply->item->harga}}</span>,-</td>
                  </tr>
                  <tr>
                    <td style="width:10%">Harga Cabang</td>
                    <td>Rp <span class="harga">{{$supply->harga_cabang}}</span>,-</td>
                  </tr>
                  <tr>
                    <td style="width:10%">Harga Selisih</td>
                    <td>Rp <span class="harga">{{$supply->harga_selisih}}</span>,-</td>
                  </tr>
                  <tr>
                    <td style="width:10%">Stok</td>
                    <td>{{$supply->stok}}</td>
                  </tr>

                </tbody>
              </table>
              <form class="d-inline" onsubmit="return confirm('Apakah anda ingin menghapus stok Barang secara permanen?')" action="{{route('stok.hapus', $supply->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn ml-4 mt-2 btn-warning float-right" style="width: 78px !important;">
                  <i class="fa fa-trash"></i></button>
              </form>
              @if (auth()->user()->level_id == 2)
              <a href="{{route('stok.ubah',$supply->id)}}" class="btn mt-2 btn-info float-right" style="width: 78px !important;"><i class="fa fa-edit"></i></a>
              @endif
            </div>

                <div class="card-footer text-right" style="background:#C5C6C7">
                    <span style="font-size: 12px">
                        <strong>Dibuat Pada: </strong>{{  $supply->created_at->dayName." | ".$supply->created_at->day." ".$supply->created_at->monthName." ".$supply->created_at->year}} | {{$supply->created_at->format('h:i:s A')}} | <a href="{{route('karyawan.detail',$supply->createdBy->employee->id)}}" class="text-info">{{$supply->createdBy->employee->nama}}</a> / <strong>Diubah Pada: </strong>{{  $supply->updated_at->dayName." | ".$supply->updated_at->day." ".$supply->updated_at->monthName." ".$supply->updated_at->year}} | {{$supply->updated_at->format('h:i:s A')}} | {{$supply->updated_at->format('h:i:s A')}} | <a href="{{route('karyawan.detail',$supply->updatedBy->employee->id)}}" class="text-info">{{$supply->updatedBy->employee->nama}}</a>
                    </span>
                </div>
    </div>
</div>
@endsection

@push('script')
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
@endpush
