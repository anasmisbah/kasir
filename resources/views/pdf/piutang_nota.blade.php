<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <title>Nota Bon</title>

    <style>
        body {
            margin-top: 40px;
        }
        th{
            text-align: center !important
        }
        .hr-red {
            background-color: red;
            height: 5px;
        }

        .grid-item h3,
        .grid-item h4 {
            font-weight: bold
        }

        .grid-item p{
            margin-top: -10px;
        }
        .grid-container{
            display: grid;
            grid-template-columns: 400px 100px 300px;
        }
        .grid-item.second{
            margin-top:3rem;
            text-align: right;
        }
        .grid-container-2{
            display: grid;
            grid-template-columns: 350px 120px
        }
    </style>
</head>

<body>
    <div class="container">

        <div class="grid-container">
            <div class="grid-item">
                <h3>NOTA BON</h3>
                <h4 class="mt-1">{{$app->toko}}</h4>
                <div>{{$app->alamat}}</div>
                <div>{{$app->telepon}}</div>

            </div>
            <div class="grid-item second">
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

        <div class="row">
            <div class="col-md-12">
                <table class="no-margin table table-hover text-center" id="table">
                    <thead>
                        <tr>
                            <th>No Nota Kas</th>
                            <th>Tanggal nota Kas</th>
                            <th>Sub Total Nota Kas</th>
                            <th>Diskon</th>
                            <th>Total Nota Kas</th>
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
                            <td class="text-center">{{$bill->no_nota_kas}}</td>
                            <td width="50%" class="text-center">{{$bill->tanggal_nota->format('d F Y')}}</td>
                            <td class="text-center" >Rp {{$subtotal}}</td>
                            <td class="text-center" width="10%">Rp {{$subtotal-$bill->total_nota}}</td>
                            <td class="text-center">Rp {{$bill->total_nota}},-</td>
                        </tr>
                        <tr class="text-center">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Uang Muka</td>
                            <td>Rp {{$bill->jumlah_uang_nota}},-</td>
                        </tr>
                        <tr class="text-center">
                            <td style="border: none"></td>
                            <td style="border: none"></td>
                            <td style="border: none"></td>
                            <td ><strong>Piutang</strong></td>
                            <td> <strong>Rp {{ abs($bill->kembalian_nota)}} ,-</strong></td>
                        </tr>
                        <tr class="text-center">
                            <td style="border: none"></td>
                            <td style="border: none"></td>
                            <td style="border: none"></td>
                            <td>Pembayaran</td>
                            <td>Rp {{abs($bill->kembalian_nota)}} ,-</td>
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
</html>
