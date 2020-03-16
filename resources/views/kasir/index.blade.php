<!DOCTYPE html>
<html lang="en">
    @php
    use App\Application;
    $app = Application::first();
    @endphp
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <!-- App Desc -->
    <meta name="description" content="Halaman Login" />
    <meta name="author" content="tukangkode.id" />
    <title>Kasir | {{$app->nama}}</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('/img/favico.png')}}" type="image/x-icon" />
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet" />
    <!-- Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" />
    <link rel="stylesheet" href="https://unpkg.com/@coreui/icons@1.0.0/css/all.min.css" />
    <!-- CSS -->
    <link rel="stylesheet" href="https://unpkg.com/@coreui/coreui@3.0.0-rc.0/dist/css/coreui.min.css">
    <!--
            [if lt IE 9]>
                <script src="http://css3-mediaqueries-js.googlecode.com/files/css3-mediaqueries.js"></script>
                <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
            <![endif]
    -->
    <style>
        html{
            position: relative;
            min-height: 100%;
        }
        body {
            height: 100%;
            overflow: hidden;
            background-color: rgb(235, 235, 235);
            font-family: 'Lato', sans-serif;
            font-weight: 400;
            font-size: 14px;
            margin-bottom: 40px;
        }

        .c-header-dark {
            background-color: rgb(31, 40, 51) !important;
        }

        .c-footer{
            position: absolute;
            color: #1f2833;
            font-size: 12px;
            bottom: 0;
            width: 100%;
            height: 40px;
            line-height: 40px;
            background-color: rgb(197, 198, 199)
        }

        .tombol-kasir input,
        .tombol-kasir button {
            height: 115px;
            font-size: 22px;
            text-align: center;
        }

        .border-full {
            border-top: 1px solid #000 !important;
            border-bottom: 1px solid #000 !important;
        }

        .border-atas {
            border-top: 1px solid #000 !important;
        }

        .border-bawah {
            border-bottom: 1px solid #000 !important;
        }

        .border-kanan-kiri {
            border-radius: 0 !important;
            border-right: none !important;
            border-left: none !important;
        }

        .border-kanan {
            border-top-right-radius: 0 !important;
            border-bottom-right-radius: 0 !important;
            border-right: none !important;
        }

        .border-kiri {
            border-top-left-radius: 0 !important;
            border-bottom-left-radius: 0 !important;
            border-left: none !important;
        }

        .tombol-aksi {
            width: 70px;
            color: #fff;
        }

        .scrollable {
            height: 165px !important;
            overflow-y: scroll !important
        }

        .scrollable-list {
            max-height: 150px !important;
            overflow-y: scroll !important
        }
        .btn-warning:hover{
            color: #fff
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="c-header c-sticky-top c-header-dark px-3">
        <a class="c-header-brand" href="#">
            <img src="{{asset('/uploads/'.$app->logo)}}" height="30px" alt="Nama Aplikasi">
        </a>
        <div class="c-header-nav ml-auto">
            <span class="c-header-nav-item text-light">Selamat datang,</span>
            <a class="c-header-nav-item c-header-nav-link" href="#">{{auth()->user()->employee->nama}}</a>
            <div class="c-header-nav-item c-header-nav-link">
                <img class="rounded-circle" src="{{asset("/uploads/".auth()->user()->employee->foto)}}" height="40px" alt="Avatar">
            </div>
            <a class="c-header-nav-item c-header-nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();"><i class="fas fa-power-off"></i></a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </header>
    <!-- End of header -->
    <!-- Section Kasir -->
    <!-- Row 1 -->
    <div class="row col-md-12 mx-0 mb-3 mt-4">
        <!-- Nota -->
        <div class="col-md-2 border rounded bg-white border-kanan">
            <div class="form-group mt-3">
                <label for="">Nota Kas</label>
                <input type="text" id="nonotakas" class="form-control" disabled value="{{$formatnnk}}">
            </div>
            <div class="form-group">
                <label for="">Tanggal</label>
                <input type="text" class="form-control" disabled value="{{\Carbon\Carbon::now()->format('d F Y | H:i:s').' WIB' }}">
            </div>
        </div>
        <!-- Pelanggan -->
        <div class="col-md-2 border rounded bg-white border-kanan-kiri ">
            <div class="form-group mt-3">
                <label for="">Nama Pelanggan</label>
                <div class="input-group">
                    <input type="text" id="searchpelanggan" class="form-control" placeholder="Nama pelanggan">
                    <div class="position-absolute scrollable-list card" style="z-index:999;margin-top:40px;border:none;width:90%">
                        <div class="list-group list-group-flush position-relative" id="list-pelanggan">
                        </div>
                    </div>
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button" id="tambahpelanggan" >
                            <i class="fas fa-plus my-0"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="">Telepon</label>
                <input id="teleponpelanggan" type="text" class="form-control" disabled >
            </div>
        </div>
        <div class="col-md-4 border rounded bg-white pl-0 border-kanan-kiri">
            <div class="form-group mt-3">
                <label for="">Alamat</label>
                <textarea class="form-control" rows="5" disabled id="alamatpelanggan"></textarea>
            </div>
        </div>
        <!-- Tombol -->
        <form class="col-md-4 border rounded bg-white border-kiri">
            <div class="form-row">
                <div class="form-group col-md-6 mt-3 tombol-kasir">
                    <label for="">TOTAL</label>
                    <input type="text" class="form-control font-weight-bold" disabled id="totalan" placeholder="Rp 0,-">
                </div>
                <div class="form-group col-md-6 mt-3 tombol-kasir">
                    <label class="text-white">Cetak Nota</label>
                    <button id="cetaknota" type="button" class="btn btn-primary btn-block font-weight-bold" disabled>Cetak Nota</button>
                </div>
            </div>
        </form>
    </div>
    <!-- End of row 1 -->
    <!-- Row 2 -->
    <div class="row col-md-12 mx-0">
        <!-- Group 01 -->
        <div class="col-md-10 border rounded bg-white px-3 border-kanan">
            <!-- Input barang -->
            <div class="row pt-2 mx-0">
                <table class="table table-sm table-borderless">
                    <tbody>
                        <tr>
                            <td width="4%"></td>
                            <td width="15%">
                                <label for="">Kode</label>
                                <input id="kodebarang" type="text" class="form-control" disabled placeholder="IK001">
                            </td>
                            <td width="32%">
                                <label for="">Nama Barang</label>
                                <input disabled type="text" id="searchbarang" class="form-control" placeholder="Nama barang">
                                <div class="position-absolute list-group-flush card scrollable-list" style="z-index:999; width:32%">
                                    <div class="list-group position-relative" id="list-barang">
                                    </div>
                                </div>
                            </td>
                            <td width="15%">
                                <label for="">Harga</label>
                                <input type="text" id="hargabarang" class="form-control" disabled placeholder="Rp 0,-">
                            </td>
                            <td width="9%">
                                <label for="">Qty (Kg)</label>
                                <input type="number" id="qtybarang" step="0.01" class="form-control" placeholder="0">
                            </td>
                            <td width="15%">
                                <label for="">Jumlah</label>
                                <input type="text" id="jumlahbarang" class="form-control" disabled placeholder="Rp 0,-">
                            </td>
                            <td width="10%" style="padding-top: 33px;">
                                <button id="tambahbarang" type="button" class="btn btn-primary tombol-aksi" disabled>
                                    <i class="fas fa-plus my-0"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- Daftar Barang -->
            <!-- Table head -->
            <div class="row mx-0">
                <table class="table table-borderless my-0">
                    <thead>
                        <tr class="border-atas border-bawah">
                            <th width="4%" class="text-center">No</th>
                            <th width="15%" class="text-center">Kode</th>
                            <th width="31%" class="text-center">Nama Barang</th>
                            <th width="14%" class="text-center">Harga</th>
                            <th width="9%" class="text-center">Qty (Kg)</th>
                            <th width="17%" colspan="2" class="text-center">Jumlah</th>
                            <th width="10%" class="text-center">Aksi</th>
                        </tr>
                        <tr>
                            <td class="py-1"></td>
                        </tr>
                    </thead>
                </table>
            </div>
            <!-- Table body -->
            <div class="row mx-0" id="tableBarang" style="height: 165px; overflow-y: scroll;">
                <table class="table my-0">
                    <tbody>
                    </tbody>
                </table>
            </div>
            <!-- Table foot -->
            <div class="row mx-0">
                <table class="table table-borderless">
                    <tfoot>
                        <tr>
                            <td width="4%" class="border-atas"></td>
                            <td width="15%" class="border-atas"></td>
                            <td width="30%" class="border-atas"></td>
                            <td width="14%" class="border-atas"></td>
                            <td width="9%" class="text-right border-full">Sub Total</td>
                            <td width="3%" class="text-right border-full">Rp</td>
                            <td width="14%" class="text-right border-full"><span id="subtotal" class="">0</span>,-</td>
                            <td width="11%" class="border-atas"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td width="14%" class="text-right py-2 border-full">
                                Diskon <span><input disabled type="text" name="" id="diskon" class="form-control form-control-sm d-inline" style="width:50px">
                                    %</span>
                            </td>
                            <td class="text-right border-full"><strong>TOTAL</strong></td>
                            <td class="text-right border-full"><strong>Rp</strong></td>
                            <td class="text-right border-full"><strong><span class=" totalpembayaran">0</span>,-</strong></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <!-- Group 02 -->
        <div class="col-md-2 border rounded bg-white border-kiri">
            <div class="form-group mt-3">
                <label for="">Uang Muka</label>
                <input id="uangmuka" type="text"  class="form-control" value="Rp 0,-">
            </div>
            <div class="form-group">
                <label for="">Uang Kembali</label>
                <input id="uangkembali" type="text" class="form-control" disabled placeholder="Rp 0,-">
            </div>
            <div class="form-group">
                <label for="">Status</label>
                <input id="status" type="text" class="form-control" disabled placeholder="LUNAS">
            </div>
            <div class="form-group">
                <label for="">Kasir</label>
                <input type="text" class="form-control" disabled value="{{auth()->user()->employee->nama}}">
            </div>
            <br>
            <div class="my-3">
                <button type="button" class="btn btn-danger btn-block font-weight-bold">Reset</button>
            </div>
        </div>
    </div>
    <!-- End of row 2 -->
    <!-- End of section kasir -->

    <footer class="c-footer">
        <p class="mx-auto">
            &copy; 2020-{{now()->year}} | Develop with
            <span style="color:#b71c1c"> <i class="fas fa-heart"></i> </span>
            by
            <a href=""><img src="{{asset('img/logo-dev.png')}}" alt="Logo" height="12px"></a>
        </p>
    </footer>
    <!-- Modal pelanggan -->
    <div class="modal fade" id="pelangganModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Menambahkan Pelanggan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="form-add-pelanggan">
                        {{ csrf_field() }}
                        <input type="hidden" name="branch_id" value="{{$branch->id}}">
                        <div class="form-group">
                            <label for="addnamapelanggan" class="col-form-label">Nama</label>
                            <input type="text" class="form-control" id="addnamapelanggan" name="nama" placeholder="Nama pelanggan">
                        </div>
                        <div class="form-group">
                            <label for="addteleponpelanggan" class="col-form-label">Telepon</label>
                            <input type="text" class="form-control" id="addteleponpelanggan" name="telepon" placeholder="Nomor telepon">
                        </div>
                        <div class="form-group">
                            <label for="addalamatpelanggan" class="col-form-label">Alamat</label>
                            <textarea class="form-control" id="addalamatpelanggan" name="alamat" placeholder="Alamat Pelanggan"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" id="add" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    <script src="/adminlte/plugins/jquery/jquery.min.js"></script>
    <!-- End of modal pelanggan -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.15.0/umd/popper.min.js"></script>
    <script src="https://unpkg.com/@coreui/coreui@3.0.0-rc.0/dist/js/coreui.min.js"></script>
    <!-- jQuery -->
    <script src="/adminlte/plugins/number-divider.min.js"></script>
    <script src="/adminlte/plugins/sweetalert.min.js"></script>
    <script>

        // =================== NUMBER FORMAT DIVIDER

        $(function() {

            // Number Divide
            $("#inputharga").divide({
                delimiter: '.',
                divideThousand: true
            });

            // Cegah Paid Amount Diisi dengan Huruf
            $(".inputharga").on('keypress', function(keys) {
                if (keys.keyCode > 31 && (keys.keyCode < 48 || keys.keyCode > 57)) {
                    keys.preventDefault();
                }
            });
        });

        function numberformat(){
            $(".harga").divide({
                delimiter: '.',
                divideThousand: true
            });
        }
        // ==================END FORMAT

        // PART  PELANGGAN

        let pelanggan ={}

        function getpelanggan(id) {
            let url = "{{ route('pelanggan.data') }}"
            const containerlist = $('#list-pelanggan')
            containerlist.html('')

            $.ajax({
                type: 'get',
                url: url,
                data: {
                    'id': id,
                },
                success: function(data) {
                    $('#alamatpelanggan').val(data.customer.alamat)
                    $('#teleponpelanggan').val(data.customer.telepon)
                    $('#searchpelanggan').val(data.customer.nama)

                    $('#idpelanggan').val(data.customer.id)
                    $('#searchbarang').removeAttr('disabled')

                    pelanggan = {
                        id:data.customer.id,
                        nama:data.customer.nama,
                        telepon:data.customer.telepon,
                        alamat:data.customer.alamat
                    }
                },
            });
        }


        $("#searchpelanggan").keyup(function() {
            let keyword = $(this).val()
            let url = "{{ route('pelanggan.datajson') }}"
            const containerlist = $('#list-pelanggan')
            containerlist.html('')
            if (keyword != '') {
                $.ajax({
                    type: 'get',
                    url: url,
                    data: {
                        'keyword': keyword,
                    },
                    success: function(data) {
                        containerlist.html('')
                        if (data.length != 0) {
                            var list = data.map((item) => {
                                return `<li class="list-group-item list-group-item-action" onclick="getpelanggan('${item.id}')">${item.nama}</li>`
                            })
                            list.forEach((item) => {
                                containerlist.append(item)
                            })
                        } else {
                            containerlist.append(`<li class="list-group-item" >Pelanggan tidak ditemukan</li>`)
                        }



                    },
                });
            }
        });

        // $("#searchpelanggan").focus(function() {

        //     let keyword = $(this).val()
        //     let url = "{{ route('pelanggan.datajson') }}"
        //     const containerlist = $('#list-pelanggan')
        //     containerlist.html('')
        //     $.ajax({
        //         type: 'get',
        //         url: url,
        //         data: {
        //             'keyword': keyword,
        //         },
        //         success: function(data) {
        //             var list = data.map((item) => {
        //                 return `<li class="list-group-item list-group-item-action" onclick="getpelanggan('${item.id}')">${item.nama}</li>`
        //             })
        //             list.forEach((item) => {
        //                 containerlist.append(item)
        //             })

        //         },
        //     });
        // })

        $(document).on('click', '#tambahpelanggan', function() {
            $('#pelangganModal').modal('show');
            $('#addnamapelanggan').val('')
            $('#addalamatpelanggan').val('')
            $('#addteleponpelanggan').val('')
        });

        $('.modal-footer').on('click', '#add', function() {
            $('#add').attr('disabled', true)
            $.ajax({
                type: 'POST',
                url: "{{ route('kasir.pelanggan.simpan') }}",
                data: new FormData($("#form-add-pelanggan")[0]),
                processData: false,
                contentType: false,
                success: function(data) {
                    $('#pelangganModal').modal('hide');
                    $('#searchpelanggan').val(data.customer.nama)
                    $('#alamatpelanggan').html(data.customer.alamat)
                    $('#teleponpelanggan').val(data.customer.telepon)

                    $('#searchbarang').removeAttr('disabled')

                    pelanggan = {
                        id:data.customer.id,
                        nama:data.customer.nama,
                        telepon:data.customer.telepon,
                        alamat:data.customer.alamat
                    }
                },
            });

        });
        // ====== END PART PELANGGAN ====

    // ======= PART  BARANG =======

    let barang = {}

    function getbarang(id) {
        let url = "{{ route('stok.data') }}"
        const containerlist = $('#list-barang')
        containerlist.html('')

        $.ajax({
            type: 'get',
            url: url,
            data: {
                'id': id,
            },
            success: function(data) {
                $('#kodebarang').val(data.supply.id)
                $('#hargabarang').val('Rp '+data.supply.harga_cabang.toLocaleString(['ban', 'id'])+',-')
                $("#qtybarang").removeAttr('disabled')
                $("#tambahbarang").removeAttr('disabled')
                $("#searchbarang").val(data.supply.item.nama)
                $('#stok').val(data.supply.stok);
                numberformat();

                barang = {
                    id: data.supply.id,
                    nama:data.supply.item.nama,
                    stok:data.supply.stok,
                    harga_cabang:data.supply.harga_cabang,
                }
            },
        });
    }

    $("#searchbarang").keyup(function() {
        let keyword = $(this).val()
        let url = "{{ route('barang.datajson') }}"
        const containerlist = $('#list-barang')
        containerlist.html('')
        if (keyword != '') {
            $.ajax({
                type: 'get',
                url: url,
                data: {
                    'keyword': keyword,
                },
                success: function(data) {
                    containerlist.html('')
                    if (data.length != 0) {
                        var list = data.map((item) => {
                            return `<li class="list-group-item list-group-item-action" onclick="getbarang('${item.id}')">${item.nama}</li>`
                        })
                        list.forEach((item) => {
                            containerlist.append(item)
                        })
                    } else {
                        containerlist.append(`<li class="list-group-item">Barang tidak ditemukan</li>`)
                    }



                },
            });
        }
    });
    // $("#searchbarang").focus(function() {
    //     let keyword = $(this).val()
    //     let url = "{{ route('barang.datajson') }}"
    //     const containerlist = $('#list-barang')
    //     containerlist.html('')
    //     $.ajax({
    //         type: 'get',
    //         url: url,
    //         data: {
    //             'keyword': keyword,
    //         },
    //         success: function(data) {
    //             var list = data.map((item) => {
    //                 return `<li class="list-group-item list-group-item-action" onclick="getbarang('${item.id}')">${item.nama}</li>`
    //             })
    //             list.forEach((item) => {
    //                 containerlist.append(item)
    //             })

    //         },
    //     });
    // });
    // $( "#searchbarang" ).focusout(function(){
    //     const containerlist = $('#list-barang')
    //     containerlist.html('')

    // })

    //======== END PART BARANG ===========

    //======== PART KASIR ============

    let arrayBarang = new Array;

    // variabel barang selected
    let qty = 0
    let jumlah = 0;

    // Variabel Nota Pembelian
    let totalPembayaran = 0;
    let subTotalPembayaran = 0;
    let totalDiskon = 0;
    let diskon = 0;
    let uangkembalian = 0;
    let uangMuka = 0;

    $("#qtybarang").keyup(function() {
        let harga = barang.harga_cabang
        qty = $(this).val()
        jumlah = Math.round(harga * qty)
        text = jumlah.toLocaleString(['ban', 'id'])
        $("#jumlahbarang").val('Rp '+text)
    });

    $(document).on('click', '#tambahbarang', function() {
        if ($('#qtybarang').val() != 0) {
            if (parseInt(barang.stok)< parseInt($('#qtybarang').val())) {
                alert(`nilai kuantitas melebihi stok yang tersedia yaitu ${barang.stok} Kg`)
                $("#qtybarang").val('')
                $("#jumlahbarang").val(0)
            } else {
                arrayBarang.push({
                    id:barang.id,
                    nama:barang.nama,
                    harga:barang.harga_cabang,
                    qty:qty,
                    total:jumlah,
                })
                refreshDataTableBarang();
                tambahTotalPembayaran();
                uangkembali()
                hitungdiskon();
                checkStatus();
                showNominal();
                numberformat();

                $("#qtybarang").val('')
                $("#kodebarang").val('')
                $("#hargabarang").val('')
                $("#searchbarang").val('')
                $("#jumlahbarang").val(0)
                $('#diskon').removeAttr('disabled')
                $("#cetaknota").removeAttr('disabled')

                barang = {}
                $("#tambahbarang").attr('disabled','disabled')
            }
        } else {
            alert("masukkan jumlah Kuantitas barang Terlebih Dahulu")
        }



    });

    function tambahTotalPembayaran() {
        totalPembayaran+=jumlah
        subTotalPembayaran+=jumlah
    }

    function kurangTotalPembayaran(nominal) {
        subTotalPembayaran= subTotalPembayaran - nominal;
        if (subTotalPembayaran == 0) {
            totalPembayaran = 0;
        } else {
            totalPembayaran = totalPembayaran - nominal;
        }
    }

    function uangkembali() {
        uangkembalian = uangMuka - totalPembayaran
    }

    function hitungdiskon() {
        const diskon = $('#diskon').val()
        if (subTotalPembayaran == 0) {
            totalDiskon = 0;
        } else {
            totalDiskon = Math.round((subTotalPembayaran * diskon) / 100)
            totalPembayaran = subTotalPembayaran - totalDiskon
        }

    }



    function checkStatus() {
        if (uangkembalian < 0) {
            $('#status').val("PIUTANG")
        } else {
            $('#status').val("LUNAS")
        }
    }

    function showNominal(){
        $("#subtotal").html(subTotalPembayaran.toLocaleString(['ban', 'id']))
        $('#uangkembali').val('Rp '+uangkembalian.toLocaleString(['ban', 'id'])+',-')
        $(".totalpembayaran").html(totalPembayaran.toLocaleString(['ban', 'id']))
        $("#totalan").val('Rp '+totalPembayaran.toLocaleString(['ban', 'id'])+',-')
        numberformat()
    }

    $("#uangmuka").focusin(()=>{
        // let uang = $("#uangmuka").val()
        // uang = uang.split(" ")
        // uang = uang[1].split(",")[0]
        $("#uangmuka").val(uangMuka)
    })

    $("#uangmuka").focusout(()=>{
        // uang = "Rp "+uang.toLocaleString(['ban', 'id'])+",-"
        $("#uangmuka").val('Rp '+uangMuka.toLocaleString(['ban', 'id'])+',-')
    })

    $("#uangmuka").keyup(function(keys) {
        uangMuka = parseInt($(this).val())

        if (!(uangMuka)) {
            uangMuka =0
            uangkembali();
            showNominal();
        } else {
            uangkembali();
            showNominal();
        }
        checkStatus()
    });

    $("#diskon").keyup(function() {
        diskon = $(this).val()
        hitungdiskon();
        uangkembali();
        showNominal();
    });

    function refreshDataTableBarang() {
        const $findRow = $('#tableBarang tbody tr');
        $findRow.remove();
        const table = $('#tableBarang tbody')
        var list = arrayBarang.map((item,key) => {
                    return '<tr data-id=' + key + '>\
                                    <td width="4%" class="text-center">' + (key+1) + '</td>\
                                    <td width="15%" class="text-center">' + item.id + '</td>\
                                    <td width="31%">' + item.nama + '</td>\
                                    <td width="14%" class="text-center">Rp <span class="harga">' + item.harga + '</span>,-</td>\
                                    <td width="9%" class="text-center">' + item.qty + '</td>\
                                    <td width="3%" class="text-right">Rp</td>\
                                    <td width="14%" class="text-right"><span class="">' + item.total.toLocaleString(['ban', 'id']) + '</span>,-</td>\
                                    <td width="10%" class="py-1" style="padding-left: 20px;">\
                                        <button type="button"  class="btn btn-warning tombol-aksi delete-barang" data-id=' +
                key + '><i class="fa fa-trash"></a>\
                                    </td>\
                                </tr>'
                })
        list.push('                        <tr>\
                            <td class="py-1"></td>\
                            <td class="py-1"></td>\
                            <td class="py-1"></td>\
                            <td class="py-1"></td>\
                            <td class="py-1"></td>\
                            <td class="py-1"></td>\
                            <td class="py-1"></td>\
                            <td class="py-1"></td>\
                        </tr>')
        list.forEach((item) => {
            table.append(item)
        })
    }

    $('#tableBarang tbody').on('click', '.delete-barang', function(e) {
        const id = $(this).data('id')
        removeRow(id)
        uangkembali();
        refreshDataTableBarang()
        hitungdiskon();
        checklastrow();
        showNominal();
        checkStatus();
    });

    function removeRow(id) {
        const removeBarang = arrayBarang[id];
        kurangTotalPembayaran(removeBarang.total)
        arrayBarang.splice(id, 1);
    }

    function checklastrow(){
        if (arrayBarang.length == 0) {
            $('#cetaknota').addClass('disabled')
        }
    }





    $(document).on('click', '#cetaknota', function() {
        const total_nota = totalPembayaran
        let diskon = $('#diskon').val();
        if (!diskon) {
            diskon = 0
        }
        const jumlah_uang_nota = uangMuka
        const kembalian_nota = uangkembalian
        const status = $('#status').val()
        const customer_id = pelanggan.id
        const no_nota_kas = $('#nonotakas').val();

        var items = arrayBarang.map((item,key)=>{
                return {
                    no_urut:key+1,
                    supply_id:item.id,
                    kuantitas:item.qty,
                    total_harga:item.total
                    }
        })

        // const $lastRow = $('table tbody tr:last');
        // const lastNo = $lastRow.find('td').eq(0).text();
        // for (let index = 1; index <= lastNo; index++) {
        //     const $findRow = $('table tbody tr[data-id="' + index + '"]');
        //     const no_urut = $findRow.find('td').eq(0).text()
        //     const supply_id = $findRow.find('td').eq(1).text()
        //     const kuantitas = $findRow.find('td').eq(4).text()
        //     const total_harga = $findRow.find('td').eq(5).text()
        //     items.push({
        //         no_urut,
        //         supply_id,
        //         kuantitas,
        //         total_harga
        //     })
        // }



        var data = {
            total_nota,
            diskon,
            jumlah_uang_nota,
            kembalian_nota,
            status,
            customer_id,
            no_nota_kas,
            items
        }
        console.log(data);

        const url = "{{ route('kasir.simpan.nota') }}"
        $.ajax({
            type: 'get',
            url: url,
            data: {
                data
            },
            success: function(data) {
                const printurl = `kasir/cetaknota/${data.data.id}`
                window.open(printurl, '_blank');
                if (data.status) {
                    swal({
                            title: "Berhasil Menambahkan Transaksi",
                            text: "",
                            icon: "success",
                        })
                        .then(function() {
                            location.reload()
                        });
                }

            },
        });

    });
    </script>
</body>
</html>
