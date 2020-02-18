<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <title>Nota Kas</title>

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
            display: grid !important;
            grid-template-columns: 400px 100px 300px;
        }

        .grid-item.second {
            margin-top: 3rem !important;
            text-align: right !important;
        }

        .grid-container-2 {
            display: grid !important;
            grid-template-columns: 350px 120px !important
        }
    </style>
</head>

<body>
    <div >
        <div >
        <div >
            <div >
                <div>NOTA KAS</div>
                <h4 >{{$app->toko}}</h4>
                <div>{{$app->alamat}}</div>
                <div>{{$app->telepon}}</div>
            </div>
            <div >
                <p>No. Nota Bon:</p>
                <p>Tanggal:</p>
                <p>Pelanggan:</p>
                <p>Alamat:</p>

            </div>
            <div class="grid-item" style="margin-top:3rem; margin-left:20px">
                <p>{{$bill->no_nota_kas}}</p>
                <p>{{$bill->tanggal_nota->format('d F Y | h:i:s')}} WIB</p>
                <p>{{$bill->customer->nama}}</p>
                <p>{{$bill->customer->alamat}}
                </p>
                <p>{{$bill->customer->telepon}}</p>
            </div>
        </div>
    </div>
        <div class="row">
            <div class="col-md-12">
                <table class="no-margin table table-hover" id="table">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Barang</th>
                            <th class="text-center">Harga Satuan</th>
                            <th class="text-center">Qty(Kg)</th>
                            <th class="text-center">Jumlah</th>
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
                            <td class="text-center">{{$trans->supply->harga_cabang}}</td>
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
                            <td style="border: none"> Diskon &nbsp;&nbsp;{{$bill->diskon}}%</td>
                            <td><b>TOTAL</b></td>
                            <td>Rp {{$bill->total_nota}} ,-</td>
                        </tr>
                        <tr class="text-center">
                            <td style="border: none"></td>
                            <td style="border: none"></td>
                            <td></td>
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
        <div class="grid-container-2">
            <div class="grid-item">
                Status : <span><b><i>{{strtoupper($bill->status)}}</i></b></span>
            </div>
            <div class="grid-item">
                <p>Hormat Kami,</p>
                <br><br>
                <b> {{$bill->user->employee->nama}} </b>
            </div>
        </div>
    </div>
</body>
{{-- <!-- jQuery -->
<script src="/adminlte/plugins/jquery/jquery.min.js"></script>
<!-- AdminLTE App -->
<script src="/adminlte/dist/js/adminlte.min.js"></script>
<script>
    window.addEventListener("afterprint", function() {
        history.back();
    });
    $("#body_print").ready(function() {
        window.print();
    });
</script> --}}

</html>
