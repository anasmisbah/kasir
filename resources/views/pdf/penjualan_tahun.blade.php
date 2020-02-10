<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/adminlte/plugins/bootstrap3.min.css">
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
        <div class="row mt-4" >
            <h4 class="text-center">LAPORAN PENJUALAN</h4>
            <h4 class="text-center">{{ strtoupper($app->toko) }} {{ strtoupper($branch->nama) }}</h4>
            <h4 class="text-center">Tahun {{$year->year}}</h4>
            <br>
            <br>

            <table class="table table-striped text-center">
                    <tr class="border">
                      <th>No.</th>
                      <th>Bulan</th>
                      <th>Penjualan</th>
                      <th>Nominal</th>
                      <th>Piutang</th>
                      <th>Nominal</th>
                      <th>Kas</th>
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
                    <tr class="{{$loop->iteration == 1?'border':''}} {{$loop->iteration == count($data)?'border-bawah':''}}">
                      <td>{{$loop->iteration}}</td>
                      <td>{{$item['tanggal']}}</td>
                      <td>{{$item['penjualan']}}</td>
                      <td>Rp {{$item['nominal_penjualan']}},-</td>
                      <td>{{$item['piutang']}}</td>
                      <td>Rp {{ abs($item['nominal_piutang'])}},-</td>
                      <td>Rp {{$item['kas']}},-</td>
                    </tr>
                    @php
                          $totalpenjualan +=$item['penjualan'] ;
                          $totalnominalpenjualan += $item['nominal_penjualan'];
                          $totalpiutang +=$item['piutang'] ;
                          $totalnominalpiutang +=$item['nominal_piutang'];
                          $totalkas += $item['kas'];
                      @endphp
                    @endforeach
                  </tbody>

                  <tfoot>
                      <tr class="border-bawah">
                          <th ></th>
                          <th>JUMLAH</th>
                          <th>{{$totalpenjualan}}</th>
                          <th>Rp {{$totalnominalpenjualan}},-</th>
                          <th>{{$totalpiutang}}</th>
                          <th>Rp {{abs($totalnominalpiutang)}},-</th>
                          <th>Rp {{$totalkas}},-</th>
                        </tr>
                  </tfoot>
            </table>
        </div>
        <div class="row" style="margin-top:20px">
            <div class="col">
                <p class="pull-right">
                    {{$branch->nama}},{{$dateNow}} <br>
                    Manager Cabang, <br><br><br><br>
                    {{$branch->pimpinan}}
                </p>
            </div>
        </div>
    </div>
</body>
      <!-- jQuery -->
      <script src="/adminlte/plugins/jquery/jquery.min.js"></script>
      <!-- AdminLTE App -->
      <script src="/adminlte/dist/js/adminlte.min.js"></script>
      <script>
        window.addEventListener("afterprint", function(){
          history.back();
        });
        $("#body_print").ready(function(){
          window.print();
        });
      </script>
</html>
