<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="shortcut icon" href="{{asset('/uploads/'.$app->logo)}}" type="image/x-icon">
    <title>Daftar Pengguna</title>
    <style>
        .border{
            border-top: 1px solid black !important;
        }
        .border-bawah{
        border-bottom: 1px solid black !important;
        }
        .table th{
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
    </style>
</head>
<body id="body_print">
    <div class="container">
        <div class="row" style="padding-top:10px">
            <div class="text-center title">DAFTAR PENGGUNA</div>
            <div class="text-center title">{{ strtoupper($app->toko) }} {{ strtoupper($user->employee->branch->nama) }}</div>
            <div class="text-center title">PER TANGGAL {{$dateNow->day.' '.strtoupper($dateNow->monthName).' '.$dateNow->year}}</div>
            <br>
            <br>
            <table class="table text-center">
                    <tr>
                        <th class="text-center">No.</th>
                        <th class="text-center">Nama Pengguna</th>
                        <th class="text-center">Nama Lengkap</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Level</th>
                        <th class="text-center">Cabang</th>
                    </tr>
                <tbody>
                    @foreach ($users as $item)
                        @if ($loop->iteration == count($users))
                        <tr>
                            <td class="border-bawah">{{$loop->iteration}}</td>
                            <td class="border-bawah text-left">{{$item->username}}</td>
                            <td class="border-bawah text-left">{{$item->employee->nama}}</td>
                            <td class="border-bawah text-left">{{$item->email}}</td>
                            <td class="border-bawah">{{$item->level->nama}}</td>
                            <td class="border-bawah">{{$item->employee->branch->nama}}</td>
                        </tr>
                        @else
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td class="text-left">{{$item->username}}</td>
                            <td class="text-left">{{$item->employee->nama}}</td>
                            <td class="text-left">{{$item->email}}</td>
                            <td class="">{{$item->level->nama}}</td>
                            <td class="">{{$item->employee->branch->nama}}</td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="row" style="margin-top:10px">
            <div class="col">
                <p class="pull-right sign">
                    {{$app->kota}},{{$dateNow->day.' '.$dateNow->monthName.' '.$dateNow->year}} <br>
                    {{$user->employee->jabatan}}, <br><br><br><br>
                    <strong>{{$user->employee->branch->pimpinan}}</strong>
                </p>
            </div>
        </div>
    </div>
</body>
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

</html>


