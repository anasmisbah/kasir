<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="shortcut icon" href="{{asset('/img/favico.png')}}" type="image/x-icon">
    <title>Piutang Cetak | {{$app->nama}}</title>
    <style>
        .border{
            border-top: 1px solid black !important;
        }
        .border-bawah{
            border-bottom: 1px solid black !important;
        }
        body{
            font-family: "Arial", Helvetica, sans-serif;
        }
        .table th{
            text-align: center;
            border-top: 1px solid black !important;
            border-bottom: 1px solid black !important;
        }
        .title{
            font-size: 14px;
            font-weight: bold;
        }
        body{
            font-size: 12px;
        }
        .sign{
            font-size: 12px;
        }
        .table th, .table td{
        padding: 0.4rem !important;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row" >
            <div class="text-center title">LAPORAN PIUTANG</div>
            <div class="text-center title">{{ strtoupper($app->toko) }} {{ strtoupper($branch->nama) }}</div>
            <div class="text-center title">TANGGAL {{$range}}</div>
            <br>
            <br>
            <table class="table">
                <thead>
                    <tr>
                        <th >No.</th>
                        <th >No Nota Bon</th>
                        <th>Tanggal</th>
                        <th >Nama Pelanggan</th>
                        <th width="30%">Alamat</th>
                        <th width="2%"></th>
                        <th width="10%">Hutang</th>
                        <th >Cabang</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total = 0;
                    @endphp
                    @foreach ($bills as $bill)
                        @if ($loop->iteration == count($bills))
                        <tr>
                            <td class="border-bawah text-center">{{$loop->iteration}}</td>
                            <td class="border-bawah text-center">{{$bill->no_nota_kas}}</td>
                            <td class="border-bawah text-center"> {{$bill->tanggal_nota->day.' '.$bill->tanggal_nota->monthName.' '.$bill->tanggal_nota->year}}</td>
                            <td class="border-bawah">{{$bill->customer->nama}}</td>
                            <td class="border-bawah">{{$bill->customer->alamat}}</td>
                            <td class="border-bawah text-right">Rp</td>
                            <td class="border-bawah text-right"><span class="harga">{{  abs($bill->kembalian_nota)}}</span>,-</td>
                            <td class="border-bawah text-center">{{$bill->branch->nama}}</td>
                        </tr>
                        @else
                        <tr>
                            <td class="text-center">{{$loop->iteration}}</td>
                            <td class="text-center">{{$bill->no_nota_kas}}</td>
                            <td class="text-center"> {{$bill->tanggal_nota->day.' '.$bill->tanggal_nota->monthName.' '.$bill->tanggal_nota->year}}</td>
                            <td>{{$bill->customer->nama}}</td>
                            <td>{{$bill->customer->alamat}}</td>
                            <td class=" text-right">Rp</td>
                            <td class="text-right"><span class="harga">{{  abs($bill->kembalian_nota)}}</span>,-</td>
                            <td class="text-center">{{$bill->branch->nama}}</td>
                        </tr>
                        @endif
                        @php
                            $total += abs($bill->kembalian_nota)
                        @endphp
                    @endforeach
                    <tr class="border-bawah">
                        <td class="text-center" colspan="5"><strong>JUMLAH</strong></td>
                        <td class="text-right"> <strong>Rp</strong></td>
                        <td class="text-right"> <strong><span class="harga">{{$total}}</span>,-</strong></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row" style="margin-top:10px">
            <div class="col">
                <p class="pull-right sign">
                    {{$app->kota}}, {{$dateNow->day.' '.$dateNow->monthName.' '.$dateNow->year}} <br>
                    {{$user->employee->jabatan}}, <br><br><br><br>
                    <strong>{{$branch->pimpinan}}</strong>
                </p>
            </div>
        </div>
    </div>
        <!-- jQuery -->
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
