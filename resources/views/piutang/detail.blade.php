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
    <div class="row">
      <div class="col-6">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item">Beranda</li>
          <li class="breadcrumb-item">Piutang</li>
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
          <h3 class="card-title"> <strong>Detail Piutang</strong> </h3>
          <div class="card-tools">
            <ul class="nav nav-pills ml-auto">
              <li class="nav-item mr-2">
                <a class="nav-link btn-secondary active" id="piutang" href="{{ route('piutang.lunas',$bill->id) }}"><i class=" fas fa-check"></i></a>
              </li>
              <li class="nav-item mr-2">
                <a class="nav-link btn-danger active" href="{{ route('piutang.index') }}"><i class=" fas fa-times"></i></a>
              </li>
            </ul>
          </div>
        </div>
        <div class="card-body">
          <table class="table table-striped">
            <tbody>
              <tr>
                <td style="width:15%">No Nota Bon</td>
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
              <th>No Nota Kas</th>
              <th>Tanggal nota Kas</th>
              <th>Sub Total Nota Kas</th>
              <th>Diskon</th>
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
              <td width="50%" class="text-center">{{$bill->tanggal_nota->format('d F Y')}}</td>
              <td class="text-center">Rp <span class="harga">{{$subtotal}}</span>,-</td>
              <td class="text-center" width="10%">Rp <span class="harga">{{$subtotal-$bill->total_nota}}</span>,-</td>
              <td class="text-center">Rp <span class="harga">{{$bill->total_nota}}</span>,-</td>
            </tr>
            <tr class="text-center">
              <td></td>
              <td></td>
              <td></td>
              <td>Uang Muka</td>
              <td>Rp <span class="harga">{{$bill->jumlah_uang_nota}}</span>,-</td>
            </tr>
            <tr class="text-center">
              <td style="border: none"></td>
              <td style="border: none"></td>
              <td style="border: none"></td>
              <td><strong>Piutang</strong></td>
              <td> <strong>Rp <span class="harga">{{ abs($bill->kembalian_nota)}}</span> ,-</strong></td>
            </tr>
            <tr class="text-center">
              <td style="border: none"></td>
              <td style="border: none"></td>
              <td style="border: none"></td>
              <td>Pembayaran</td>
              <td>Rp <span class="harga">{{abs($bill->kembalian_nota)}}</span>  ,-</td>
            </tr>
          </tbody>
        </table>
        <div class="card-footer text-right">
          <span style="font-size: 12px">
            <strong>Dibuat Pada : </strong>{{ $bill->created_at->dayName." | ".$bill->created_at->day." ".$bill->created_at->monthName." ".$bill->created_at->year}} | <a href="{{route('karyawan.detail',$bill->createdBy->employee->id)}}">{{$bill->createdBy->employee->nama}}</a>
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
<script>
  $('#piutang').click((e) => {
    e.preventDefault()
    const url = $('#piutang').attr('href')
    console.log(url);

      swal({
      title: "apakah anda yakin melakukan pelunasan?",
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
