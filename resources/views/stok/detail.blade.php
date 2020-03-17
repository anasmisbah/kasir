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
<li class="breadcrumb-item active"><a href="#"  >Detail</a></li>
@endsection
@section('content')
<div class="col-12 ">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <div>
                    <h4 class="card-title mb-0 text-bold">Detail Stok Barang</h4>
                </div>
                <div class="btn-toolbar d-none d-md-block" role="toolbar" aria-label="Toolbar with buttons">
                    @if (auth()->user()->level_id == 2)
                    <a href="{{route('stok.ubah',$supply->id)}}" class="btn btn-primary" style="width: 78px !important;"><i class="fa fa-edit"></i></a>
                    @endif
                    <form class="d-inline" id="form-delete" action="{{route('stok.hapus', $supply->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                    </form>
                    @if (auth()->user()->level_id == 1)
                        <button type="submit" id="delete" class="btn ml-2 btn-warning" style="width: 78px !important;">
                        <i class="fa fa-trash"></i>
                        </button>
                    @endif

                    <a class="btn btn-danger ml-5"  href="javascript:void(0)" onclick="history.back();"><i class="fa fa-times"></i></a>
                </div>
            </div>
            <table class="table table-sm table-striped">
                <tbody>
                  <tr>
                    <td style="width:10%">Nama</td>
                    <td><strong><a  href="{{route('barang.detail',$supply->item->id)}}">{{$supply->item->nama}}</a></strong></td>
                  </tr>
                  <tr>
                    <td style="width:10%">Cabang</td>
                    <td> <a  href="{{route('cabang.detail',$supply->branch->id)}}">{{$supply->branch->nama}}</a></td>
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
                    <td>{{$supply->stok}} Kg</td>
                  </tr>

                </tbody>
              </table>
            </div>

            <div class="card-footer text-right" style="background:#C5C6C7">
                <span style="font-size: 12px">
                    <strong>Dibuat pada: </strong>{{  $supply->created_at->dayName." | ".$supply->created_at->day." ".$supply->created_at->monthName." ".$supply->created_at->year}} | {{$supply->created_at->format('H:i:s')}} WIB | <a href="{{route('karyawan.detail',$supply->createdBy->employee->id)}}" >{{$supply->createdBy->employee->nama}}</a> / <strong>Diubah pada: </strong>{{  $supply->updated_at->dayName." | ".$supply->updated_at->day." ".$supply->updated_at->monthName." ".$supply->updated_at->year}} | {{$supply->updated_at->format('H:i:s')}} WIB | <a href="{{route('karyawan.detail',$supply->updatedBy->employee->id)}}" >{{$supply->updatedBy->employee->nama}}</a>
                </span>
            </div>
    </div>
</div>
@endsection

@push('script')
<script src="/adminlte/plugins/number-divider.min.js"></script>
<script src="/adminlte/plugins/sweetalert.min.js"></script>
<script>
    $('#delete').click(()=>{
      swal({
      title: "apakah anda yakin menghapus stok barang {{$supply->item->nama}} ?",
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
