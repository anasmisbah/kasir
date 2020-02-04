<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function (){


    Route::middleware(['utama'])->group(function (){


    });

    Route::middleware(['cabang'])->group(function (){


    });

});

use Carbon\Carbon;
Route::get('/tgl',function(){

    $hari = DB::table('tanggal')->get()->groupBy(function ($val) {
        return Carbon::parse($val->date)->toDateString();
    });
    foreach ($hari as $key => $value) {
       echo $key." ";
    }
    echo "<br>";

    $bulan = DB::table('tanggal')->get()->groupBy(function ($val) {
        return Carbon::parse($val->date)->localeMonth;
    });
    foreach ($bulan as $key => $value) {
       echo $key." ";
    }
    echo "<br>";
    $tahun = DB::table('tanggal')->get()->groupBy(function ($val) {
        return Carbon::parse($val->date)->year;
    });
    foreach ($tahun as $key => $value) {
       echo $key;
    }
});
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/beranda', 'AdminController@beranda')->name('beranda');

Route::view('/penjualan', 'penjualan.index')->name('penjualan.index');
Route::view('/penjualan/tambah', 'penjualan.tambah')->name('penjualan.tambah');
Route::view('/penjualan/ubah', 'penjualan.ubah')->name('penjualan.ubah');

Route::view('/piutang', 'piutang.index')->name('piutang.index');
Route::view('/piutang/tambah', 'piutang.tambah')->name('piutang.tambah');
Route::view('/piutang/ubah', 'piutang.ubah')->name('piutang.ubah');

Route::view('/pelanggan', 'pelanggan.index')->name('pelanggan.index');
Route::view('/pelanggan/tambah', 'pelanggan.tambah')->name('pelanggan.tambah');
Route::view('/pelanggan/ubah', 'pelanggan.ubah')->name('pelanggan.ubah');

Route::view('/cabang', 'cabang.index')->name('cabang.index');
Route::view('/cabang/tambah', 'cabang.tambah')->name('cabang.tambah');
Route::view('/cabang/ubah', 'cabang.ubah')->name('cabang.ubah');

Route::view('/jenis', 'jenis.index')->name('jenis.index');
Route::view('/jenis/tambah', 'jenis.tambah')->name('jenis.tambah');
Route::view('/jenis/ubah', 'jenis.ubah')->name('jenis.ubah');

Route::view('/barang', 'barang.index')->name('barang.index');
Route::view('/barang/tambah', 'barang.tambah')->name('barang.tambah');
Route::view('/barang/ubah', 'barang.ubah')->name('barang.ubah');

Route::view('/stok', 'stok.index')->name('stok.index');
Route::view('/stok/tambah', 'stok.tambah')->name('stok.tambah');
Route::view('/stok/ubah', 'stok.ubah')->name('stok.ubah');

Route::view('/karyawan', 'karyawan.index')->name('karyawan.index');
Route::view('/karyawan/tambah', 'karyawan.tambah')->name('karyawan.tambah');
Route::view('/karyawan/ubah', 'karyawan.ubah')->name('karyawan.ubah');

Route::view('/pengguna', 'pengguna.index')->name('pengguna.index');
Route::view('/pengguna/tambah', 'pengguna.tambah')->name('pengguna.tambah');
Route::view('/pengguna/ubah', 'pengguna.ubah')->name('pengguna.ubah');

Route::view('/tentang', 'tentang.index')->name('tentang.index');
Route::view('/tentang/tambah', 'tentang.tambah')->name('tentang.tambah');
Route::view('/tentang/ubah', 'tentang.ubah')->name('tentang.ubah');

Route::view('/pdf/penjualan', 'pdf.penjualan')->name('pdf.penjualan');
Route::view('/pdf/kas', 'pdf.kas')->name('pdf.kas');
Route::view('/pdf/bon', 'pdf.bon')->name('pdf.bon');
Route::view('/pdf/piutang', 'pdf.piutang')->name('pdf.piutang');
Route::view('/pdf/pelanggan', 'pdf.pelanggan')->name('pdf.pelanggan');
Route::view('/pdf/barang', 'pdf.barang')->name('pdf.barang');
Route::view('/pdf/karyawan', 'pdf.karyawan')->name('pdf.karyawan');





