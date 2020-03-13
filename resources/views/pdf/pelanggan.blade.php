<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="shortcut icon" href="{{asset('/uploads/'.$app->logo)}}" type="image/x-icon">
    <title>Daftar Pelanggan</title>
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
            font-size: 14pt;
            font-weight: bold;
        }
        body{
            font-size: 12pt;
        }
        .sign{
            font-size: 12pt;
        }
        .table th,.table td{
            padding-top: 0.3rem !important;
            padding-bottom: 0.3rem !important;
        }
    </style>
</head>
<body id="body_print">
    <div class="container">
        <div class="row" style="padding-top:10px">
            <div class="text-center title">DAFTAR PELANGGAN</div>
            <div class="text-center title">{{ strtoupper($app->toko) }} {{ strtoupper($branch->nama) }}</div>
            <br>
            <br>
            <table class="table table-hover text-center">
                    <tr>
                        <th class="text-center">No.</th>
                        <th class="text-center">Nama</th>
                        <th class="text-center">Alamat</th>
                        <th class="text-center">Telepon</th>
                        <th class="text-center">Cabang</th>
                    </tr>
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


