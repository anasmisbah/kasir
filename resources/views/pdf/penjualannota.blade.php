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
            <div class="col-lg-5">
                <h3>NOTA BON</h3>
                <h4 class="mt-1">NAMA TOKO</h4>
                <p>Jl. Agus Salim Gg. Masjid No. 30 Sidomulyo, Samarinda Ulu, Samarinda, Kalimantan Timur <br>75115</p>
                <p>08112233445</p>
            </div>
            <div class="col-lg-7 " style="margin-top: 3rem">
                <div class="col-lg-4 text-right">
                    <p>No. Nota Bon:</p>
                    <p>Tanggal:</p>
                    <p>Pelanggan:</p>
                    <p>Alamat:</p>

                </div>
                <div class="col-lg-8">
                    <p>B08786755</p>
                    <p>29 September 2019 | 10:30:10 WIB</p>
                    <p>Wiliam Doe</p>
                    <p>Jl. Agus Salim Gg. Masjid No.20 Sidomulyo, Samarinda Ulu, Samarinda, Kalimantan Timur <br>75115
                    </p>
                    <p>08112233445</p>
                </div>
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
                        <tr>
                            <td class="text-center">1</td>
                            <td width="50%">pocari sewat</td>
                            <td class="text-center" >90000</td>
                            <td class="text-center" width="10%">90</td>
                            <td class="text-center">90000</td>
                        </tr>
                        <tr>
                            <td class="text-center">1</td>
                            <td width="50%">pocari sewat</td>
                            <td class="text-center" >90000</td>
                            <td class="text-center" width="10%">90</td>
                            <td class="text-center">90000</td>
                        </tr>

                        <tr>
                            <td class="text-center">1</td>
                            <td width="50%">pocari sewat</td>
                            <td class="text-center" >90000</td>
                            <td class="text-center" width="10%">90</td>
                            <td class="text-center">90000</td>
                        </tr>
                        <tr>
                            <td class="text-center">1</td>
                            <td width="50%">pocari sewat</td>
                            <td class="text-center" >90000</td>
                            <td class="text-center" width="10%">90</td>
                            <td class="text-center">90000</td>
                        </tr>

                        <tr class="text-center">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Sub Total</td>
                            <td><b>20000</b></td>
                        </tr>
                        <tr class="text-center">
                            <td style="border: none"></td>
                            <td style="border: none"></td>
                            <td > Diskon &nbsp;&nbsp;10%</td>
                            <td ><b>TOTAL</b></td>
                            <td>Rp 300000</td>
                        </tr>
                        <tr class="text-center">
                            <td style="border: none"></td>
                            <td style="border: none"></td>
                            <td ></td>
                            <td>Uang Muka</td>
                            <td>Rp 300000</td>
                        </tr>
                        <tr class="text-center">
                            <td style="border: none"></td>
                            <td style="border: none"></td>
                            <td style="border: none"></td>
                            <td>Piutang</td>
                            <td>Rp 300000</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                Status : <span><b><i>UTANG</i></b></span>
            </div>
            <div class="col-lg-4">
                <p>Hormat Kami,</p>
                <br><br>
                <b>Nama Kasir</b>
            </div>
        </div>
    </div>
</body>

</html>
