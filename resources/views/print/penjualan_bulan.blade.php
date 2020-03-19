<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="shortcut icon" href="{{asset('/img/favico.png')}}" type="image/x-icon">
    <title>Cetak | {{$app->nama}}</title>
<style>
        .border{
            border-top: 1px solid black !important;
        }
        .border-bawah{
            border-bottom: 1px solid black !important;
        }
        th{
            text-align: center !important
        }
        .table th{
            border-top: 1px solid black !important;
            border-bottom: 1px solid black !important;
        }
        body{
            font-family: "Arial", Helvetica, sans-serif;
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
        .foot{
            font-weight: bold;
        }
        .table th, .table td{
        padding: 0.6rem !important;
        }
</style>
</head>
<body>
    <div class="container">
        <div class="row" style="padding-top:10px">
            <div class="text-center title">LAPORAN PENJUALAN</div>
            <div class="text-center title">
                {{ strtoupper($app->toko) }}
                @if ($filter_cabang != '0')
                    {{ strtoupper($branch->nama) }}
                @endif
            </div>
            <div class="text-center title">BULAN {{strtoupper($month->monthName)}} {{$month->year}}</div>
            <br>
            <br>

            <table class="table text-center">
                <thead>
                    <tr>
                      <th>No.</th>
                      <th>Tanggal</th>
                      <th>Penjualan</th>
                      <th></th>
                      <th>Nominal</th>
                      <th>Piutang</th>
                      <th></th>
                      <th>Nominal</th>
                      <th></th>
                      <th>Kas</th>
                    </tr>
                </thead>
                  <tbody>
                      @php
                          $totalpenjualan = 0;
                          $totalnominalpenjualan = 0;
                          $totalpiutang = 0;
                          $totalnominalpiutang =0;
                          $totalkas = 0;
                      @endphp
                    @foreach ($data as $item)
                        @if ($loop->iteration == count($data))
                        <tr>
                            <td class="border-bawah">{{$loop->iteration}}</td>
                            <td class="border-bawah">{{$item['tanggal']}}</td>
                            <td class="border-bawah">{{$item['penjualan']}}</td>
                            <td class="border-bawa text-right">Rp</td>
                            <td class="border-bawah text-right"><span class="harga">{{$item['nominal_penjualan']}}</span>,-</td>
                            <td class="border-bawah">{{$item['piutang']}}</td>
                            <td class="border-bawah text-right">Rp</td>
                            <td class="border-bawah text-right"><span class="harga">{{ abs($item['nominal_piutang'])}}</span>,-</td>
                            <td class="border-bawah text-right">Rp</td>
                            <td class="border-bawah text-right"> <span class="harga">{{$item['kas']}}</span>,-</td>
                          </tr>
                        @else
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item['tanggal']}}</td>
                            <td>{{$item['penjualan']}}</td>
                            <td class="text-right">Rp</td>
                            <td class="text-right"><span class="harga">{{$item['nominal_penjualan']}}</span>,-</td>
                            <td>{{$item['piutang']}}</td>
                            <td class="text-right">Rp</td>
                            <td class="text-right"> <span class="harga">{{ abs($item['nominal_piutang'])}}</span>,-</td>
                            <td class="text-right">Rp</td>
                            <td class="text-right"><span class="harga">{{$item['kas']}}</span>,-</td>
                          </tr>
                        @endif
                    @php
                          $totalpenjualan +=$item['penjualan'] ;
                          $totalnominalpenjualan += $item['nominal_penjualan'];
                          $totalpiutang +=$item['piutang'] ;
                          $totalnominalpiutang +=$item['nominal_piutang'];
                          $totalkas += $item['kas'];
                      @endphp
                    @endforeach
                    <tr class="foot">
                        <td class="border border-bawah"></td>
                        <td class="border border-bawah">JUMLAH</td>
                        <td class="border border-bawah">{{$totalpenjualan}}</td>
                        <td class="border border-bawah text-right">Rp</td>
                        <td class="border border-bawah text-right"><span class="harga">{{$totalnominalpenjualan}}</span>,-</td>
                        <td class="border border-bawah">{{$totalpiutang}}</td>
                        <td class="border border-bawah text-right">Rp</td>
                        <td class="border border-bawah text-right"><span class="harga">{{abs($totalnominalpiutang)}}</span>,-</td>
                        <td class="border border-bawah text-right">Rp</td>
                        <td class="border border-bawah text-right"><span class="harga">{{$totalkas}}</span>,-</td>
                      </tr>
                  </tbody>
            </table>
        </div>
        <div class="row sign" style="margin-top:10px">
            <div class="col">
                <p class="pull-right">
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
