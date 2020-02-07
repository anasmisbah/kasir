<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <title>Nota Kas</title>

    <style>
        body {
            margin-top: 40px;
        }

        .hr-red {
            background-color: red;
            height: 5px;
        }

        .header h3,
        .header h4 {
            font-weight: bold
        }
        th{
            text-align: center
        }
        .header p{
            margin-top: -10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row header">
            <div class="col-md-5">
                <div>NOTA KAS</div>
                <h4 class="mt-1">{{$app->toko}}</h4>
                <div>{{$app->alamat}}</div>
                <div>{{$app->telepon}}</div>
            </div>
                    <div class="col-md-3 text-right">
                        <p>No. Nota Bon:</p>
                        <p>Tanggal:</p>
                        <p>Pelanggan:</p>
                        <p>Alamat:</p>

                    </div>
                    <div class="col-md-4">
                        <p>{{$bill->no_nota_kas}}</p>
                        <p>{{$bill->tanggal_nota->format('d F Y | h:i:s')}} WIB</p>
                        <p>{{$bill->customer->nama}}</p>
                        <p>{{$bill->customer->alamat}}
                        </p>
                        <p>{{$bill->customer->telepon}}</p>
                    </div>
        </div>
        <div class="row">
            <div class="col-md-12">
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
                        @php
                            $subtotal = 0;
                        @endphp
                        @foreach ($bill->transaction as $trans)
                            <tr>
                                <td class="text-center">{{$loop->iteration}}</td>
                                <td width="50%" class="text-center">{{$trans->supply->item->nama}}</td>
                                <td class="text-center" >{{$trans->supply->harga_cabang}}</td>
                                <td class="text-center" width="10%">{{$trans->kuantitas}}</td>
                                <td class="text-center">Rp {{$trans->total_harga}},-</td>
                            </tr>
                            @php
                                $subtotal+=$trans->total_harga
                            @endphp
                        @endforeach

                        <tr class="text-center">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Sub Total</td>
                            <td>Rp {{$subtotal}},-</td>
                        </tr>
                        <tr class="text-center">
                            <td style="border: none"></td>
                            <td style="border: none"></td>
                            <td > Diskon &nbsp;&nbsp;{{$bill->diskon}}%</td>
                            <td ><b>TOTAL</b></td>
                            <td>Rp {{$bill->total_nota}} ,-</td>
                        </tr>
                        <tr class="text-center">
                            <td style="border: none"></td>
                            <td style="border: none"></td>
                            <td ></td>
                            <td>Uang Muka</td>
                            <td>Rp {{$bill->jumlah_uang_nota}} ,-</td>
                        </tr>
                        <tr class="text-center">
                            <td style="border: none"></td>
                            <td style="border: none"></td>
                            <td style="border: none"></td>
                            <td>Piutang</td>
                            <td>Rp {{ $bill->kembalian_nota < 0 ?abs($bill->kembalian_nota).",-":"-"}} ,-</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                Status : <span><b><i>{{strtoupper($bill->status)}}</i></b></span>
            </div>
            <div class="col-lg-4">
                <p>Hormat Kami,</p>
                <br><br>
                <b> {{$bill->user->employee->nama}} </b>
            </div>
        </div>
    </div>
</body>

</html>
