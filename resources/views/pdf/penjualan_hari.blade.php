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

            <table class="table table-striped">
                    <tr class="border">
                            <th>No.</th>
                            <th>No. Nota</th>
                            <th>Pelanggan</th>
                            <th>Total</th>
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
                        <tr class="{{$loop->iteration == 1?'border':''}} {{$loop->iteration == count($bills)?'border-bawah':''}}">
                            <td>{{$loop->iteration}}</td>
                            <td>{{$bill->no_nota_kas}}</td>
                            <td>{{$bill->customer->nama}}</td>
                            <td>Rp.{{$bill->total_nota}},-</td>
                            <td>Rp.{{  $bill->kembalian_nota < 0 ?abs($bill->kembalian_nota).",-":"-"}}</td>
                            <td>{{  strtoupper($bill->status)}}</td>
                            <td>{{$bill->branch->nama}}</td>
                        </tr>
                        @php
                            $temppiutang = $bill->kembalian_nota < 0 ?abs($bill->kembalian_nota):0;
                            $totalpiutang+=$temppiutang;
                            $total+=$bill->total_nota
                        @endphp
                    @endforeach

                    <tr class="border-bawah">
                        <td></td>
                        <td></td>
                        <td>JUMLAH</td>
                        <td>Rp {{$total}},-</td>
                        <td>Rp {{$totalpiutang}},-</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr class="border-bawah">
                        <td></td>
                        <td></td>
                        <td>JUMLAH KAS</td>
                        <td>Rp {{$total-$totalpiutang}},-</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
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
