<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <title>Daftar Karyawan</title>

</head>
<body>
    <div class="container">
        <div class="row" >
            <h4 class="text-center">DAFTAR KARYAWAN</h4>
            <h4 class="text-center">{{ strtoupper($app->toko) }} {{ strtoupper($branch->nama) }}</h4>

            <br>
            <br>

            <table class="table table-striped">
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
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$employee->nama}}</td>
                            <td>{{$employee->jabatan}}</td>
                            <td>{{$employee->alamat}}</td>
                            <td>{{$employee->telepon}}</td>
                            <td>{{$employee->branch->nama}}</td>
                        </tr>
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
</body>
</html>
