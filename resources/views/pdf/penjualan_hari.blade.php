<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <title>Laporan Penjualan</title>
<style>
        .border{
            border-top: 2px solid black !important;
        }
        .border-bawah{
            border-bottom: 2px solid black !important;
        }
</style>
</head>
<body>
    <div class="container">
        <div class="row" >
            <h4 class="text-center">LAPORAN PENJUALAN</h4>
            <h4 class="text-center">{{ strtoupper($app->toko) }} {{ strtoupper($branch->nama) }}</h4>
            <h4 class="text-center">TANGGAL {{$dateNow}}</h4>
            <br>
            <br>
            <table class="table table-hover">
                    <tr>
                            <th  class="border">No.</th>
                            <th  class="border">No. Nota</th>
                            <th  class="border">Pelanggan</th>
                            <th  class="border">Total</th>
                            <th  class="border">Piutang</th>
                            <th  class="border">Status</th>
                            <th  class="border">Cabang</th>
                    </tr>
                <tbody>
                    @php
                        $total = 0;
                        $totalkas = 0;
                        $totalpiutang =0;
                    @endphp
                    @foreach ($bills as $bill)
                        @if ($loop->iteration == 1)
                        <tr>
                            <td  class="border">{{$loop->iteration}}</td>
                            <td  class="border">{{$bill->no_nota_kas}}</td>
                            <td  class="border">{{$bill->customer->nama}}</td>
                            <td  class="border">Rp.{{$bill->total_nota}},-</td>
                            <td  class="border">Rp.{{  $bill->kembalian_nota < 0 ?abs($bill->kembalian_nota).",-":"-"}}</td>
                            <td  class="border">{{  strtoupper($bill->status)}}</td>
                            <td  class="border">{{$bill->branch->nama}}</td>
                        </tr>
                        @elseif ($loop->iteration == count($bills))
                        <tr>
                            <td  class="border-bawah">{{$loop->iteration}}</td>
                            <td  class="border-bawah">{{$bill->no_nota_kas}}</td>
                            <td  class="border-bawah">{{$bill->customer->nama}}</td>
                            <td  class="border-bawah">Rp.{{$bill->total_nota}},-</td>
                            <td  class="border-bawah">Rp.{{  $bill->kembalian_nota < 0 ?abs($bill->kembalian_nota).",-":"-"}}</td>
                            <td  class="border-bawah">{{  strtoupper($bill->status)}}</td>
                            <td  class="border-bawah">{{$bill->branch->nama}}</td>
                        </tr>
                        @else
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$bill->no_nota_kas}}</td>
                            <td>{{$bill->customer->nama}}</td>
                            <td>Rp.{{$bill->total_nota}},-</td>
                            <td>Rp.{{  $bill->kembalian_nota < 0 ?abs($bill->kembalian_nota).",-":"-"}}</td>
                            <td>{{  strtoupper($bill->status)}}</td>
                            <td>{{$bill->branch->nama}}</td>
                        </tr>
                        @endif
                        @php
                            $temppiutang = $bill->kembalian_nota < 0 ?abs($bill->kembalian_nota):0;
                            $totalpiutang+=$temppiutang;
                            $total+=$bill->total_nota
                        @endphp
                    @endforeach

                    <tr >
                        <td class="border-bawah"></td>
                        <td class="border-bawah"></td>
                        <td class="border-bawah">JUMLAH</td>
                        <td class="border-bawah">Rp {{$total}},-</td>
                        <td class="border-bawah">Rp {{$totalpiutang}},-</td>
                        <td class="border-bawah"></td>
                        <td class="border-bawah"></td>
                    </tr>
                    <tr>
                        <td class="border-bawah"></td>
                        <td class="border-bawah"></td>
                        <td class="border-bawah">JUMLAH KAS</td>
                        <td class="border-bawah">Rp {{$total-$totalpiutang}},-</td>
                        <td class="border-bawah"></td>
                        <td class="border-bawah"></td>
                        <td class="border-bawah"></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row" style="margin-top:20px">
            <div class="col">
                <p class="pull-right">
                    {{$branch->nama}},{{$dateNow}} <br>
                    Manager Cabang, <br><br><br><br>
                    <strong>{{$branch->pimpinan}}</strong>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
