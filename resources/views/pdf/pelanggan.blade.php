<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <title>Daftar Pelanggan</title>

</head>
<body>
    <div class="container">
        <div class="row" >
            <h4 class="text-center">DAFTAR PELANGGAN</h4>
            <h4 class="text-center">{{ strtoupper($app->toko) }} {{ strtoupper($branch->nama) }}</h4>

            <br>
            <br>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Telepon</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $customer)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$customer->nama}}</td>
                            <td>{{$customer->alamat}}</td>
                            <td>{{$customer->telepon}}</td>
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


