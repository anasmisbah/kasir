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

Route::get('/pelanggan', 'CustomerController@index')->name('pelanggan.index');
Route::get('/pelanggan/tambah', 'CustomerController@create')->name('pelanggan.tambah');
Route::post('/pelanggan/simpan','CustomerController@store')->name('pelanggan.simpan');
Route::get('/pelanggan/ubah/{id}', 'CustomerController@edit')->name('pelanggan.ubah');
Route::put('/pelanggan/{id}', 'CustomerController@update')->name('pelanggan.perbarui');
Route::get('/pelanggan/detail/{id}','CustomerController@show')->name('pelanggan.detail');
Route::delete('/pelanggan/hapus/{id}','CustomerController@delete')->name('pelanggan.hapus');

Route::get('/cabang', 'BranchController@index')->name('cabang.index');
Route::get('/cabang/tambah', 'BranchController@create')->name('cabang.tambah');
Route::post('/cabang/simpan','BranchController@store')->name('cabang.simpan');
Route::get('/cabang/ubah/{id}', 'BranchController@edit')->name('cabang.ubah');
Route::put('/cabang/{id}', 'BranchController@update')->name('cabang.perbarui');
Route::get('/cabang/detail/{id}','BranchController@show')->name('cabang.detail');
Route::delete('/cabang/hapus/{id}','BranchController@delete')->name('cabang.hapus');


Route::get('/jenis', 'CategoryController@index')->name('jenis.index');
Route::get('/jenis/tambah', 'CategoryController@create')->name('jenis.tambah');
Route::post('/jenis/simpan','CategoryController@store')->name('jenis.simpan');
Route::get('/jenis/ubah/{id}', 'CategoryController@edit')->name('jenis.ubah');
Route::put('/jenis/{id}', 'CategoryController@update')->name('jenis.perbarui');
Route::get('/jenis/detail/{id}','CategoryController@show')->name('jenis.detail');
Route::delete('/jenis/hapus/{id}','CategoryController@delete')->name('jenis.hapus');

Route::get('/barang', 'ItemController@index')->name('barang.index');
Route::get('/barang/tambah', 'ItemController@create')->name('barang.tambah');
Route::post('/barang/simpan','ItemController@store')->name('barang.simpan');
Route::get('/barang/ubah/{id}', 'ItemController@edit')->name('barang.ubah');
Route::put('/barang/{id}', 'ItemController@update')->name('barang.perbarui');
Route::get('/barang/detail/{id}','ItemController@show')->name('barang.detail');
Route::delete('/barang/hapus/{id}','ItemController@delete')->name('barang.hapus');

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





