<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="shortcut icon" href="{{asset('/img/favico.png')}}" type="image/x-icon">
    <title>Stok Barang Cetak | {{$app->nama}}</title>
    <style>
        .border{
                border-top: 1px solid black !important;
        }
        .border-bawah{
        border-bottom: 1px solid black !important;
        }
        .table th{
            text-align: center;
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

        .table th, .table td{
        padding: 0.4rem !important;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row" style="padding-top:10px">
            <div class="text-center title">DAFTAR STOK BARANG</div>
            <div class="text-center title">
                {{ strtoupper($app->toko) }}
                @if ($filter_cabang != '0')
                    {{ strtoupper($branch->nama) }}
                @endif
            </div>
            <br>
            <br>
            <table class="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Barang</th>
                        <th>Cabang</th>
                        <th>Stok (Kg)</th>
                        <th style="width:3%"></th>
                        <th>Harga Pusat</th>
                        <th style="width:3%"></th>
                        <th>Harga Cabang</th>
                        <th style="width:3%"></th>
                        <th>Selisih</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($supplies as $supply)
                        @if ($loop->iteration == count($supplies))
                        <tr>
                            <td class="border-bawah text-center">{{$loop->iteration}}</td>
                            <td class="border-bawah">{{$supply->item->nama}}</td>
                            <td class="border-bawah text-center">{{$supply->branch->nama}}</td>
                            <td class="border-bawah text-center">{{$supply->stok}}</td>
                            <td class="border-bawah text-right">Rp</td>
                            <td class="border-bawah text-right"><span class="harga">{{$supply->item->harga}}</span>,-</td>
                            <td class="border-bawah text-right">Rp</td>
                            <td class="border-bawah text-right"><span class="harga">{{$supply->harga_cabang}}</span>,-</td>
                            <td class="border-bawah text-right">Rp</td>
                            <td class="border-bawah text-right"><span class="harga">{{$supply->harga_selisih}}</span>,-</td>
                        </tr>
                        @else
                        <tr>
                            <td class="text-center">{{$loop->iteration}}</td>
                            <td class="">{{$supply->item->nama}}</td>
                            <td class="text-center">{{$supply->branch->nama}}</td>
                            <td class="text-center">{{$supply->stok}}</td>
                            <td class=" text-right">Rp</td>
                            <td class=" text-right"><span class="harga">{{$supply->item->harga}}</span>,-</td>
                            <td class=" text-right">Rp</td>
                            <td class=" text-right"><span class="harga">{{$supply->harga_cabang}}</span>,-</td>
                            <td class="text-right">Rp</td>
                            <td class="text-right"><span class="harga">{{$supply->harga_selisih}}</span>,-</td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="row" style="margin-top:10px">
            <div class="col">
                <p class="pull-right sign">
                    {{$app->kota}}, {{$date->day.' '.$date->monthName.' '.$date->year}} <br>
                    {{$user->employee->jabatan}}, <br><br><br><br>
                    <strong>{{$user->employee->nama}}</strong>
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
    window.addEventListener("afterprint", function(){
      history.back();
    });
    $("#body_print").ready(function(){
      window.print();
    });
  </script>
</body>
</html>
