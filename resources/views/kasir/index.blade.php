@extends('layouts.kasir')

@push('css')
<link rel="stylesheet" href="/adminlte/plugins/select2/css/select2.min.css">
<style>
    .scrollable {
        height: 170px !important;
        overflow-y: scroll !important
    }

    .scrollable-list {
        max-height: 150px !important;
        overflow-y: scroll !important
    }
</style>
@endpush

@section('content')
<div class="container-fluid pt-2">
    <div class="card p-3 ">
        <div class="ml-1 row">
            <div class="col-md-2">
                <div class="row border border-secondary rounded pt-3 mr-1 pb-4 ">
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
            <div class="col-6 border border-secondary rounded">
                <div class="row pt-3">
                    <div class="col-5">
                        <div class="form-group-sm">
                            <input type="hidden" id="idpelanggan">
                            <label for="">Nama Pelanggan</label> <br>
                            <input type="text" name="" id="searchpelanggan" class="form-control form-control-sm d-inline" placeholder="Masukkan Nama Pelanggan" style="width:80%" id="">
                            <div class="position-absolute scrollable-list" style="z-index:999; width:77%">
                                <div class="list-group position-relative" id="list-pelanggan">
                                </div>
                            </div>
                            <button class="btn-sm btn-info create-modal d-inline" id="tambahpelanggan"><i class="fa fa-plus"></i></button>
                        </div>
                        <div class="form-group mt-3">

                            <label for="">Telepon</label>
                            <input id="teleponpelanggan" class="form-control form-control-sm" style="width:80%" disabled type="text">
                        </div>
                    </div>
                    <div class="col-7">
                        <label for="">Alamat</label>
                        <textarea id="alamatpelanggan" rows="4" disabled class="form-control"></textarea>
                    </div>
                </div>
            </div>
            <div class="col-2 mt-3">
                <label for="">TOTAL</label>
                <h3 class="form-control form-control-lg text-bold text-center pt-4" style="height:60%">Rp <span class="inputharga jml">0</span>,-</h3>
            </div>
            <div class="col-2 " style="padding-top: 50px; padding-bottom:35px">
                <a href="#" id="cetaknota" class="pt-4 text-bold disabled btn btn-info btn-lg btn-cetak" style="width:100%; height:100%">Cetak Nota</a>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-10">
                <div class="row">
                    <div class="col-12">
                        <div class="form">
                            <div class="row ">
                                <div class="col-2">
                                    <div class="form-group ml-5">
                                        <label for="">Kode</label>
                                        <input id="kodebarang" type="text" disabled id="kode" class="form-control form-control-sm " style="width:100%">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="">Nama Barang</label>
                                        <input type="text" name="" id="searchbarang" class="form-control form-control-sm d-inline" placeholder="Masukkan Nama Barang" style="width:100%" id="">
                                        <div class="position-absolute scrollable-list" style="z-index:999; width:97%">
                                            <div class="list-group position-relative" id="list-barang">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="">Harga</label>
                                        <input type="text" id="hargabarang" disabled id="harga" value="0" class="form-control form-control-sm ">
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="form-group">
                                        <label for="">Qty</label>
                                        <input id="qtybarang" type="text" disabled id="qty" placeholder="0" class="form-control form-control-sm inputharga">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="">Jumlah</label>
                                        <input id="jumlahbarang" type="text" disabled value="0" id="jumlah" class="form-control form-control-sm inputharga">
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="form-group" style="margin-top:30px">
                                        <button disabled type="button" id="tambahbarang" class="btn-sm btn-info form-control form-control-sm" style="width:40px;">
                                            <i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-md-12">
                        <div class="table-wrapper-scroll-y my-custom-scrollbar">
                            <table class="table table-sm" id="tableBarang">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Kode</th>
                                        <th>Nama Barang</th>
                                        <th>Harga</th>
                                        <th>Qty</th>
                                        <th>Jumlah</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <section class="scrollable">
                            <table class="table table-sm" id="tableBarang">
                                <tbody>
                                </tbody>
                            </table>
                        </section>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-md-12">
                        <div class="table-wrapper-scroll-y my-custom-scrollbar">
                            <table class="table table-sm" id="tableBarang">
                                <tfoot>
                                    <tr>
                                        <td colspan="4"></td>
                                        <td class="border-top border-bawah text-center"> Sub Total</td>
                                        <td class="border-top border-bawah">Rp <span id="total" class="inputharga">0</span>,-
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" style="border: none"></td>
                                        <td style="border:none" class="text-right pr-2">
                                            Diskon (%) <span><input type="text" name="" id="diskon" class="form-control form-control-sm d-inline" disabled style="width:50px"></span>
                                        </td>
                                        <td class="border-top border-bottom text-bold text-center">TOTAL</td>
                                        <td class="border-top  border-bottom text-bold">Rp <span id="total" class="inputharga jml">0</span>,-
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="">Uang muka</label>
                    <input id="uangmuka" type="text" value="0" class="form-control form-control-sm ">
                </div>
                <div class="form-group">
                    <label for="">Uang kembali</label>
                    <input id="uangkembali" type="text" value="0" disabled class="form-control form-control-sm">
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

{{-- Modal Tambah --}}
<div id="plus" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close btn-sm" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
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
                <button class="btn btn-success" type="submit" id="add">
                    <span class="glyphicon glyphicon-plus"></span> Tambah
                </button>
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Tutup
                </button>
            </div>
        </div>
    </div>
</div>
{{-- /modal tambah --}}
@stop

@push('script')
<script src="/adminlte/plugins/number-divider.min.js"></script>
<script src="/adminlte/plugins/select2/js/select2.full.min.js"></script>
<script src="/adminlte/plugins/sweetalert.min.js"></script>
<script>
    $(function() {
        $('.select2').select2()
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
                $("#cetaknota").removeClass('disabled')
                $('#idpelanggan').val(data.customer.id)
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
        const diskon = $('#diskon').val();
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
                $("#selectpelanggan option[value='" + data.customer.id + "']").prop('selected',
                    true);
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

            addNewRow();
        } else {
            alert("masukkan Kuantitan barang Terlebih Dahulu")
        }


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
        hitungdiskon();

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

            const markup = '<tr data-id=1 class="text-center">\
                                    <td>1</td>\
                                    <td>' + $('#kodebarang').val() + '</td>\
                                    <td>' + $('#searchbarang').val() + '</td>\
                                    <td>' + $('#hargabarang').val() + '</td>\
                                    <td>' + $('#qtybarang').val() + '</td>\
                                    <td>' + $('#jumlahbarang').val() + '</td>\
                                    <td>\
                                        <button href="#"  class="btn btn-warning text-white btn-sm delete-barang" data-id=1><i class="fas fa-trash"></a>\
                                    </td>\
                                </tr>'
            table.prepend(markup);
        } else {
            const $cloneRow = $lastRow.clone();
            const lastNo = $cloneRow.find('td').eq(0).text();
            const markup = '<tr data-id=' + (parseInt(lastNo) + 1) + ' class="text-center">\
                                    <td>' + (parseInt(lastNo) + 1) + '</td>\
                                    <td>' + $('#kodebarang').val() + '</td>\
                                    <td>' + $('#searchbarang').val() + '</td>\
                                    <td>' + $('#hargabarang').val() + '</td>\
                                    <td>' + $('#qtybarang').val() + '</td>\
                                    <td>' + $('#jumlahbarang').val() + '</td>\
                                    <td>\
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