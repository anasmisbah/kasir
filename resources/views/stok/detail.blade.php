@extends('layouts.master')

@section('content')
<div class="col-12 ">
    <div class="card mt-3">
        <div class="card-header">
            <h3 class="card-title">Tambah Stok Barang</h3>
        </div>

        <form role="form" action="{{route('stok.simpan')}}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                        <label>Barang</label>
                        <input type="text" value="{{$supply->item->nama}}" disabled class="form-control" >
                </div>
                <div class="form-group">
                    <label>Cabang</label>
                    <input type="text" value="{{$supply->branch->nama}}" disabled class="form-control" >
                </div>
                <div class="form-group">
                    <label>Harga Pusat</label>
                    <input type="text" value="{{$supply->item->harga}}" id="harga_pusat" disabled class="form-control inputharga" name="harga_pusat" placeholder="harga pusat">
                </div>
                <div class="form-group">
                    <label>Harga Cabang</label>
                    <input type="text" value="{{$supply->harga_cabang}}" id="harga_cabang" disabled class="form-control inputharga" name="harga_cabang" placeholder="Masukkan Harga Cabang">
                </div>
                <div class="form-group">
                    <label>Selisih</label>
                    <input type="text" value="{{$supply->harga_selisih}}" id="selisih" disabled class="form-control inputharga" name="harga_selisih" placeholder="selisih">
                </div>
                <div class="form-group">
                    <label>Stok</label>
                    <input type="text" disabled value="{{$supply->stok}}" class="form-control" name="stok" placeholder="Masukkan Stok Barang">
                </div>
            </div>

            <div class="card-footer">
                <a href="{{route('stok.ubah',$supply->id)}}" class="btn btn-lg btn-primary float-right"><i class="fa fa-edit"></i></a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('script')
<script src="/adminlte/plugins/number-divider.min.js"></script>
<script>
    $(function () {
        // Number Divide
        $(".inputharga").divide({
            delimiter:',',
            divideThousand:true
        });
    });
    </script>
@endpush
