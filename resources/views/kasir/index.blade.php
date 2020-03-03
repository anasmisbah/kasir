@extends('layouts.kasir')

@push('css')
<style>
    .scrollable {
        height: 165px !important;
        overflow-y: scroll !important
    }

    .scrollable-list {
        max-height: 150px !important;
        overflow-y: scroll !important
    }
    .small{
        margin-left: 0rem;
    }

    @media (width:1030px){
        .small{
            margin-left: 0.5rem;
        }
    }
    .form-control.btnadd{
        width: 80%;
    }
    .row.kasir{
        margin-top: 100px;
    }
    .col-4.barang{
        max-width: 30%;
    }
    table thead tr th{
        border-top: 1px solid black !important;
        border-bottom: 1px solid black !important;
    }
    .border-atas{
        border-top: 1px solid black !important;
    }
    .borderan {
        border-top: 1px solid black !important;
        border-bottom: 1px solid black !important;
    }
</style>
@endpush

@section('content')
<div class="container-fluid pt-2">
    <div class="card border-0">
        <div class="card-body">
    <div class="row">
        <div class="col-2 border rounded mr-2 pb-2" style="background-color: #f5f6fa" >
            <div class="row">
                <div class="col-12">
                    <label for="">No Nota Kas</label>
                    <input id="nonotakas" class="form-control form-control-sm" disabled type="text" value="{{$formatnnk}}">
                </div>
                <div class="col-12 mt-3">
                    <label for="">Tanggal</label>
                    <input value="{{ \Carbon\Carbon::now()->format('d F Y') }}" class="form-control form-control-sm" disabled type="text">
                </div>
            </div>
        </div>
        <div class="col-6 border rounded mr-2" style="background-color: #f5f6fa">
            <div class="row">
                <div class="col-5">
                    <div class="form-group-sm">
                        <input type="hidden" id="idpelanggan">
                        <label for="">Nama Pelanggan</label> <br>
                        <input type="text" name="" id="searchpelanggan" class="form-control form-control-sm d-inline" placeholder="Masukkan Nama Pelanggan" style="width:80%" id="">
                        <div class="position-absolute scrollable-list" style="z-index:999; width:77%">
                            <div class="list-group position-relative" id="list-pelanggan">
                            </div>
                        </div>
                        <button class="btn-sm btn-primary create-modal d-inline" id="tambahpelanggan"><i class="fa fa-plus"></i></button>
                    </div>
                    <div class="form-group-sm mt-3">
                        <label for="">Telepon</label>
                        <input id="teleponpelanggan" class="form-control form-control-sm" style="width:80%" disabled type="text">
                    </div>
                </div>
                <div class="col-7">
                    <label for="">Alamat</label>
                    <div class="rounded p-2 border" style="background-color:#e8ecef; height:78%">
                        <p id="alamatpelanggan"></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3 mr-2 pr-2 " style="max-width:17.5%" >
            <label for="">TOTAL</label>
            <div class="border rounded text-center" style="background-color: #f5f6fa; height:75%;padding-top:2.5rem;">
                <span class="text-bold text-center pb-4"  style="font-size:20px !important">Rp <span class="inputharga harga jml">0</span>,-</span>
            </div>
        </div>
        <div class="col-2 pb-2 " style="max-width:13%;padding-top:1.8rem">
        <!-- <div class="col-2 border rounded" style="padding-top: 50px; padding-bottom:35px"> -->
            <a href="#" id="cetaknota" class=" text-bold disabled btn btn-primary btn-lg btn-cetak" style="width:100%; height:100%; padding-top:2.5rem;font-size:20px !important">Cetak Nota</a>
        </div>
    </div>
    <div class="row kasir">
        <div class="col-11" style="max-width:85%">
            <div class="row">
                <div class="col-12">
                    <div class="form">
                        <div class="row ">
                            <div class="col-3" style="max-width:20%">
                                <div class="form-group" style="margin-left:4rem">
                                    <label for="">Kode</label>
                                    <input id="kodebarang" type="text" disabled id="kode" class="form-control form-control-sm " style="width:100%">
                                </div>
                            </div>
                            <div class="col-4 barang">
                                <div class="form-group">
                                    <label for="">Nama Barang</label>
                                    <input type="text" disabled name="" id="searchbarang" class="form-control form-control-sm d-inline" placeholder="Masukkan Nama Barang" style="width:100%" id="">
                                    <div class="position-absolute scrollable-list" style="z-index:999; width:97%">
                                        <div class="list-group position-relative" id="list-barang">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2" style="width: 20%">
                                <div class="form-group">
                                    <label for="">Harga</label>
                                    <input type="text" id="hargabarang" disabled id="harga" value="0" class="form-control form-control-sm inputharga harga">
                                </div>
                            </div>
                            <div class="col-1" >
                                <div class="form-group">
                                    <label for="">Qty</label>
                                    <input type="hidden" id="stok">
                                    <input id="qtybarang" type="number" step="0.01" disabled id="qty" placeholder="0" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="">Jumlah</label>
                                    <input id="jumlahbarang" type="text" disabled value="0" id="jumlah" class="form-control form-control-sm inputharga harga">
                                </div>
                            </div>
                            <div class="col-lg-1 small" >
                                <div class="form-group" style="margin-top:30px;margin-left:30px">
                                    <button disabled type="button" id="tambahbarang" class="btn-sm btn-primary form-control btnadd form-control-sm" >
                                        <i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row mt-1">
                <div class="col-12 pb-0" style="height:30px">
                    <div class="table-wrapper-scroll-y my-custom-scrollbar">
                        <table class="table table-sm"  id="tableBarang">
                            <thead>
                                <tr class="text-center">
                                    <th  style="width: 5%">No</th>
                                    <th  style="width: 10%">Kode</th>
                                    <th  style="width: 30%">Nama Barang</th>
                                    <th  style="width: 20%">Harga</th>
                                    <th  style="width: 10%">Qty (Kg)</th>
                                    <th  style="width: 20%">Jumlah</th>
                                    <th  style="width: 5%">Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <section class="scrollable">
                        <table class="table table-sm text-center" id="tableBarang">
                            <tbody>
                            </tbody>
                        </table>
                    </section>
                </div>
            </div>
            <div class="row mt-1">
                <div class="col-12">
                    <div class="table-wrapper-scroll-y my-custom-scrollbar">
                        <table class="table table-sm" id="tableBarang">
                            <tfoot>
                                <tr>
                                    <td  style="width: 5%"  class="border-atas"></td>
                                    <td  style="width: 10%" class="border-atas"></td>
                                    <td  style="width: 30%" class="border-atas"></td>
                                    <td  style="width: 20%" class="border-atas"></td>
                                    <td  style="width: 10%" class="border-atas text-center"> Sub Total</td>
                                    <td  style="width: 20%" class="border-atas text-right">Rp <span id="total" class="inputharga harga">0</span>,-
                                    </td>
                                    <td  style="width: 5%" class="border-atas"></td>
                                </tr>
                                <tr>
                                    <td  style="border: none;width: 5%"></td>
                                    <td  style="border: none;width: 10%"></td>
                                    <td  style="border: none;width: 30%"></td>
                                    <td style="border:none;width: 20%" class="text-right pr-2">
                                        Diskon (%) <span><input type="text" name="" id="diskon" class="form-control form-control-sm d-inline" disabled style="width:50px"></span>
                                    </td>
                                    <td  style="width: 10%" class="borderan text-bold text-center">TOTAL</td>
                                    <td style="width: 20%" class="borderan text-bold text-right">Rp <span id="total" class="inputharga harga jml">0</span>,-
                                    </td>
                                    <td  style="border: none;width: 5%"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-2 ml-3" style="max-width:13%" >
            <div class="form-group">
                <label for="">Uang muka</label>
                <input id="uangmuka" type="text" value="0" placeholder="0" class="form-control form-control-sm ">
            </div>
            <div class="form-group">
                <label for="">Uang kembali</label>
                <input id="uangkembali" type="text" value="0" disabled class="form-control form-control-sm harga">
            </div>
            <div class="form-group">
                <label for="">Status</label>
                <input id="status" type="text" disabled class="form-control form-control-sm">
            </div>
            <div class="form-group">
                <label for="">Kasir</label>
                <input type="text" value="{{auth()->user()->employee->nama}}" disabled class="form-control form-control-sm">
            </div>
            <div class="form-group mt-4">
                <a href="#" onClick="window.location.reload();" style="width:100%" class="btn btn-danger">Reset</a>
            </div>
        </div>
    </div>
