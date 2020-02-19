<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <title>Nota Bon</title>
    <style>
        body {
            margin-top: 40px !important;
        }

        .hr-red {
            background-color: red !important;
            height: 5px !important;
        }

        .grid-item h3,
        .grid-item h4 {
            font-weight: bold !important
        }

        .grid-item p {
            margin-top: -10px !important;
        }

        .grid-container {
            display: inline;

        }

        .column-1 {
            width: 8.3%;
            float: left;
        }

        .column-2 {
            width: 16.6%;
            float: left;
        }

        .column-3 {
            width: 25%;
            float: left;
        }

        .column-4 {
            width: 33.2%;
            float: left;
        }

        .column-5 {
            width: 41.5%;
            float: left;
        }

        .column-6 {
            width: 50%;
            float: left;
        }

        .column-7 {
            width: 58.3%;
            float: left;
        }

        .column-8 {
            width: 66.6%;
            float: left;
        }

        .column-9 {
            width: 74.9%;
            float: left;
        }

        .column-10 {
            width: 83.2%;
            float: left;
        }

        .column-11 {
            width: 91.5%;
            float: left;
        }

        .column-12 {
            width: 100%;
            float: left;
        }

        .grid-item.second {
            margin-top: 3rem !important;
            text-align: right !important;
        }

        .grid-container-2 {
            display: grid !important;
            grid-template-columns: 350px 120px !important
        }

        .border {
            border-top: 2px solid black !important;
        }

        .border-bawah {
            border-bottom: 2px solid black !important;
        }
    </style>
</head>

<body>
    <div class="container">

        <div class="row">
            <div style="padding-left:20px" class="column-6">
                <h3 style="padding-top:-20px;">NOTA BON</h3>
                <h4 class="mt-1" style="text-transform:uppercase">{{$app->toko}}</h4>
                <div>{{$app->alamat}}</div>
                <div>{{$app->telepon}}</div>

            </div>
            <div class="column-2" style="text-align:right">
                <p>No. Nota Bon:</p>
                <p>Tanggal:</p>
                <p>Pelanggan:</p>
                <p>Alamat:</p>
            </div>
            <div class="column-5" style="margin-left:20px">
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
                            <th width="15%" class="border border-bawah text-center">No Nota Kas</th>
                            <th width="25%"class="border border-bawah text-center">Tanggal nota Kas</th>
                            <th width="25%" class="border border-bawah text-center">Sub Total Nota Kas</th>
                            <th width="10%" class="border border-bawah text-center">Diskon</th>
                            <th width="25%" class="border border-bawah text-center">Total Nota Kas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $subtotal = 0;
                        @endphp
                        @foreach ($bill->transaction as $trans)
                            @php
                                $subtotal+=$trans->total_harga
                            @endphp
                        @endforeach
                        <tr>
                            <td class="border-bawah text-center">{{$bill->no_nota_kas}}</td>
                            <td class="border-bawah text-center">{{$bill->tanggal_nota->format('d F Y')}}</td>
                            <td class="border-bawah text-center" >Rp {{$subtotal}}</td>
                            <td class="border-bawah text-center" width="10%">Rp {{$subtotal-$bill->total_nota}}</td>
                            <td class="border-bawah text-center">Rp {{$bill->total_nota}},-</td>
                        </tr>
                        <tr class="text-center">
                            <td class="text-left" colspan="2">Status:<b><i>{{strtoupper($bill->status)}}</i></b></td>
                            <td><span>Hormat Kami,</span></td>
                            <td class="border-bawah">Uang Muka</td>
                            <td class="border-bawah">Rp {{$bill->jumlah_uang_nota}},-</td>
                        </tr>
                        <tr class="text-center">
                            <td style="border: none"></td>
                            <td style="border: none"></td>
                            <td style="border: none"></td>
                            <td class="border-bawah" ><strong>Piutang</strong></td>
                            <td class="border-bawah"> <strong>Rp {{ abs($bill->kembalian_nota)}} ,-</strong></td>
                        </tr>
                        <tr class="text-center">
                            <td style="border: none"></td>
                            <td style="border: none"></td>
                            <td style="border: none;"><b> {{$bill->user->employee->nama}} </b></td>
                            <td class="border-bawah">Pembayaran</td>
                            <td class="border-bawah">Rp {{abs($bill->kembalian_nota)}} ,-</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
