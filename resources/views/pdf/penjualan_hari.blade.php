<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="shortcut icon" href="{{asset('/uploads/'.$app->logo)}}" type="image/x-icon">
    <title>Laporan Penjualan</title>
<style>
        .border{
            border-top: 2px solid black !important;
        }
        .border-bawah{
            border-bottom: 2px solid black !important;
        }
        .table th{
            border-top: 2px solid black !important;
            border-bottom: 2px solid black !important;
        }
        body{
            font-family: "Arial", Helvetica, sans-serif;
        }
        .title{
            font-size: 14px;
            font-weight: bold;
        }
        .table{
            font-size: 12px;
        }
        .sign{
            font-size: 12px;
        }
        .table th,.table td{
            padding-top: 0.3rem !important;
            padding-bottom: 0.3rem !important;
        }
</style>
</head>
<body id="body_print">
    <div class="container">
        <div class="row" style="margin-top:10px">
            <div class="text-center title">LAPORAN PENJUALAN</div>
            <div class="text-center title">{{ strtoupper($app->toko) }} {{ strtoupper($branch->nama) }}</div>
            <div class="text-center title">TANGGAL {{$range}}</div>
            <br>
            <br>
            <table class="table table-hover">
                    <tr>
                        <th>No.</th>
                        <th>No. Nota</th>
                        <th>Tanggal</th>
                        <th>Pelanggan</th>
                        <th></th>
                        <th>Total</th>
                        <th></th>
                        <th>Piutang</th>
                        <th>Status</th>
                        <th>Cabang</th>
                    </tr>
                <tbody>
                    @php
                        $total = 0;
                        $totalkas = 0;
                        $totalpiutang =0;
                    @endphp
                    @foreach ($bills as $bill)
                        @if ($loop->iteration == count($bills))
                        <tr>
                            <td  class="border-bawah">{{$loop->iteration}}</td>
                            <td  class="border-bawah">{{$bill->no_nota_kas}}</td>
                            <td class="border-bawah"> {{$bill->tanggal_nota->day.' '.$bill->tanggal_nota->monthName.' '.$bill->tanggal_nota->year}}</td>
                            <td  class="border-bawah">{{$bill->customer->nama}}</td>
                            <td  class="border-bawah">Rp</td>
                            <td  class="border-bawah text-right"> <span class="harga">{{$bill->total_nota}}</span>,-</td>
                            <td  class="border-bawah">Rp</td>
                            @if ($bill->kembalian_nota < 0)
                            <td  class="border-bawah text-right"> <span class="harga">{{ abs($bill->kembalian_nota)}}</span></td>
                            @else
                                <td class="border-bawah text-right">0,-</td>
                            @endif
                            <td  class="border-bawah">{{  strtoupper($bill->status)}}</td>
                            <td  class="border-bawah">{{$bill->branch->nama}}</td>
                        </tr>
                        @else
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$bill->no_nota_kas}}</td>
                            <td> {{$bill->tanggal_nota->day.' '.$bill->tanggal_nota->monthName.' '.$bill->tanggal_nota->year}}</td>
                            <td>{{$bill->customer->nama}}</td>
                            <td  >Rp</td>
                            <td class="text-right"><span class="harga">{{$bill->total_nota}}</span>,-</td>
                            <td  >Rp</td>
                            @if ($bill->kembalian_nota < 0)
                                <td class="text-right"><span class="harga">{{   abs($bill->kembalian_nota)}}</span>,-</td>

                            @else
                                <td class="text-right">0,-</td>
                            @endif
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
                        <td class="border-bawah"></td>
                        <td class="border-bawah">JUMLAH</td>
                        <td  class="border-bawah">Rp</td>
                        <td class="border-bawah text-right"><span class="harga">{{$total}}</span>,-</td>
                        <td  class="border-bawah">Rp</td>
                        <td class="border-bawah text-right"><span class="harga">{{$totalpiutang}}</span>,-</td>
                        <td class="border-bawah"></td>
                        <td class="border-bawah"></td>
                    </tr>
                    <tr>
                        <td class="border-bawah"></td>
                        <td class="border-bawah"></td>
                        <td class="border-bawah"></td>
                        <td class="border-bawah">JUMLAH KAS</td>
                        <td  class="border-bawah">Rp</td>
                        <td class="border-bawah text-right"><span class="harga">{{$total-$totalpiutang}}</span> ,-</td>
                        <td class="border-bawah"></td>
                        <td class="border-bawah"></td>
                        <td class="border-bawah"></td>
                        <td class="border-bawah"></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row" style="margin-top:20px">
            <div class="col">
                <p class="pull-right sign">
                    {{$app->kota}}, {{$dateNow->day.' '.$dateNow->monthName.' '.$dateNow->year}} <br>
                    {{$user->employee->jabatan}}, <br><br><br><br>
                    <strong>{{$user->employee->nama}}</strong>
                </p>
            </div>
        </div>
    </div>
    <script src="/adminlte/plugins/jquery/jquery.min.js"></script>
<!-- AdminLTE App -->
<script src="/adminlte/dist/js/adminlte.min.js"></script>
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
    window.addEventListener("afterprint", function() {
        history.back();
    });
    $("#body_print").ready(function() {
        window.print();
    });
</script>
</body>
</html>
