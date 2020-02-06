<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <title>Nota Kas</title>

    <style>
        body{
            margin-top: 40px;
        }
        .hr-red{
            background-color: red;
            height: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <hr class="hr-red">
        <div class="row " >
            <div class="col-md-4">
                <p class="pull-left" style="margin-top: -10px"> From. <br>
                    <h3>Nota Kas</h3>
                    <h4>{{ $app->toko }}</h4>
                    {{$app->alamat}}<br>
                    {{$app->telepon}}<br>
                    </p>
            </div>
            <div class="col-md-4">
                <p class="pull-right" style="margin-left: 7.5px; margin-top: -10px">No Nota Kas :</p><br>
                <p class="pull-right" style="margin-left: 7.5px; margin-top: -10px">Tanggal : </p><br>
                <p class="pull-right" style="margin-left: 7.5px; margin-top: -10px">Pelanggan </p><br>
                <p class="pull-right" style="margin-left: 7.5px; margin-top: -10px">Alamat :  </p><br>


            </div>
            <div class="col-md-2">
                        <p class="pull-left" style="margin-left: 0px; margin-top: -10px">{{$bill->no_nota_kas}}</p><br>
                        <p class="pull-left" style="margin-left: 0px; margin-top: -10px">{{$bill->tanggal_nota->format('d F Y')}}</p><br>
                        <p class="pull-left" style="margin-left: 0px; margin-top: -10px">{{$bill->customer->nama}}</p><br>
                        <p class="pull-left" style="margin-left: 0px; margin-top: -10px">{{$bill->customer->alamat}}</p><br>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                    <div class="box box-danger" style="margin-top:20px">
                            <div class="box-body">
                                <table class="no-margin table table-hover" id="table">
                                    <thead>
                                    <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Harga Satuan</th>
                                    <th>Qty(Kg)</th>
                                    <th>Jumlah</th>
                                    </tr>
                                    </thead>
                                <tbody>
                                    @foreach($bill->transaction as $transaction)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$transaction->supply->item->nama}}</td>
                                        <td>{{$transaction->supply->harga_cabang}}</td>
                                        <td>{{$transaction->kuantitas}}</td>
                                        <td>{{$transaction->total_harga}}</td>
                                    </tr>
                                    @endforeach
                                <tr>
                                    <td></td>
                                    <td>diskon (%)</td>
                                    <td>{{$bill->diskon}}</td>
                                    <td><b>Total</b></td>
                                    <td><b>{{$bill->total_nota}}</b></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>status :</td>
                                    <td>{{$bill->status}}</td>
                                </tr>
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
            </div>
    </div>
</body>
</html>
