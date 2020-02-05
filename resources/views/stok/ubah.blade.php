@extends('layouts.master')

@push('css')
<link rel="stylesheet" href="/adminlte/plugins/select2/css/select2.min.css">
@endpush

@section('content')
<div class="col-12 ">
    <div class="card mt-3">
        <div class="card-header">
            <h3 class="card-title">Edit Stok Barang</h3>
        </div>

        <form role="form" action="{{route('stok.perbarui',$supply->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                        <label>Barang</label>
                        <select id="barang" class="form-control select2" name="item_id">
                            <option value="0" selected>--Pilih Barang--</option>
                            @foreach ($items as $item)
                                <option value="{{$item->id}}" {{$item->id == $supply->item_id?"selected":""}}>{{$item->nama}}</option>
                            @endforeach
                        </select>
                </div>
                <div class="form-group">
                    <label>Cabang</label>
                    <input type="text" value="{{$supply->branch->nama}}" disabled class="form-control" >
                    <input type="hidden" value="{{$supply->branch->id}}" name="branch_id">
                </div>
                <div class="form-group">
                    <label>Harga Pusat</label>
                    <input type="text" value="{{$supply->item->harga}}" id="harga_pusat" disabled class="form-control inputharga" name="harga_pusat" placeholder="harga pusat">
                </div>
                <div class="form-group">
                    <label>Harga Cabang</label>
                    <input type="text" value="{{$supply->harga_cabang}}" id="harga_cabang" class="form-control inputharga" name="harga_cabang" placeholder="Masukkan Harga Cabang">
                </div>
                <div class="form-group">
                    <label>Selisih</label>
                    <input type="text" value="{{$supply->harga_selisih}}" id="selisih" disabled class="form-control inputharga" name="harga_selisih" placeholder="selisih">
                </div>
                <div class="form-group">
                    <label>Stok</label>
                    <input type="text" value="{{$supply->stok}}" class="form-control" name="stok" placeholder="Masukkan Stok Barang">
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-lg btn-primary float-right"><i class="fa fa-save"></i></button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('script')
<script src="/adminlte/plugins/number-divider.min.js"></script>
<script src="/adminlte/plugins/select2/js/select2.full.min.js"></script>
<script>
$(function () {
    $('.select2').select2()
});
</script>
<script>
$(document).on('change', '#barang', function () {
    let url = "{{ route('barang.data') }}"
    $.ajax({
        type: 'get',
        url: url,
        data: {
            'id': $("#barang").val(),
        },
        success: function (data) {
            //Menampilkan Error
            $('#harga_pusat').val(data.data.harga)
            $("#harga_cabang").removeAttr('disabled')
            $("#harga_cabang").val(0)
            $("#selisih").val(0)
        },
    });
});

$("#harga_cabang").keyup(function(){
  let hargaPusat = $('#harga_pusat').val()
  let hargaCabang = $(this).val()
  let selisih = hargaCabang - hargaPusat
  $("#selisih").val(selisih)
});
</script>
<script>
    $(function () {
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
@endpush
