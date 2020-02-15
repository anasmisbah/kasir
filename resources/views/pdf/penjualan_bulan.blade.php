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
        th{
            text-align: center !important
        }

</style>
</head>
<body>
    <div class="container">
        <div class="row" >
            <h4 class="text-center">LAPORAN PENJUALAN</h4>
            <h4 class="text-center">{{ strtoupper($app->toko) }} {{ strtoupper($branch->nama) }}</h4>
            <h4 class="text-center">Bulan {{$month->monthName}}</h4>
            <br>
            <br>

            <table class="table table-hover text-center">
                    <tr>
                      <th  class="border">No.</th>
                      <th  class="border">Tanggal</th>
                      <th  class="border">Penjualan</th>
                      <th  class="border">Nominal</th>
                      <th  class="border">Piutang</th>
                      <th  class="border">Nominal</th>
                      <th  class="border">Kas</th>
                    </tr>
                  <tbody>
                      @php
                          $totalpenjualan = 0;
                          $totalnominalpenjualan = 0;
                          $totalpiutang = 0;
                          $totalnominalpiutang =0;
                          $totalkas = 0;
                      @endphp
                    @foreach ($data as $item)
                    @if ($loop->iteration == 1)
                    <tr>
                        <td class="border">{{$loop->iteration}}</td>
                        <td class="border">{{$item['tanggal']}}</td>
                        <td class="border">{{$item['penjualan']}}</td>
                        <td class="border">Rp {{$item['nominal_penjualan']}},-</td>
                        <td class="border">{{$item['piutang']}}</td>
                        <td class="border">Rp {{ abs($item['nominal_piutang'])}},-</td>
                        <td class="border">Rp {{$item['kas']}},-</td>
                      </tr>
                        @elseif ($loop->iteration == count($data))
                        <tr>
                            <td class="border-bawah">{{$loop->iteration}}</td>
                            <td class="border-bawah">{{$item['tanggal']}}</td>
                            <td class="border-bawah">{{$item['penjualan']}}</td>
                            <td class="border-bawah">Rp {{$item['nominal_penjualan']}},-</td>
                            <td class="border-bawah">{{$item['piutang']}}</td>
                            <td class="border-bawah">Rp {{ abs($item['nominal_piutang'])}},-</td>
                            <td class="border-bawah">Rp {{$item['kas']}},-</td>
                          </tr>
                        @else
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item['tanggal']}}</td>
                            <td>{{$item['penjualan']}}</td>
                            <td>Rp {{$item['nominal_penjualan']}},-</td>
                            <td>{{$item['piutang']}}</td>
                            <td>Rp {{ abs($item['nominal_piutang'])}},-</td>
                            <td>Rp {{$item['kas']}},-</td>
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
                  </tbody>
                      <tr>
                          <th class="border border-bawah"></th>
                          <th class="border border-bawah">JUMLAH</th>
                          <th class="border border-bawah">{{$totalpenjualan}}</th>
                          <th class="border border-bawah">Rp {{$totalnominalpenjualan}},-</th>
                          <th class="border border-bawah">{{$totalpiutang}}</th>
                          <th class="border border-bawah">Rp {{abs($totalnominalpiutang)}},-</th>
                          <th class="border border-bawah">Rp {{$totalkas}},-</th>
                        </tr>
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
