<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="shortcut icon" href="{{asset('/img/favico.png')}}" type="image/x-icon">
    <title>Cetak | {{$app->nama}}</title>
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
            border-top: 1px solid black !important;
        }

        .border-bawah {
            border-bottom: 1px solid black !important;
        }
        .title{
            font-size: 14px;
            font-weight: bold;
        }
        body{
            font-size: 12px;

        }
        body {
            font-family: "Arial", Helvetica, sans-serif;
        }
        .table th{
            border-top: 1px solid black !important;
            border-bottom: 1px solid black !important;
        }
        .table th,.table td{
            padding:0.4rem;
        }
    </style>
</head>

<body>
    <div class="container">

        <div class="row">
            <div style="padding-left:20px" class="column-7">
                <div style="margin-top:0px;" class="title">NOTA BON</div>
                <div style="margin-top:5px" style="text-transform:uppercase"><b>{{ $app->toko}}</b></div>
                <div style="margin-top:5px">{{$bill->branch->alamat}}, {{$bill->branch->kecamatan}}, {{$bill->branch->kota}}, {{$bill->branch->provinsi}}</div>
                <div>{{$bill->branch->telepon}}</div>

            </div>
            <div class="column-1" style="text-align:right">
                <div>No. Nota Bon:</div>
                <div>Tanggal:</div>
                <div>divelanggan:</div>
                <div>Alamat:</div>
            </div>
            <div class="column-3" style="margin-left:10px">
                <div>{{$bill->no_nota_kas}}</div>
                <div>{{$bill->tanggal_nota->day." ".$bill->tanggal_nota->monthName." ".$bill->tanggal_nota->year.' | '.$bill->tanggal_nota->format('H:i:s')}} WIB</div>
                <div>{{$bill->customer->nama}}</div>
                <div>{{$bill->customer->alamat}}
                </div>
                <div>{{$bill->customer->telepon}}</p>
            </div>
        </div>

        <div class="row" style="margin-top:10px">
            <div class="col-md-12">
                <table class="no-margin table" id="table">
                    <thead>
                        <tr>
                            <th width="18%" class="border border-bawah text-center">No Nota Kas</th>
                            <th width="22%"class="border border-bawah text-center">Tanggal nota Kas</th>
                            <th width="25%" class="border border-bawah text-center">Sub Total Nota Kas</th>
                            <th width="7%" class="border border-bawah text-center">Diskon</th>
                            <th width="2%"></th>
                            <th width="18%" class="border border-bawah text-center">Total Nota Kas</th>
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
                            <td class="border-bawah text-center">{{$bill->tanggal_nota->day." ".$bill->tanggal_nota->monthName." ".$bill->tanggal_nota->year}}</td>
                            <td class="border-bawah text-center" >Rp <span class="harga">{{$bill->total_nota}}</span>,-</td>
                            <td class="border-bawah text-center" width="10%">Rp 0,-</td>
                            <td class="border-bawah text-right">Rp</td>
                            <td class="border-bawah text-right"><span class="harga">{{$bill->total_nota}}</span>,-</td>
                        </tr>
                        <tr class="text-center">
                            <td colspan="2" class="text-left">Status: <strong> <i> {{strtoupper($bill->status)}}</strong></i></td>
                            <td class="text-center"><span>Hormat Kami,</span></td>
                            <td class="border-bawah">Uang Muka</td>
                            <td class="border-bawah text-right">Rp</td>
                            <td class="border-bawah text-right"><span class="harga">{{$bill->jumlah_uang_nota}}</span>,-</td>
                        </tr>
                        <tr class="text-center">
                            <td style="border: none"></td>
                            <td style="border: none"></td>
                            <td style="border: none"></td>
                            <td class="border-bawah" ><strong>Piutang</strong></td>
                            <td class="border-bawah text-right" ><strong>Rp</strong></td>
                            <td class="border-bawah text-right"> <strong><span class="harga">{{ abs($bill->kembalian_nota)}}</span> ,-</strong></td>
                        </tr>
                        <tr class="text-center">
                            <td style="border: none"></td>
                            <td style="border: none"></td>
                            <td style="border: none;" class="text-center"><b> {{$bill->user->employee->nama}} </b></td>
                            <td class="border-bawah">Pembayaran</td>
                            <td class="border-bawah text-right">Rp</td>
                            <td class="border-bawah text-right"><span class="harga">{{abs($bill->kembalian_nota)}}</span>,-</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
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
        $("#body_print").ready(function() {
            window.print();
        });
    </script>
</body>
</html>
