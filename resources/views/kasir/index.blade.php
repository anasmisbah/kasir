@extends('layouts.master')

@push('css')
<link rel="stylesheet" href="/adminlte/plugins/select2/css/select2.min.css">
@endpush

@section('content')
<div class="container-fluid">
    <div class="ml-1 row" style="padding-top: 30px !important;">
        <div class="col-md-2">
            <div class="pb-2 row border border-dark rounded">
                <div class="col-12">
                    <label for="">No Nota Kas</label> <br>
                    <input class="form-control" disabled type="text" value="{{$formatnnk}}">
                </div>
                <div class="col-12 mt-2">
                    <label for="">Tanggal</label> <br>
                    <input value="{{ \Carbon\Carbon::now()->format('d F Y') }}" class="form-control" disabled type="text">
                </div>
            </div>
        </div>
        <div class="ml-1 col-md-3">
            <div class="pb-2 row border border-dark rounded">
                <div class="col-10">
                    <label for="">Pelanggan</label> <br>
                    <select id="selectpelanggan" class="form-control select2">
                        <option value="" disabled selected>Pilih Pelanggan</option>
                        @foreach ($customers as $customer)
                        <option value="{{$customer->id}}">{{$customer->nama}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-1">
                    <br>
                    <button class="btn btn-info" >+</button>
                </div>
                <div class="col-12 mt-2">
                    <label for="">Telepon</label>
                    <input id="teleponpelanggan" class="form-control" disabled type="text" >
                </div>
            </div>
        </div>
        <div class="ml-1 col-md-3">
            <div class="pb-2 row border border-dark rounded">
                <div class="col-12">
                    <label for="">Alamat</label>
                    <textarea id="alamatpelanggan" disabled class="form-control" ></textarea>
                </div>
            </div>
        </div>

        <div class="ml-1 col-md-3">
            <div class="row">
                <div class="col-6">
                    <label for="">Total</label>
                    <h3 class="form-control">Rp. <span id="total" class="inputharga">0</span>,-</h3>
                </div>
                <div class="col-6">
                    <a href="#" class="btn btn-primary btn-lg btn-block">Cetak Nota</a>
                </div>
            </div>

        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-10">
            <div class="row">
                <div class="col-12">
                    <div class="form">
                        <div class="row ">
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="">Kode</label>
                                    <input id="kodebarang" type="text"  disabled id="kode" class="form-control ">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="">Nama Barang</label>
                                    <select id="selectbarang" class="form-control select2">
                                        <option value="" disabled selected>Pilih Barang</option>
                                        @foreach ($supplies as $supply)
                                        <option value="{{$supply->id}}">{{$supply->item->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="">Harga</label>
                                <input type="text" id="hargabarang" disabled  id="harga" value="0" class="form-control ">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="">Qty (Kg)</label>
                                    <input id="qtybarang" disabled type="text"  id="qty"  class="form-control inputharga">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="">Jumlah</label>
                                    <input id="jumlahbarang" type="text" disabled  id="jumlah" class="form-control inputharga">
                                </div>
                            </div>
                            <div class="col-1">
                                <div class="form-group">
                                    <label for="">Tambah</label>
                                    <button disabled type="button" id="tambahbarang" class="btn btn-primary  form-control" ><i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
                <div class="row mt-1">
                    <div class="col-md-12">
                        <table class="table" id="tableBarang">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>kode</th>
                                    <th>Nama Barang</th>
                                    <th>Harga</th>
                                    <th>qty</th>
                                    <th>Jumlah</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="">Uang muka</label>
                <input id="uangmuka" type="text"  class="form-control inputharga">
            </div>
            <div class="form-group">
                <label for="">Uang kembali</label>
                <input id="uangkembali" type="text" disabled  class="form-control inputharga">
            </div>
            <div class="form-group">
                <label for="">Status</label>
                <input id="status" type="text" disabled  class="form-control">
            </div>
            <div class="form-group">
                <label for="">Kasir</label>
                <input type="text" value="{{auth()->user()->employee->nama}}" disabled  class="form-control">
            </div>
            <div class="form-group">
                <a href="#" onClick="window.location.reload();" class="btn btn-danger">Reset</a>
            </div>
        </div>
    </div>
</div>
@stop

@push('script')
<script src="/adminlte/plugins/number-divider.min.js"></script>
<script src="/adminlte/plugins/select2/js/select2.full.min.js"></script>
<script>
$(function () {
    $('.select2').select2()

    // Number Divide
    $("#inputharga").divide({
        delimiter:',',
        divideThousand:true
    });
    // Number Divide
    $(".inputharga").divide({
        delimiter:',',
        divideThousand:true
    });

    // Cegah Paid Amount Diisi dengan Huruf
    $(".inputharga").on('keypress', function(keys){
        if(keys.keyCode > 31 && (keys.keyCode < 48 || keys.keyCode > 57)) {
            keys.preventDefault();
        }
    });
});
</script>
<script>
$(document).on('change', '#selectpelanggan', function () {
    let url = "{{ route('pelanggan.data') }}"

    $.ajax({
        type: 'get',
        url: url,
        data: {
            'id': $("#selectpelanggan").val(),
        },
        success: function (data) {
            $('#alamatpelanggan').html(data.customer.alamat)
            $('#teleponpelanggan').val(data.customer.telepon)
        },
    });
});

$(document).on('change', '#selectbarang', function () {
    let url = "{{ route('stok.data') }}"
    $.ajax({
        type: 'get',
        url: url,
        data: {
            'id': $("#selectbarang").val(),
        },
        success: function (data) {
            $('#kodebarang').val(data.supply.id)
            $('#hargabarang').val(data.supply.harga_cabang)
            $("#qtybarang").removeAttr('disabled')
            $("#tambahbarang").removeAttr('disabled')
        },
    });
});

$("#qtybarang").keyup(function(){
  let harga = $('#hargabarang').val()
  let qty = $(this).val()
  let total = harga * qty
  $("#jumlahbarang").val(total)
});

$(document).on('click', '#tambahbarang', function () {
    addNewRow();

    const total = $("#total").html()
    const jmlbarang = $('#jumlahbarang').val()
    const totalan = parseInt(total) + parseInt(jmlbarang)
    $("#total").html(totalan)




    $("#qtybarang").val(0)
    $("#jumlahbarang").val(0)
});

$('#tableBarang tbody').on('click','.delete-barang', function(e) {
    const id = $(this).data('id')

    removeRow(id)
});

function addNewRow() {
        // ambil baris tabel terakhir
        const $lastRow = $('table tbody tr:last');
        const kodebarang = $('#kodebarang').val()
        const table = $('#tableBarang tbody')
        if ($lastRow.length == 0) {

            const markup = '<tr data-id='+kodebarang+'>\
                                    <td>1</td>\
                                    <td>'+$('#kodebarang').val()+'</td>\
                                    <td>'+$('#selectbarang option:selected').text()+'</td>\
                                    <td>'+$('#hargabarang').val()+'</td>\
                                    <td>'+$('#qtybarang').val()+'</td>\
                                    <td>'+$('#jumlahbarang').val()+'</td>\
                                    <td>\
                                        <button href="#"  class="btn btn-outline-danger btn-sm delete-barang" data-id='+kodebarang+'><i class="fas fa-trash"></a>\
                                    </td>\
                                </tr>'
            table.append(markup);
        }else{
            const $cloneRow = $lastRow.clone();
            const lastNo = $cloneRow.find('td').eq(0).text();
            const markup = '<tr data-id='+kodebarang+'>\
                                    <td>'+ (parseInt(lastNo)+1) +'</td>\
                                    <td>'+$('#kodebarang').val()+'</td>\
                                    <td>'+$('#selectbarang option:selected').text()+'</td>\
                                    <td>'+$('#hargabarang').val()+'</td>\
                                    <td>'+$('#qtybarang').val()+'</td>\
                                    <td>'+$('#jumlahbarang').val()+'</td>\
                                    <td>\
                                        <button href="#"  class="btn btn-outline-danger btn-sm delete-barang" data-id='+kodebarang+'><i class="fas fa-trash"></a>\
                                    </td>\
                                </tr>'
            table.append(markup);
        }
    }
    function removeRow(id) {
        const $findRow = $('table tbody tr[data-id="'+ id +'"]');
        const total = $("#total").html()
        const jmlbarang = $findRow.find('td').eq(5).text()
        const totalan = parseInt(total) - parseInt(jmlbarang)
        $("#total").html(totalan)
        $findRow.remove();
    }

$("#uangmuka").keyup(function(){
    let uangmuka = $(this).val()

    uangkembali(uangmuka);
});

function uangkembali(nilai) {
    const total = $("#total").html()
    const kembali = parseInt(nilai) - parseInt(total)

    $('#uangkembali').val(kembali)
    checkStatus(kembali);
}

function checkStatus(kembali) {
    if(kembali < 0){
        $('#status').val("PIUTANG")
    }else{
        $('#status').val("LUNAS")
    }
}

</script>

@endpush
