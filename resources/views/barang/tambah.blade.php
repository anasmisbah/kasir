@extends('layouts.master')

@section('content')
<div class="col-12">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Tambah Barang</h3>
    </div>

    <form role="form">
      <div class="card-body">
        <div class="form-group">
          <label>Nama</label>
          <input type="email" class="form-control" name="nama" placeholder="Masukkan Nama Barang">
        </div>
        <div class="form-group">
          <label>Jenis</label>
          <select class="form-control select2" name="jenis" style="width: 100%;">
            <option>Makanan</option>
            <option>Minuman</option>
            <option>Sembako</option>
            <option>Snack</option>
            <option>Bahan Mentah</option>
            <option>Sayur</option>
          </select>
        </div>
        <div class="form-group">
          <label>Harga</label>
          <input type="text" class="form-control" name="harga" placeholder="Masukkan Harga Barang">
        </div>
      </div>

      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Tambahkan</button>
      </div>
    </form>
  </div>
</div>
@endsection