</div>
</div>
</div>

{{-- Modal Tambah --}}
<div id="plus" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Membuat Pelanggan</h4>
            </div>
            <div class="modal-body">
                <div class="box-error" id="box_error_modal_plus"></div>
                <form action="" method="post" id="form-add-pelanggan" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="branch_id" value="{{$branch->id}}">
                    <div class="form-group row add">
                        <label class="control-label col-sm-2" for="date">Nama</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <input type="text" id="addnamapelanggan" class="form-control" id="nama" name="nama" placeholder="Nama Pelanggan">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row add">
                        <label class="control-label col-sm-2" for="date">Telepon</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <input type="text" id="addteleponpelanggan" class="form-control" id="telepon" name="telepon" placeholder="Nomor Telepon">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row add">
                        <label class="control-label col-sm-2" for="date">Alamat</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <input type="text" id="addalamatpelanggan" class="form-control" id="alamat" name="alamat" placeholder="Alamat Pelanggan">
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="submit" id="add">
                    <span class="glyphicon glyphicon-plus"></span> Tambah
                </button>
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Tutup
                </button>
            </div>
        </div>
    </div>
</div>
{{-- /modal tambah --}}
@endsection

@push('script')
<script src="/adminlte/plugins/number-divider.min.js"></script>
<script src="/adminlte/plugins/sweetalert.min.js"></script>
<script>
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
</script>
<script>
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
                $('#alamatpelanggan').html(data.customer.alamat)
                $('#teleponpelanggan').val(data.customer.telepon)
                $('#searchpelanggan').val(data.customer.nama)

                $('#idpelanggan').val(data.customer.id)
                $('#searchbarang').removeAttr('disabled')
            },
        });
    }


    $("#searchpelanggan").keyup(function() {
        let keyword = $(this).val()
        let url = "{{ route('pelanggan.datajson') }}"
        const containerlist = $('#list-pelanggan')
        containerlist.html('')
        $.ajax({
            type: 'get',
            url: url,
            data: {
                'keyword': keyword,
            },
            success: function(data) {
                var list = data.map((item) => {
                    return `<li class="list-group-item list-group-item-action" onclick="getpelanggan('${item.id}')">${item.nama}</li>`
                })
                list.forEach((item) => {
                    containerlist.append(item)
                })

            },
        });
    });
    // $( "#searchpelanggan" ).focusout(function(){
    //     const containerlist = $('#list-pelanggan')
    //     containerlist.html('')

    // })
    $("#searchpelanggan").focus(function() {
        let keyword = $(this).val()
        let url = "{{ route('pelanggan.datajson') }}"
        const containerlist = $('#list-pelanggan')
        containerlist.html('')
        $.ajax({
            type: 'get',
            url: url,
            data: {
                'keyword': keyword,
            },
            success: function(data) {
                var list = data.map((item) => {
                    return `<li class="list-group-item list-group-item-action" onclick="getpelanggan('${item.id}')">${item.nama}</li>`
                })
                list.forEach((item) => {
                    containerlist.append(item)
                })

            },
        });

    })

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
                $('#hargabarang').val(data.supply.harga_cabang)
                $("#qtybarang").removeAttr('disabled')
                $("#tambahbarang").removeAttr('disabled')
                $("#searchbarang").val(data.supply.item.nama)
                $('#stok').val(data.supply.stok);
                numberformat();
            },
        });
    }

    $("#searchbarang").keyup(function() {
        let keyword = $(this).val()
        let url = "{{ route('barang.datajson') }}"
        const containerlist = $('#list-barang')
        containerlist.html('')
        $.ajax({
            type: 'get',
            url: url,
            data: {
                'keyword': keyword,
            },
            success: function(data) {
                var list = data.map((item) => {
                    return `<li class="list-group-item list-group-item-action" onclick="getbarang('${item.id}')">${item.nama}</li>`
                })
                list.forEach((item) => {
                    containerlist.append(item)
                })

            },
        });
    });
    // $( "#searchbarang" ).focusout(function(){
    //     const containerlist = $('#list-barang')
    //     containerlist.html('')

    // })
    $("#searchbarang").focus(function() {
        let keyword = $(this).val()
        let url = "{{ route('barang.datajson') }}"
        const containerlist = $('#list-barang')
        containerlist.html('')
        $.ajax({
            type: 'get',
            url: url,
            data: {
                'keyword': keyword,
            },
            success: function(data) {

                var list = data.map((item) => {
                    return `<li class="list-group-item list-group-item-action" onclick="getbarang('${item.id}')">${item.nama}</li>`
                })
                list.forEach((item) => {
                    containerlist.append(item)
                })

            },
        });

    })



    $(document).on('click', '#tambahpelanggan', function() {
        $('#plus').modal('show');
        $('#addnamapelanggan').val('')
        $('#addalamatpelanggan').val('')
        $('#addteleponpelanggan').val('')
    });

    $(document).on('click', '#cetaknota', function() {
        const total_nota = $(".jml").html()
        let diskon = $('#diskon').val();
        if (!diskon) {
            diskon = 0
        }
        const jumlah_uang_nota = $('#uangmuka').val();
        const kembalian_nota = $('#uangkembali').val()
        const status = $('#status').val()
        const customer_id = $('#idpelanggan').val()
        const no_nota_kas = $('#nonotakas').val();


        var items = new Array

        const $lastRow = $('table tbody tr:last');
        const lastNo = $lastRow.find('td').eq(0).text();
        for (let index = 1; index <= lastNo; index++) {
            const $findRow = $('table tbody tr[data-id="' + index + '"]');
            const no_urut = $findRow.find('td').eq(0).text()
            const supply_id = $findRow.find('td').eq(1).text()
            const kuantitas = $findRow.find('td').eq(4).text()
            const total_harga = $findRow.find('td').eq(5).text()
            items.push({
                no_urut,
                supply_id,
                kuantitas,
                total_harga
            })
        }


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

    $('.modal-footer').on('click', '#add', function() {
        $('#add').attr('disabled', true)
        $.ajax({
            type: 'POST',
            url: "{{ route('kasir.pelanggan.simpan') }}",
            data: new FormData($("#form-add-pelanggan")[0]),
            processData: false,
            contentType: false,
            success: function(data) {
                $("#selectpelanggan").append(`<option value="${data.customer.id}">
                                       ${data.customer.nama}
                                  </option>`);
                $('#plus').modal('hide');
                $('#searchpelanggan').val(data.customer.nama)
                $('#alamatpelanggan').html(data.customer.alamat)
                $('#teleponpelanggan').val(data.customer.telepon)
                $("#cetaknota").removeClass('disabled')
            },
        });

    });

    $("#qtybarang").keyup(function() {
        let harga = $('#hargabarang').val()
        let qty = $(this).val()
        let total = harga * qty
        $("#jumlahbarang").val(total)
    });



    $(document).on('click', '#tambahbarang', function() {
        if ($('#qtybarang').val() != 0) {
            console.log();

            if (parseInt($('#stok').val())< parseInt($('#qtybarang').val())) {
                alert("nilai kuantitas melibihi stok yang tersedia")
                $("#qtybarang").val('')
                $("#jumlahbarang").val(0)
            } else {
                addNewRow();
                const total = $("#total").html()
                const jmlbarang = $('#jumlahbarang').val()
                const totalan = parseInt(total) + parseInt(jmlbarang)
                $("#total").html(totalan)

                const uangMuka = $("#uangmuka").val()
                uangkembali(uangMuka)

                $("#qtybarang").val('')
                $("#kodebarang").val('')
                $("#hargabarang").val('')
                $("#searchbarang").val('')
                $("#jumlahbarang").val(0)
                $('#diskon').removeAttr('disabled')
                $("#cetaknota").removeClass('disabled')
                hitungdiskon();
            }
        } else {
            alert("masukkan jumlah Kuantitas barang Terlebih Dahulu")
        }

        numberformat();


    });

    $('#tableBarang tbody').on('click', '.delete-barang', function(e) {
        const id = $(this).data('id')

        removeRow(id)
        hitungdiskon();
        const uangMuka = $("#uangmuka").val()
        uangkembali(uangMuka)

    });

    function addNewRow() {
        // ambil baris tabel terakhir
        const $lastRow = $('table tbody tr:last');
        const kodebarang = $('#kodebarang').val()
        const table = $('#tableBarang tbody')
        if ($lastRow.length == 0) {

            const markup = '<tr data-id=1>\
                                    <td style="width: 5%">1</td>\
                                    <td style="width: 10%">' + $('#kodebarang').val() + '</td>\
                                    <td style="width: 30%" class="text-left">' + $('#searchbarang').val() + '</td>\
                                    <td style="width: 20%" class="text-right">Rp <span class="harga">' + $('#hargabarang').val() + '</span>,-</td>\
                                    <td style="width: 10%">' + $('#qtybarang').val() + '</td>\
                                    <td style="width: 20%" class="text-right">Rp <span class="harga">' + $('#jumlahbarang').val() + '</span>,-</td>\
                                    <td style="width: 5%">\
                                        <button href="#"  class="btn btn-warning text-white btn-sm delete-barang" data-id=1><i class="fas fa-trash"></a>\
                                    </td>\
                                </tr>'
            table.prepend(markup);
        } else {
            const $cloneRow = $lastRow.clone();
            const lastNo = $cloneRow.find('td').eq(0).text();
            const markup = '<tr data-id=' + (parseInt(lastNo) + 1) + '>\
                                    <td style="width: 5%">' + (parseInt(lastNo) + 1) + '</td>\
                                    <td style="width: 10%">' + $('#kodebarang').val() + '</td>\
                                    <td style="width: 30%" class="text-left">' + $('#searchbarang').val() + '</td>\
                                    <td style="width: 20%" class="text-right">Rp <span class="harga">' + $('#hargabarang').val() + '</span>,-</td>\
                                    <td style="width: 10%">' + $('#qtybarang').val() + '</td>\
                                    <td style="width: 20%" class="text-right">Rp <span class="harga">' + $('#jumlahbarang').val() + '</span>,-</td>\
                                    <td style="width: 5%">\
                                        <button href="#"  class="btn btn-warning text-white btn-sm delete-barang" data-id=' +
                (parseInt(lastNo) + 1) + '><i class="fas fa-trash"></a>\
                                    </td>\
                                </tr>'
            table.append(markup);

        }
    }

    function removeRow(id) {
        const $findRow = $('table tbody tr[data-id="' + id + '"]');
        const total = $("#total").html()
        const jmlbarang = $findRow.find('td').eq(5).text()
        const totalan = parseInt(total) - parseInt(jmlbarang)
        $("#total").html(totalan)



        $findRow.remove();
        checklastrow();
    }

    function checklastrow(){
        const lastRow = $('table tbody tr:last');
        if (!(lastRow.length)) {
            console.log(lastRow);
            $('#cetaknota').addClass('disabled')
        }
    }

    $("#uangmuka").keyup(function() {
        let uangmuka = $(this).val()
        uangkembali(uangmuka);
    });

    $("#diskon").keyup(function() {
        hitungdiskon();
    });

    function hitungdiskon() {
        let total = $("#total").html()
        const diskon = $('#diskon').val()

        const hasildiskon = (total * diskon) / 100

        total = total - hasildiskon
        $(".jml").html(total)

        let uangmuka = $('#uangmuka').val()
        uangkembali(uangmuka);
    }

    function uangkembali(nilai) {
        const total = $(".jml").html()
        const kembali = parseInt(nilai) - parseInt(total)

        $('#uangkembali').val(kembali)
        checkStatus(kembali);
    }

    function checkStatus(kembali) {
        if (kembali < 0) {
            $('#status').val("PIUTANG")
        } else {
            $('#status').val("LUNAS")
        }
    }
</script>

@endpush
