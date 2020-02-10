<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/adminlte/plugins/bootstrap3.min.css">    <title>Laporan Piutang</title>
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
            <h4 class="text-center">LAPORAN PIUTANG</h4>
            <h4 class="text-center">{{ strtoupper($app->toko) }} {{ strtoupper($branch->nama) }}</h4>

            <br>
            <br>

            <table class="table table-striped text-center">
                    <tr class="border">
                            <th>No.</th>
                            <th>No. Nota Bon</th>
                            <th>Nama Pelanggan</th>
                            <th>Alamat</th>
                            <th>Hutang</th>
                            <th>Cabang</th>
                    </tr>
                <tbody>
                    @php
                        $total = 0;
                    @endphp
                    @foreach ($bills as $bill)
                        <tr class="{{$loop->iteration == 1?'border':''}} {{$loop->iteration == count($bills)?'border-bawah':''}}">
                            <td>{{$loop->iteration}}</td>
                            <td>{{$bill->customer->nama}}</td>
                            <td>{{$bill->no_nota_kas}}</td>
                            <td>{{$bill->customer->alamat}}</td>
                            <td>Rp.{{  $bill->kembalian_nota < 0 ?abs($bill->kembalian_nota).",-":"-"}}</td>
                            <td>{{$bill->branch->nama}}</td>
                        </tr>
                        @php
                            $total += abs($bill->kembalian_nota)
                        @endphp
                    @endforeach
                    <tr class="text-center border-bawah">
                        <td colspan="4"><strong>JUMLAH</strong></td>
                        <td> <strong>Rp {{$total}},-</strong></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row" style="margin-top:10px">
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
