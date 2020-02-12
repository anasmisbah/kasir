<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <title>Daftar Karyawan</title>
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
            <h4 class="text-center">DAFTAR KARYAWAN</h4>
            <h4 class="text-center">{{ strtoupper($app->toko) }} {{ strtoupper($branch->nama) }}</h4>

            <br>
            <br>

            <table class="table table-hover">
                    <tr>
                        <th class="border">No.</th>
                        <th class="border">Nama</th>
                        <th class="border">Jabatan</th>
                        <th class="border">Alamat</th>
                        <th class="border">Telepon</th>
                        <th class="border">Cabang</th>
                    </tr>
                <tbody>
                    @foreach ($employees as $employee)
                        @if ($loop->iteration == 1)
                        <tr>
                            <td class="border">{{$loop->iteration}}</td>
                            <td class="border">{{$employee->nama}}</td>
                            <td class="border">{{$employee->jabatan}}</td>
                            <td class="border">{{$employee->alamat}}</td>
                            <td class="border">{{$employee->telepon}}</td>
                            <td class="border">{{$employee->branch->nama}}</td>
                        </tr>
                        @elseif ($loop->iteration == count($employees))
                            <tr>
                                <td class="border-bawah">{{$loop->iteration}}</td>
                                <td class="border-bawah">{{$employee->nama}}</td>
                                <td class="border-bawah">{{$employee->jabatan}}</td>
                                <td class="border-bawah">{{$employee->alamat}}</td>
                                <td class="border-bawah">{{$employee->telepon}}</td>
                                <td class="border-bawah">{{$employee->branch->nama}}</td>
                            </tr>
                        @else
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$employee->nama}}</td>
                            <td>{{$employee->jabatan}}</td>
                            <td>{{$employee->alamat}}</td>
                            <td>{{$employee->telepon}}</td>
                            <td>{{$employee->branch->nama}}</td>
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
