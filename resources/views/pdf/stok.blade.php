<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <title>Daftar Stok Barang</title>
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
        <div class="row mt-3" >
            <h4 class="text-center">DAFTAR STOK BARANG</h4>
            <h4 class="text-center">{{ strtoupper($app->toko) }} {{ strtoupper($branch->nama) }}</h4>
            <br>
            <br>
            <table class="table table-hover">
                    <tr>
                        <th class="border">No.</th>
                        <th class="border">Nama Barang</th>
                        <th class="border">Cabang</th>
                        <th class="border">Harga Pusat</th>
                        <th class="border">Harga Cabang</th>
                        <th class="border">Stok (Kg)</th>
                    </tr>
                <tbody>
                    @foreach ($supplies as $supply)
                        @if ($loop->iteration == 1)
                        <tr>
                            <td class="border">{{$loop->iteration}}</td>
                            <td class="border">{{$supply->item->nama}}</td>
                            <td class="border">{{$supply->branch->nama}}</td>
                            <td class="border">{{$supply->item->harga}}</td>
                            <td class="border">{{$supply->harga_cabang}}</td>
                            <td class="border">{{$supply->stok}}</td>
                        </tr>
                        @elseif ($loop->iteration == count($supplies))
                        <tr>
                            <td class="border-bawah">{{$loop->iteration}}</td>
                            <td class="border-bawah">{{$supply->item->nama}}</td>
                            <td class="border-bawah">{{$supply->branch->nama}}</td>
                            <td class="border-bawah">{{$supply->item->harga}}</td>
                            <td class="border-bawah">{{$supply->harga_cabang}}</td>
                            <td class="border-bawah">{{$supply->stok}}</td>
                        </tr>
                        @else
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$supply->item->nama}}</td>
                            <td>{{$supply->branch->nama}}</td>
                            <td>{{$supply->item->harga}}</td>
                            <td>{{$supply->harga_cabang}}</td>
                            <td>{{$supply->stok}}</td>
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
                    {{$branch->pimpinan}}
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
