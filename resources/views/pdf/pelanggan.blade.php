<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <title>Daftar Pelanggan</title>
    <style>
        .border{
            border-top: 2px solid black !important;
        }
        .border-bawah{
        border-bottom: 2px solid black !important;
        }
    </style>
</head>
<body id="body_print">
    <div class="container">
        <div class="row mt-3" >
            <h4 class="text-center">DAFTAR PELANGGAN</h4>
            <h4 class="text-center">{{ strtoupper($app->toko) }} {{ strtoupper($branch->nama) }}</h4>

            <br>
            <br>

            <table class="table table-hover text-center">
                    <tr>
                        <th  class="border">No.</th>
                        <th  class="border">Nama</th>
                        <th  class="border">Alamat</th>
                        <th  class="border">Telepon</th>
                    </tr>
                <tbody>
                    @foreach ($customers as $customer)
                        @if ($loop->iteration == 1)
                        <tr>
                            <td class="border">{{$loop->iteration}}</td>
                            <td class="border">{{$customer->nama}}</td>
                            <td class="border">{{$customer->alamat}}</td>
                            <td class="border">{{$customer->telepon}}</td>
                        </tr>
                        @elseif ($loop->iteration == count($customers))
                        <tr>
                            <td class="border-bawah">{{$loop->iteration}}</td>
                            <td class="border-bawah">{{$customer->nama}}</td>
                            <td class="border-bawah">{{$customer->alamat}}</td>
                            <td class="border-bawah">{{$customer->telepon}}</td>
                        </tr>
                        @else
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$customer->nama}}</td>
                            <td>{{$customer->alamat}}</td>
                            <td>{{$customer->telepon}}</td>
                        </tr>
                        @endif
                    @endforeach
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


