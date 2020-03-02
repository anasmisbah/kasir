<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <title>Daftar Stok Barang</title>
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
    </style>
</head>
<body>
    <div class="container">
        <div class="row" style="padding-top:10px">
            <div class="text-center title">DAFTAR STOK BARANG</div>
            <div class="text-center title">{{ strtoupper($app->toko) }} {{ strtoupper($branch->nama) }}</div>
            <br>
            <br>
            <table class="table table-hover">
                    <tr>
                        <th class="text-center">No.</th>
                        <th class="text-center">Nama Barang</th>
                        <th class="text-center">Cabang</th>
                        <th class="text-center">Harga Pusat</th>
                        <th class="text-center">Harga Cabang</th>
                        <th class="text-center">Stok (Kg)</th>
                    </tr>
                <tbody>
                    @foreach ($supplies as $supply)
                        @if ($loop->iteration == count($supplies))
                        <tr>
                            <td class="border-bawah text-center">{{$loop->iteration}}</td>
                            <td class="border-bawah">{{$supply->item->nama}}</td>
                            <td class="border-bawah text-center">{{$supply->branch->nama}}</td>
                            <td class="border-bawah text-right">Rp <span class="harga">{{$supply->item->harga}}</span>,-</td>
                            <td class="border-bawah text-right">Rp <span class="harga">{{$supply->harga_cabang}}</span>,-</td>
                            <td class="border-bawah text-center">{{$supply->stok}}</td>
                        </tr>
                        @else
                        <tr>
                            <td class="text-center">{{$loop->iteration}}</td>
                            <td class="">{{$supply->item->nama}}</td>
                            <td class="text-center">{{$supply->branch->nama}}</td>
                            <td class=" text-right">Rp <span class="harga">{{$supply->item->harga}}</span>,-</td>
                            <td class=" text-right">Rp <span class="harga">{{$supply->harga_cabang}}</span>,-</td>
                            <td class="text-center">{{$supply->stok}}</td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="row" style="margin-top:10px">
            <div class="col">
                <p class="pull-right sign">
                    {{$branch->nama}}, {{$date->day.' '.$date->monthName.' '.$date->year}} <br>
                    {{$user->employee->jabatan}}, <br><br><br><br>
                    <strong>{{$user->employee->br}}</strong>
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
