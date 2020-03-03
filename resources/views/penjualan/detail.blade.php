@extends('layouts.master')

@push('css')
<style>
  th {
    text-align: center !important
  }
    .btn-warning{
        color: white;
    }
    .btn-warning:hover{
        color: white;
    }
    .table thead th{
        border-top: 1px solid black;
        border-bottom: 1px solid black;
    }
    .border-bawah{
        border-bottom: 1px solid black !important;
    }
    .border-atas{
        border-top: 1px solid black !important;
    }
    </style>
@endpush
@section('breadcumb')
<li class="breadcrumb-item">Beranda</li>
<li class="breadcrumb-item">Penjualan</li>
<li class="breadcrumb-item active"><a href="#"  class="text-info">Detail</a></li>
@endsection

@section('content')
<div class="container-fluid">
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <div>
                <h4 class="card-title mb-0 text-bold">Detail Penjualan</h4>
                </div>
                <div class="btn-toolbar d-none d-md-block" role="toolbar" aria-label="Toolbar with buttons">
                    @if ($bill->status == 'lunas' || $bill->status == 'piutang')
                    <a target="_blank" class="btn btn-info mr-2" style="width: 78px !important;" href="{{ route('penjualan.cetaknota',$bill->id) }}"><i class=" fa fa-print"></i></a>
                    @else
                    <a target="_blank" class="btn btn-info mr-2" style="width: 78px !important;" href="{{ route('piutang.cetaknota',$bill->id) }}"><i class=" fa fa-print"></i></a>
                    @endif
                    <form class="d-inline" id="form-delete" action="{{route('penjualan.hapus', $bill->id)}}" method="POST" style="display:none">
                        @csrf
                        @method('DELETE')
                        </form>
                    <a class="btn btn-warning mr-5" style="width: 78px !important;" href="" id="delete" ><i class=" fa fa-trash"></i></a>
                <a class="btn btn-danger"  href="javascript:void(0)" onclick="history.back();"><i class="fa fa-times"></i></a>
                </div>
            </div>
          <table class="table table-striped">
            <tbody>
              <tr>
                <td style="width:15%">No Nota Kas</td>
                <td> <strong>{{$bill->no_nota_kas}}</strong> </td>
              </tr>
              <tr>
                <td style="width:15%">Tanggal</td>
                <td>{{ $bill->tanggal_nota->day." ".$bill->tanggal_nota->monthName." ".$bill->tanggal_nota->year." ".$bill->tanggal_nota->format('h:i:s')}} WIB</td>
              </tr>
              <tr>
                <td style="width:15%">Cabang</td>
                <td><a class="text-info" href="{{route('cabang.detail',$bill->branch->id)}}"> <b> {{$bill->branch->nama}} </b></a></td>
              </tr>
              <tr>
                <td style="width:15%">Nama Pelanggan</td>
                <td><a class="text-info" href="{{route('pelanggan.detail',$bill->customer->id)}}"> <b> {{$bill->customer->nama}}</b></a></td>
              </tr>
              <tr>
                <td style="width:15%">Alamat</td>
                <td>{{$bill->customer->alamat}}</td>
              </tr>
              <tr>
                <td style="width:15%">Telepon</td>
                <td>{{$bill->customer->telepon}}</td>
              </tr>
              <tr>
                <td style="width:15%">Kasir</td>
                <td><a class="text-info" href="{{route('karyawan.detail',$bill->user->employee->id)}}">{{$bill->user->employee->nama}}</a></td>
              </tr>
              <tr>
                <td style="width:15%">Status</td>
                <td><b>{{ strtoupper($bill->status) }}</b></td>
              </tr>
            </tbody>
          </table>
          @if ($bill->status == 'lunas' || $bill->status == 'piutang')
            <table class=" table table-stripped text-center" id="table">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Harga Satuan (Kg)</th>
                    <th>Qty(Kg)</th>
                    <th></th>
                    <th>Jumlah</th>
                </tr>
                </thead>
                <tbody>
                @php
                $subtotal = 0;
                @endphp
                @foreach ($bill->transaction as $trans)
                <tr>
                    <td class="text-center">{{$loop->iteration}}</td>
                    <td width="50%">{{$trans->supply->item->nama}}</td>
                    <td class="text-center">Rp <span class="harga">{{$trans->supply->harga_cabang}}</span>,-</td>
                    <td class="text-center" width="10%">{{$trans->kuantitas}}</td>
                    <td class="text-right">Rp</td>
                    <td class="text-right"><span class="harga">{{$trans->total_harga}}</span> ,-</td>
                </tr>
                @php
                $subtotal+=$trans->total_harga
                @endphp
                @endforeach

                <tr class="text-center">
                    <td class="border-atas"></td>
                    <td class="border-atas"></td>
                    <td class="border-atas"></td>
                    <td class="border-atas">Sub Total</td>
                    <td class="text-right border-atas">Rp</td>
                    <td class="border-atas text-right"><span class="harga">{{$subtotal}}</span>,-</td>
                </tr>
                <tr class="text-center">
                    <td style="border: none"></td>
                    <td style="border: none"></td>
                    <td class="border-atas"> Diskon &nbsp;&nbsp;{{$bill->diskon}}%</td>
                    <td class="border-atas"><b>TOTAL</b></td>
                    <td class="text-right border-atas"> <b> Rp</b></td>
                    <td class="border-atas text-right"><b><span class="harga">{{$bill->total_nota}}</span>,-</b></td>
                </tr>
                <tr class="text-center">
                    <td style="border: none"></td>
                    <td style="border: none"></td>
                    <td class="border-atas"></td>
                    <td class="border-atas">Uang Muka</td>
                    <td class="text-right border-atas">Rp</td>
                    <td class="border-atas text-right"><span class="harga">{{$bill->jumlah_uang_nota}}</span>  ,-</td>
                </tr>
                <tr class="text-center">
                    <td style="border: none"></td>
                    <td style="border: none"></td>
                    <td style="border: none"></td>
                    <td class="border-atas border-bawah">Piutang</td>
                    <td class="text-right border-atas border-bawah">Rp</td>
                    @if ($bill->kembalian_nota < 0)
                    <td class="border-atas border-bawah text-right"><span class="harga">{{ abs($bill->kembalian_nota)}}</span>,-</td>
                    @else
                    <td class="border-atas border-bawah text-right">0,-</span></td>
                    @endif
                </tr>
                </tbody>
            </table>
          @else
          <table class="no-margin table table-stripped text-center" id="table">
            <thead>
              <tr>
                <th class="text-center">No Nota Kas</th>
                <th>Tanggal nota Kas</th>
                <th>Sub Total Nota Kas</th>
                <th>Diskon Nota Kas</th>
                <th></th>
                <th>Total Nota Kas</th>
              </tr>
            </thead>
            <tbody>
              @php
              $subtotal = 0;
              @endphp
              <tr>
                <td class="text-center">{{$bill->no_nota_kas}}</td>
                <td width="40%" class="text-center">{{$bill->tanggal_nota->day." ".$bill->tanggal_nota->monthName." ".$bill->tanggal_nota->year}}</td>
                <td class="text-center">Rp <span class="harga">{{$bill->total_nota}}</span>,-</td>
                <td class="text-center" width="15%">Rp 0,-</td>
                <td class="border-atas  text-right">Rp</td>
                <td class="text-right"> <b><span class="harga">{{$bill->total_nota}}</span>,-</b></td>
              </tr>
              <tr class="text-center">
                <td class="border-atas"></td>
                <td class="border-atas"></td>
                <td class="border-atas"></td>
                <td class="border-atas">Uang Muka</td>
                <td class="border-atas  text-right">Rp</td>
                <td class="border-atas text-right"><span class="harga">{{$bill->jumlah_uang_nota}}</span>,-</td>
              </tr>
              <tr class="text-center">
                <td style="border: none"></td>
                <td style="border: none"></td>
                <td style="border: none"></td>
                <td class="border-atas"><strong>Piutang</strong></td>
                <td class="border-atas  text-right"> <b>Rp</b></td>
                <td class="border-atas text-right"> <strong><span class="harga">{{ abs($bill->kembalian_nota)}}</span> ,-</strong></td>
              </tr>
              <tr class="text-center">
                <td style="border: none"></td>
                <td style="border: none"></td>
                <td style="border: none"></td>
                <td class="border-atas border-bawah">Pembayaran</td>
                <td class="border-atas border-bawah text-right">Rp</td>
                <td class="border-atas border-bawah text-right"><span class="harga">{{abs($bill->kembalian_nota)}}</span>  ,-</td>
              </tr>
            </tbody>
          </table>
          @endif
        </div>

        <!-- /.card-body -->

        <div class="card-footer text-right">
          <span style="font-size: 12px">
            <strong>Dibuat Pada : </strong>{{  $bill->created_at->dayName." | ".$bill->created_at->day." ".$bill->created_at->monthName." ".$bill->created_at->year}}  | {{$bill->created_at->format('h:i:s')}} WIB | <a class="text-info" href="{{route('karyawan.detail',$bill->createdBy->employee->id)}}">{{$bill->createdBy->employee->nama}}</a>
          </span>
        </div>
      </div>
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
    $('#delete').click((e)=>{
    e.preventDefault()
      swal({
      title: "apakah anda yakin menghapus penjualan?",
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
