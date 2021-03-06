@extends('layouts.master')

@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-6">
          <ol class="breadcrumb float-sm-left">
            <li class="breadcrumb-item">Beranda</li>
            <li class="breadcrumb-item">Stok Barang</li>
            <li class="breadcrumb-item active"><a href="#">Detail</a></li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
<div class="col-12 ">
    <div class="card mt-3">
        <div class="card-header">
            <h3 class="card-title">Detail Stok Barang</h3>
            <div class="card-tools">
                <ul class="nav nav-pills ml-auto">
                  <li class="nav-item">
                    <a class="nav-link btn-danger active" href="{{ route('stok.index') }}"><i class=" fas fa-times"></i></a>
                  </li>
                </ul>
              </div>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <tbody>
                  <tr>
                    <td style="width:10%">Nama</td>
                    <td><a href="{{route('barang.detail',$supply->item->id)}}">{{$supply->item->nama}}</a></td>
                  </tr>
                  <tr>
                    <td style="width:10%">Cabang</td>
                    <td> <a href="{{route('cabang.detail',$supply->branch->id)}}">{{$supply->branch->nama}}</a></td>
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
              <a href="{{route('stok.ubah',$supply->id)}}" class="btn mt-2 btn-primary float-right" style="width: 78px !important;"><i class="fa fa-edit"></i></a>
            </div>

                <div class="card-footer text-right">
                    <strong>Dibuat Pada: </strong>{{  $supply->created_at->dayName." | ".$supply->created_at->day." ".$supply->created_at->monthName." ".$supply->created_at->year}} | {{$supply->created_at->format('h:i:s A')}} | <a href="{{route('karyawan.detail',$supply->createdBy->employee->id)}}">{{$supply->createdBy->employee->nama}}</a> / <strong>Diubah Pada: </strong>{{  $supply->updated_at->dayName." | ".$supply->updated_at->day." ".$supply->updated_at->monthName." ".$supply->updated_at->year}} | {{$supply->updated_at->format('h:i:s A')}} | {{$supply->updated_at->format('h:i:s A')}} | <a href="{{route('karyawan.detail',$supply->updatedBy->employee->id)}}">{{$supply->updatedBy->employee->nama}}</a>
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
            delimiter:',',
            divideThousand:true
        });
    });
    </script>
@endpush
