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
                <h4 class="mt-1">NAMA TOKO</h4>
                <p>Jl. Agus Salim Gg. Masjid No. 30 Sidomulyo, Samarinda Ulu, Samarinda, Kalimantan Timur <br>75115</p>
                <p>08112233445</p>

            </div>
            <div class="grid-item second">
                <p>No. Nota Bon:</p>
                <p>Tanggal:</p>
                <p>Pelanggan:</p>
                <p>Alamat:</p>
            </div>
            <div class="grid-item" style="margin-top:3rem; margin-left:20px">
                <p>B08786755</p>
                <p>29 September 2019 | 10:30:10 WIB</p>
                <p>Wiliam Doe</p>
                <p>Jl. Agus Salim Gg. Masjid No.20 Sidomulyo, Samarinda Ulu, Samarinda, Kalimantan Timur <br>75115
                </p>
                <p>08112233445</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="no-margin table table-hover text-center" id="table">
                    <thead>
                        <tr>
                            <th>No. Nota Kas</th>
                            <th>Tanggal Nota Kas</th>
                            <th>Sub Total Nota Kas</th>
                            <th>Diskon Nota Kas</th>
                            <th>Total Nota Kas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>pocari sewat</td>
                            <td>90000</td>
                            <td>90</td>
                            <td>90000</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Uang Muka</td>
                            <td><b>20000</b></td>
                        </tr>
                        <tr>
                            <td style="border: none"></td>
                            <td style="border: none"></td>
                            <td style="border: none"></td>
                            <td ><b>PIUTANG</b></td>
                            <td>Rp 300000</td>
                        </tr>
                        <tr>
                            <td style="border: none"></td>
                            <td style="border: none"></td>
                            <td style="border: none"></td>
                            <td>Pembayaran</td>
                            <td>Rp 300000</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="grid-container-2">
            <div class="grid-item">
                Status : <span><b><i>LUNAS</i></b></span>
            </div>
            <div class="grid-item">
                <p>Hormat Kami,</p>
                <br><br>
                <b>Nama Kasir</b>
            </div>
        </div>
    </div>
</body>

</html>
