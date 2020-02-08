@extends('layouts.kasir')

@push('css')
<link rel="stylesheet" href="/adminlte/plugins/select2/css/select2.min.css">
<style>
    .btn-cetak{
        width: 100%;
        min-height: 100px;
        text-align: justify
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="ml-1 row">
        <div class="col-md-2">
            <div class="pb-2 row border border-dark rounded">
                <div class="col-12">
                    <label for="">No Nota Kas</label> <br>
                    <input id="nonotakas" class="form-control form-control-sm" disabled type="text" value="{{$formatnnk}}">
                </div>
                <div class="col-12 mt-2">
                    <label for="">Tanggal</label> <br>
                    <input value="{{ \Carbon\Carbon::now()->format('d F Y') }}" class="form-control form-control-sm" disabled type="text">
                </div>
            </div>
        </div>
        <div class="ml-1 col-md-3">
            <div class="pb-2 row border border-dark rounded">
                <div class="col-10">
                    <label for="">Pelanggan</label> <br>
                    <select id="selectpelanggan" class="form-control form-control-sm select2">
                        <option value="" disabled selected>Pilih Pelanggan</option>
                        @foreach ($customers as $customer)
                        <option value="{{$customer->id}}">{{$customer->nama}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-1">
                    <br>
                    <button class="btn btn-info create-modal" id="tambahpelanggan"><i class="fa fa-plus"></i></button>
                </div>
                <div class="col-12 mt-2">
                    <label for="">Telepon</label>
                    <input id="teleponpelanggan" class="form-control form-control-sm" disabled type="text" >
                </div>
            </div>
        </div>
        <div class="ml-1 col-md-3 ">
            <div class="pb-3 row border border-dark rounded">
                <div class="col-12">
                    <label for="">Alamat</label>
                    <textarea id="alamatpelanggan" rows="3" disabled class="form-control" ></textarea>
                </div>
            </div>
        </div>

        <div class="ml-1 col-md-3">
            <div class="row">
                <div class="col-6">
                    <label for="">Total</label>
                    <h3 class="form-control form-control-sm">Rp. <span id="jml" class="inputharga">0</span>,-</h3>
                </div>
                <div class="col-6">
                    <a  href="#"  id="cetaknota" class="disabled btn btn-primary btn-lg btn-cetak align-middle" >Cetak Nota</a>
                </div>
            </div>

        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-10">
            <div class="row">
                <div class="col-12">
                    <div class="form">
                        <div class="row ">
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="">Kode</label>
                                    <input id="kodebarang" type="text"  disabled id="kode" class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="">Nama Barang</label>
                                    <select id="selectbarang" class="form-control form-control-sm select2">
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
                                <input type="text" id="hargabarang" disabled  id="harga" value="0" class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-1">
                                <div class="form-group">
                                    <label for="">Qty (Kg)</label>
                                    <input id="qtybarang" disabled type="text"  id="qty"  class="form-control form-control-sm inputharga">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="">Jumlah</label>
                                    <input id="jumlahbarang" type="text" disabled  id="jumlah" class="form-control form-control-sm inputharga">
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
                        <div class="table-wrapper-scroll-y my-custom-scrollbar">
                        <table class="table table-striped" id="tableBarang">
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
                            <tfoot>
                                <th colspan="4"></th>
                                <th>Sub Total</th>
                                <th>Rp. <span id="total" class="inputharga">0</span>,-</th>
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
                <input id="uangkembali" type="text" disabled  class="form-control form-control-sm">
            </div>
            <div class="form-group">
                <label for="">diskon (%)</label>
                <input id="diskon" disabled min="0" value="0" type="text" class="form-control form-control-sm">
            </div>
            <div class="form-group">
                <label for="">Status</label>
                <input id="status" type="text" disabled  class="form-control form-control-sm">
            </div>
            <div class="form-group">
                <label for="">Kasir</label>
                <input type="text" value="{{auth()->user()->employee->nama}}" disabled  class="form-control form-control-sm">
            </div>
            <div class="form-group">
                <a href="#" onClick="window.location.reload();" class="btn btn-danger">Reset</a>
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
                  <button class="btn btn-success" type="submit" id="add" >
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
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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

            $("#cetaknota").removeClass('disabled')
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

$(document).on('click', '#tambahpelanggan', function () {
    $('#plus').modal('show');
    $('#addnamapelanggan').val('')
    $('#addalamatpelanggan').val('')
    $('#addteleponpelanggan').val('')
});

$(document).on('click', '#cetaknota', function () {
    const total_nota = $("#jml").html()
    const diskon = $('#diskon').val();
    const jumlah_uang_nota = $('#uangmuka').val();
    const kembalian_nota = $('#uangkembali').val()
    const status = $('#status').val()
    const customer_id = $("#selectpelanggan").val()
    const no_nota_kas = $('#nonotakas').val();


    var items = new Array

    const $lastRow = $('table tbody tr:last');
    const lastNo = $lastRow.find('td').eq(0).text();
    for (let index = 1; index <= lastNo ; index++) {
        const $findRow = $('table tbody tr[data-id="'+ index +'"]');
        const no_urut = $findRow.find('td').eq(0).text()
        const supply_id = $findRow.find('td').eq(1).text()
        const kuantitas = $findRow.find('td').eq(4).text()
        const total_harga = $findRow.find('td').eq(5).text()
        items.push({
            no_urut,supply_id,kuantitas,total_harga
        })
    }


    var data = {
        total_nota,diskon,jumlah_uang_nota,kembalian_nota,status,customer_id,no_nota_kas,items
    }
    const url ="{{ route('kasir.simpan.nota') }}"
    $.ajax({
        type: 'get',
        url: url,
        data: {
            data
        },
        success: function (data) {
            if (data.status) {
                swal({
                    title: "Berhasil Menambahkan Transaksi",
                    text: "",
                    icon: "success",
                })
                    .then(function () {
                        location.reload()
                    });
            }

        },
    });

});

$('.modal-footer').on('click', '#add', function () {
    $('#add').attr('disabled',true)
    $.ajax({
        type: 'POST',
        url: "{{ route('kasir.pelanggan.simpan') }}",
        data: new FormData($("#form-add-pelanggan")[0]),
        processData: false,
        contentType: false,
        success: function (data) {
            $("#selectpelanggan").append(`<option value="${data.customer.id}">
                                       ${data.customer.nama}
                                  </option>`);
            $('#plus').modal('hide');
            $("#selectpelanggan option[value='"+data.customer.id+"']").prop('selected', true);
            $('#alamatpelanggan').html(data.customer.alamat)
            $('#teleponpelanggan').val(data.customer.telepon)
            $("#cetaknota").removeClass('disabled')
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

    const uangMuka = $("#uangmuka").val()
    uangkembali(uangMuka)

    $("#qtybarang").val(0)
    $("#jumlahbarang").val(0)
    $('#diskon').removeAttr('disabled')
    hitungdiskon();

});

$('#tableBarang tbody').on('click','.delete-barang', function(e) {
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
                                    <td>1</td>\
                                    <td>'+$('#kodebarang').val()+'</td>\
                                    <td>'+$('#selectbarang option:selected').text()+'</td>\
                                    <td>'+$('#hargabarang').val()+'</td>\
                                    <td>'+$('#qtybarang').val()+'</td>\
                                    <td>'+$('#jumlahbarang').val()+'</td>\
                                    <td>\
                                        <button href="#"  class="btn btn-outline-danger btn-sm delete-barang" data-id=1><i class="fas fa-trash"></a>\
                                    </td>\
                                </tr>'
            table.append(markup);
        }else{
            const $cloneRow = $lastRow.clone();
            const lastNo = $cloneRow.find('td').eq(0).text();
            const markup = '<tr data-id='+(parseInt(lastNo)+1)+'>\
                                    <td>'+ (parseInt(lastNo)+1) +'</td>\
                                    <td>'+$('#kodebarang').val()+'</td>\
                                    <td>'+$('#selectbarang option:selected').text()+'</td>\
                                    <td>'+$('#hargabarang').val()+'</td>\
                                    <td>'+$('#qtybarang').val()+'</td>\
                                    <td>'+$('#jumlahbarang').val()+'</td>\
                                    <td>\
                                        <button href="#"  class="btn btn-outline-danger btn-sm delete-barang" data-id='+(parseInt(lastNo)+1)+'><i class="fas fa-trash"></a>\
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

$("#diskon").keyup(function(){
    hitungdiskon();
});

function hitungdiskon() {
    let total = $("#total").html()
    const diskon = $('#diskon').val()

    const hasildiskon = (total * diskon)/100

    total = total - hasildiskon
    $("#jml").html(total)

    let uangmuka = $('#uangmuka').val()
    uangkembali(uangmuka);
}

function uangkembali(nilai) {
    const total = $("#jml").html()
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
