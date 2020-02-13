<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <title>Laporan Piutang</title>
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
            <h4 class="text-center">LAPORAN PIUTANG</h4>
            <h4 class="text-center">{{ strtoupper($app->toko) }} {{ strtoupper($branch->nama) }}</h4>

            <br>
            <br>

            <table class="table table-hover text-center">
                    <tr>
                            <th  class="border">No.</th>
                            <th  class="border">No. Nota Bon</th>
                            <th  class="border">Nama Pelanggan</th>
                            <th  class="border">Alamat</th>
                            <th  class="border">Hutang</th>
                            <th  class="border">Cabang</th>
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
                    {{$branch->nama}},{{$date}} <br>
                    Manager Cabang, <br><br><br><br>
                    <strong>{{$branch->pimpinan}}</strong>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
