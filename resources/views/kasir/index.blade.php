@extends('layouts.master')
@section('content')
<div class="container-fluid">
    <div class="ml-1 row" style="padding-top: 30px !important;">
        <div class="col-md-2">
            <div class="pb-2 row border border-dark rounded">
                <div class="col-12">
                    <label for="">No Nota Kas</label> <br>
                    <input class="form-control" disabled type="text" value="123123">
                </div>
                <div class="col-12 mt-2">
                    <label for="">Tanggal</label> <br>
                    <input value="{{ \Carbon\Carbon::now() }}" class="form-control" disabled type="text">
                </div>
            </div>
        </div>
        <div class="ml-1 col-md-3">
            <div class="pb-2 row border border-dark rounded">
                <div class="col-10">
                    <label for="">Pelanggan</label> <br>
                    <select id="select-pengguna" class="form-control">
                        <option value="" disabled>Pilih Pelanggan</option>
                    </select>
                </div>
                <div class="col-1">
                    <br>
                    <button class="btn btn-info" >+</button>
                </div>
                <div class="col-12 mt-2">
                    <label for="">Telepon</label>
                    <input class="form-control" disabled type="text" >
                </div>
            </div>
        </div>
        <div class="ml-1 col-md-3">
            <div class="pb-2 row border border-dark rounded">
                <div class="col-12">
                    <label for="">Alamat</label>
                    <textarea class="form-control" ></textarea>
                </div>
            </div>
        </div>

        <div class="col-md-2">
            Total
            <h3>Rp. <span id="total"></span></h3>
        </div>
        <div class="col-md-1">
            <a href="#" class="btn btn-primary btn-block">Cetak Nota</a>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-10">
            <div class="row">
                <div class="col-12">
                    <div class="form-inline">
                        <div class="row ">
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="">Kode</label>
                                    <input type="text"  disabled id="kode" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="">Nama Barang</label>
                                    <select id="select-barang" class="form-control form-control-sm">
                                        <option value="" disabled>Pilih Barang</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="">Harga</label>
                                <input type="text" disabled  id="harga" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-1">
                                <div class="form-group">
                                    <label for="">Qty (Kg)</label>
                                    <input type="text"  id="qty"  class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="">Jumlah</label>
                                    <input type="text" disabled  id="jumlah" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-1">
                                    <button class="btn btn-info" >+</button>
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
                                    <th>#</th>
                                    <th>kode</th>
                                    <th>Nama Barang</th>
                                    <th>Harga</th>
                                    <th>qty</th>
                                    <th>Jumlah</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr >
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <a  class="btn btn-danger btn-sm">Aksi</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="">Uang muka</label>
                <input type="text"  class="form-control">
            </div>
            <div class="form-group">
                <label for="">Uang kembali</label>
                <input type="text" disabled  class="form-control">
            </div>
            <div class="form-group">
                <label for="">Status</label>
                <input type="text" disabled  class="form-control">
            </div>
            <div class="form-group">
                <label for="">Kasir</label>
                <input type="text" disabled  class="form-control">
            </div>
            <div class="form-group">
                <a href="#" class="btn btn-danger">Reset</a>
            </div>
        </div>
    </div>
</div>
@stop

@section('javascript')
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>

</script>

@stop
