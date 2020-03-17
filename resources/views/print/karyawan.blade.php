<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="shortcut icon" href="{{asset('/img/favico.png')}}" type="image/x-icon">
    <title>Karyawan Cetak | {{$app->nama}}</title>
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
    .table{
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
        <div class="row" style="padding-top:10px" >
            <div class="text-center title">DAFTAR KARYAWAN</div>
            <div class="text-center title">
                {{ strtoupper($app->toko) }}
                @if ($filter_cabang != '0')
                    {{ strtoupper($branch->nama) }}
                @endif
            </div>
            <div class="text-center title">PER TANGGAL {{$date->day.' '.strtoupper($date->monthName).' '.$date->year}}</div>
            <br>
            <br>
            <table class="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Alamat</th>
                        <th>Telepon</th>
                        <th>Cabang</th>
                    </tr>
                    </thead>
                <tbody>
                    @foreach ($employees as $employee)
                        @if ($loop->iteration == count($employees))
                            <tr>
                                <td class="border-bawah text-center">{{$loop->iteration}}</td>
                                <td class="border-bawah">{{$employee->nama}}</td>
                                <td class="border-bawah text-center">{{$employee->jabatan}}</td>
                                <td class="border-bawah">{{$employee->alamat}}</td>
                                <td class="border-bawah text-center">{{$employee->telepon}}</td>
                                <td class="border-bawah text-center">{{$employee->branch->nama}}</td>
                            </tr>
                        @else
                        <tr>
                            <td class="text-center">{{$loop->iteration}}</td>
                            <td>{{$employee->nama}}</td>
                            <td class="text-center">{{$employee->jabatan}}</td>
                            <td>{{$employee->alamat}}</td>
                            <td class="text-center">{{$employee->telepon}}</td>
                            <td class="text-center">{{$employee->branch->nama}}</td>
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
                    <strong>{{$user->employee->nama}}</strong>
                </p>
            </div>
        </div>
    </div>

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
</body>
</html>
