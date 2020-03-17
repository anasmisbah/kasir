<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="shortcut icon" href="{{asset('/img/favico.png')}}" type="image/x-icon">
    <title>Pelanggan Cetak | {{$app->nama}}</title>
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
<body id="body_print">
    <div class="container">
        <div class="row" style="padding-top:10px">
            <div class="text-center title">DAFTAR PELANGGAN</div>
            <div class="text-center title">
                {{ strtoupper($app->toko) }}
                @if ($filter_cabang != '0')
                    {{ strtoupper($branch->nama) }}
                @endif
            </div>
            <br>
            <br>
            <table class="table text-center">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Telepon</th>
                        <th>Cabang</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $customer)
                        @if ($loop->iteration == count($customers))
                        <tr>
                            <td class="border-bawah">{{$loop->iteration}}</td>
                            <td class="border-bawah text-left">{{$customer->nama}}</td>
                            <td class="border-bawah text-left">{{$customer->alamat}}</td>
                            <td class="border-bawah">{{$customer->telepon}}</td>
                            <td class="border-bawah">{{$customer->branch->nama}}</td>
                        </tr>
                        @else
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td class="text-left">{{$customer->nama}}</td>
                            <td class="text-left">{{$customer->alamat}}</td>
                            <td>{{$customer->telepon}}</td>
                            <td>{{$customer->branch->nama}}</td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="row" style="margin-top:10px">
            <div class="col">
                <p class="pull-right sign">
                    {{$app->kota}},{{$date->day.' '.$date->monthName.' '.$date->year}} <br>
                    {{$user->employee->jabatan}}, <br><br><br><br>
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


