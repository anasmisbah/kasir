@extends('layouts.master')

@push('css')
<style>
  th {
    text-align: center !important
  }
</style>
@endpush

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2 ">
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item">Beranda</li>
          <li class="breadcrumb-item">Penjualan</li>
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
          <h3 class="card-title"> <strong>Detail Penjualan</strong> </h3>
          <div class="card-tools">
            <ul class="nav nav-pills ml-auto">
              <li class="nav-item mr-2">
                <a class="nav-link btn-primary active" href="{{ route('penjualan.cetaknota',$bill->id) }}"><i class=" fas fa-print"></i></a>
              </li>
              <li class="nav-item mr-5">
                <form class="d-inline" id="form-delete" action="{{route('penjualan.hapus', $bill->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    </form>
                <a class="nav-link btn-warning active" href="" id="delete" ><i class=" fas fa-trash"></i></a>
              </li>
              <li class="nav-item">
                <a class="nav-link btn-danger active" href="{{ route('penjualan.index') }}"><i class=" fas fa-times"></i></a>
              </li>
            </ul>
          </div>
        </div>
        <div class="card-body">
          <table class="table table-striped">
            <tbody>
              <tr>
                <td style="width:15%">No Nota Kas</td>
                <td> <strong>{{$bill->no_nota_kas}}</strong> </td>
              </tr>
              <tr>
                <td style="width:15%">Tanggal</td>
                <td>{{$bill->tanggal_nota}}</td>
              </tr>
              <tr>
                <td style="width:15%">Cabang</td>
                <td><a href="{{route('cabang.detail',$bill->branch->id)}}"> <b> {{$bill->branch->nama}} </b></a></td>
              </tr>
              <tr>
                <td style="width:15%">Nama Pelanggan</td>
                <td><a href="{{route('pelanggan.detail',$bill->customer->id)}}"> <b> {{$bill->customer->nama}}</b></a></td>
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
                <td><a href="{{route('karyawan.detail',$bill->user->employee->id)}}">{{$bill->user->employee->nama}}</a></td>
              </tr>
              <tr>
                <td style="width:15%">Status</td>
                <td><b>{{ strtoupper($bill->status) }}</b></td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- /.card-body -->

        <table class="no-margin table table-stripped text-center" id="table">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Barang</th>
              <th>Harga Satuan</th>
              <th>Qty(Kg)</th>
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
              <td class="text-center">Rp <span class="harga">{{$trans->total_harga}}</span> ,-</td>
            </tr>
            @php
            $subtotal+=$trans->total_harga
            @endphp
            @endforeach

            <tr class="text-center">
              <td></td>
              <td></td>
              <td></td>
              <td>Sub Total</td>
              <td>Rp <span class="harga">{{$subtotal}}</span> ,-</td>
            </tr>
            <tr class="text-center">
              <td style="border: none"></td>
              <td style="border: none"></td>
              <td> Diskon &nbsp;&nbsp;{{$bill->diskon}}%</td>
              <td><b>TOTAL</b></td>
              <td>Rp <span class="harga">{{$bill->total_nota}}</span>  ,-</td>
            </tr>
            <tr class="text-center">
              <td style="border: none"></td>
              <td style="border: none"></td>
              <td></td>
              <td>Uang Muka</td>
              <td>Rp <span class="harga">{{$bill->jumlah_uang_nota}}</span>  ,-</td>
            </tr>
            <tr class="text-center">
              <td style="border: none"></td>
              <td style="border: none"></td>
              <td style="border: none"></td>
              <td>Piutang</td>
              <td>Rp <span class="harga">{{ $bill->kembalian_nota < 0 ?abs($bill->kembalian_nota).",-":"-"}}</span>  ,-</td>
            </tr>
          </tbody>
        </table>
        <div class="card-footer text-right">
          <span style="font-size: 12px">
            <strong>Dibuat Pada : </strong>{{  $bill->created_at->dayName." | ".$bill->created_at->day." ".$bill->created_at->monthName." ".$bill->created_at->year}} | <a href="{{route('karyawan.detail',$bill->createdBy->employee->id)}}">{{$bill->createdBy->employee->nama}}</a>
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
            delimiter:',',
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
