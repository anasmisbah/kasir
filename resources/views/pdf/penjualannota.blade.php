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
            font-family: "Arial", Helvetica, sans-serif;
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
        .title{
            font-size: 14pt;
            font-weight: bold;
        }
        .table{
            font-size: 12px;
        }
        .table th{
            border-top: 2px solid black !important;
            border-bottom: 2px solid black !important;
        }

    </style>
</head>

<body>
    <div class="container">
        <div class="row">
                <div style="padding-left:20px" class="column-5">
                    <div style="margin-top:0px;" class="title">NOTA KAS</div>
                    <div style="margin-top:5px" style="text-transform:uppercase"><b>{{ $app->toko}}</b></div>
                    <div style="margin-top:5px">{{$app->alamat}}</div>
                    <div>{{$app->telepon}}</div>
                </div>
                <div class="column-2" style="text-align:right">
                    <div>No. Nota Kas:</div>
                    <div>Tanggal:</div>
                    <div>Pelanggan:</div>
                    <div>Alamat:</div>

                </div>
                <div class="column-4" style="margin-left:20px">
                    <div>{{$bill->no_nota_kas}}</div>
                    <div>{{$bill->tanggal_nota->day.' '.$bill->tanggal_nota->monthName.' '.$bill->tanggal_nota->year}} | {{$bill->tanggal_nota->format('h:i:s')}} WIB</div>
                    <div>{{$bill->customer->nama}}</div>
                    <div>{{$bill->customer->alamat}}
                    </div>
                    <p>{{$bill->customer->telepon}}</p>
                </div>
        </div>
        <div class="row" style="margin-top:10px">
            <div class="col-md-12">
                <table class="no-margin table table-hover" id="table">
                    <thead>
                        <tr class="border">
                            <th width="7%" class="text-center">No</th>
                            <th width="36%"class="text-center">Nama Barang</th>
                            <th width="15%" class="text-center">Harga Satuan</th>
                            <th width="15%" class="text-center">Qty(Kg)</th>
                            <th width="2%"></th>
                            <th width="10%" class="text-center">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $subtotal = 0;
                        @endphp
                        @foreach ($bill->transaction as $trans)

                        @if ($loop->iteration == count($bill->transaction))
                        <tr>
                            <td class="border-bawah text-center">{{$loop->iteration}}</td>
                            <td class="border-bawah text-center">{{$trans->supply->item->nama}}</td>
                            <td class="border-bawah text-right">Rp <span class="harga">{{$trans->supply->harga_cabang}}</span>,-</td>
                            <td class="border-bawah text-center" width="10%">{{$trans->kuantitas}}</td>
                            <td class="border-bawah text-right">Rp</td>
                            <td class="border-bawah text-right"><span class="harga">{{$trans->total_harga}}</span>,-</td>
                        </tr>
                        @else
                        <tr>
                            <td class="text-center">{{$loop->iteration}}</td>
                            <td  class="text-center">{{$trans->supply->item->nama}}</td>
                            <td class="text-right">Rp <span class="harga">{{$trans->supply->harga_cabang}}</span>,-</td>
                            <td class="text-center" width="10%">{{$trans->kuantitas}}</td>
                            <td class="text-right">Rp</td>
                            <td class="text-right"><span class="harga">{{$trans->total_harga}}</span>,-</td>
                        </tr>
                        @endif
                        @php
                        $subtotal+=$trans->total_harga
                        @endphp
                        @endforeach

                        <tr class="text-center">
                            <td>Status:</td>
                            <td  style="text-align:left"><span> <strong>{{strtoupper($bill->status)}}</strong></span><span style="margin-left:60px">Hormat Kami,</span></td>
                            <td></td>
                            <td class="border-bawah">Sub Total</td>
                            <td class="border-bawah text-right">Rp</td>
                            <td class="border-bawah text-right"><span class="harga">{{$subtotal}}</span>,-</td>
                        </tr>
                        <tr class="text-center">
                            <td style="border: none"></td>
                            <td style="border: none"></td>
                            <td class="border-bawah border"> Diskon &nbsp;&nbsp;{{$bill->diskon}}%</td>
                            <td class="border-bawah"><b>TOTAL</b></td>
                            <td class="border-bawah text-right"> <b> Rp</b></td>
                            <td class="border-bawah text-right"><b><span class="harga">{{$bill->total_nota}}</span>,-</b></td>
                        </tr>
                        <tr class="text-center">
                            <td style="border: none"></td>
                            <td style="border: none"> <strong>{{$bill->user->employee->nama}}</strong></td>
                            <td style="border: none"></td>
                            <td class="border-bawah">Uang Muka</td>
                            <td class="border-bawah text-right">Rp</td>
                            <td class="border-bawah text-right"><span class="harga">{{$bill->jumlah_uang_nota}}</span>,-</td>
                        </tr>
                        <tr class="text-center">
                            <td style="border: none"></td>
                            <td style="border: none"></td>
                            <td style="border: none"></td>
                            <td class="border-bawah">Piutang</td>
                            <td class="border-bawah text-right">Rp</td>
                            @if ($bill->kembalian_nota < 0)
                                <td class="border-bawah text-right"><span class="harga">{{ abs($bill->kembalian_nota)}}</span>,-</td>
                            @else
                                <td class="border-bawah text-right">0,-</td>
                            @endif
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="grid-container-2">
            <div class="grid-item">
                <span><b><i></i></b></span>
            </div>
            <div class="grid-item">
                <p></p>
                <br><br>
                <b>  </b>
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
    window.addEventListener("afterprint", function() {
        history.back();
    });
    $("#body_print").ready(function() {
        window.print();
    });
</script>

</html>
