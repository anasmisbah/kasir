@extends('layouts.master')

@push('css')
<style>
  th {
    text-align: center !important
  }
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
<li class="breadcrumb-item">Piutang</li>
<li class="breadcrumb-item active"><a href="#"  >Detail</a></li>
@endsection

@section('content')
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <div>
                    <h4 class="card-title mb-0 text-bold">Detail Piutang</h4>
                </div>
                <div class="btn-toolbar d-none d-md-block" role="toolbar" aria-label="Toolbar with buttons">
                    <a class="btn btn-primary mr-2" style="width: 78px !important;" target="_blank"  href="{{ route('penjualan.cetaknota',$bill->id) }}"><i class="fa fa-print"></i></a>
                    <a class="btn btn-success mr-5" style="width: 78px !important;" id="piutang" href="{{ route('piutang.lunas',$bill->id) }}"><i class="fa fa-check"></i></a>
                    <a class="btn btn-danger"  href="javascript:void(0)" onclick="history.back();"><i class="fa fa-times"></i></a>
                </div>
            </div>
          <table class="table table-sm table-striped">
            <tbody>
              <tr>
                <td style="width:15%">Nota Bon</td>
                <td><strong>{{$bill->no_nota_kas}}</strong></td>
              </tr>
              <tr>
                <td>Tanggal</td>
                <td>{{ $bill->tanggal_nota->day." ".$bill->tanggal_nota->monthName." ".$bill->tanggal_nota->year." | ".$bill->tanggal_nota->format('H:i:s')}} WIB</td>
              </tr>
              <tr>
                <td>Cabang</td>
                <td><a  href="{{route('cabang.detail',$bill->branch->id)}}"> {{$bill->branch->nama}}</a></td>
              </tr>
              <tr>
                <td>Nama Pelanggan</td>
                <td><strong><a  href="{{route('pelanggan.detail',$bill->customer->id)}}"> {{$bill->customer->nama}}</a></strong></td>
              </tr>
              <tr>
                <td>Alamat</td>
                <td>{{$bill->customer->alamat}}</td>
              </tr>
              <tr>
                <td>Telepon</td>
                <td>{{$bill->customer->telepon}}</td>
              </tr>
              <tr>
                <td>Kasir</td>
                <td><a  href="{{route('karyawan.detail',$bill->user->employee->id)}}">{{$bill->user->employee->nama}}</a></td>
              </tr>
              <tr>
                <td>Status</td>
                <td><b>{{ strtoupper($bill->status) }}</b></td>
              </tr>
            </tbody>
          </table>
          <table class="no-margin table table-sm table-stripped text-center" id="table">
            <thead>
              <tr>
                <th>Nota Kas</th>
                <th>Tanggal Nota Kas</th>
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
              @foreach ($bill->transaction as $trans)
              @php
              $subtotal+=$trans->total_harga
              @endphp
              @endforeach
              <tr>
                <td class="text-center">{{$bill->no_nota_kas}}</td>
                <td width="40%" class="text-center">{{$bill->tanggal_nota->format('d F Y')}}</td>
                <td class="text-center">Rp <span class="harga">{{$subtotal}}</span>,-</td>
                <td class="text-center" width="15%">Rp <span class="harga">{{$subtotal-$bill->total_nota}}</span>,-</td>
                <td class="border-atas  text-right"> Rp</td>
                <td class="text-right"><span class="harga">{{$bill->total_nota}}</span>,-</td>
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
                <td class="border-atas"><strong>Utang</strong></td>
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
        </div>

        <!-- /.card-body -->

        <div class="card-footer text-right">
          <span style="font-size: 12px">
            <strong>Dibuat pada: </strong>{{ $bill->created_at->dayName." | ".$bill->created_at->day." ".$bill->created_at->monthName." ".$bill->created_at->year}} | {{$bill->created_at->format('H:i:s')}} WIB | <a  href="{{route('karyawan.detail',$bill->createdBy->employee->id)}}">{{$bill->createdBy->employee->nama}}</a>
          </span>
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
  $('#piutang').click((e) => {
    e.preventDefault()
    const url = $('#piutang').attr('href')
    console.log(url);

      swal({
      title: "Apakah Anda yakin ingin melakukan pelunasan?",
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
        window.open(url,"_self")
      }
    });
    })
</script>
@endpush
