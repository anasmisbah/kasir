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
    return redirect()->route('beranda');
});

Auth::routes();

Route::middleware(['auth'])->group(function (){

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
    Route::get('/barang/getjsonitem','ItemController@getJsonItem')->name('barang.data');

    Route::get('/stok', 'SupplyItemController@index')->name('stok.index');
    Route::get('/stok/tambah', 'SupplyItemController@create')->name('stok.tambah');
    Route::post('/stok/simpan','SupplyItemController@store')->name('stok.simpan');
    Route::get('/stok/ubah/{id}', 'SupplyItemController@edit')->name('stok.ubah');
    Route::put('/stok/{id}', 'SupplyItemController@update')->name('stok.perbarui');
    Route::get('/stok/detail/{id}','SupplyItemController@show')->name('stok.detail');
    Route::delete('/stok/hapus/{id}','SupplyItemController@delete')->name('stok.hapus');

    Route::get('/karyawan', 'EmployeeController@index')->name('karyawan.index');
    Route::get('/karyawan/tambah', 'EmployeeController@create')->name('karyawan.tambah');
    Route::post('/karyawan/simpan','EmployeeController@store')->name('karyawan.simpan');
    Route::get('/karyawan/ubah/{id}', 'EmployeeController@edit')->name('karyawan.ubah');
    Route::put('/karyawan/{id}', 'EmployeeController@update')->name('karyawan.perbarui');
    Route::get('/karyawan/detail/{id}','EmployeeController@show')->name('karyawan.detail');
    Route::delete('/karyawan/hapus/{id}','EmployeeController@delete')->name('karyawan.hapus');


    Route::get('/pengguna', 'UserController@index')->name('pengguna.index');
    Route::get('/pengguna/tambah', 'UserController@create')->name('pengguna.tambah');
    Route::post('/pengguna/simpan','UserController@store')->name('pengguna.simpan');
    Route::get('/pengguna/ubah/{id}', 'UserController@edit')->name('pengguna.ubah');
    Route::put('/pengguna/{id}', 'UserController@update')->name('pengguna.perbarui');
    Route::get('/pengguna/detail/{id}','UserController@show')->name('pengguna.detail');
    Route::delete('/pengguna/hapus/{id}','UserController@delete')->name('pengguna.hapus');


    Route::get('/tentang', 'ApplicationController@edit')->name('tentang.index');
    Route::put('/tentang/{id}', 'ApplicationController@update')->name('tentang.perbarui');

    Route::view('/kasir','kasir.index')->name('kasir.index');

    Route::view('/pdf/penjualan', 'pdf.penjualan')->name('pdf.penjualan');
    Route::view('/pdf/kas', 'pdf.kas')->name('pdf.kas');
    Route::view('/pdf/bon', 'pdf.bon')->name('pdf.bon');
    Route::view('/pdf/piutang', 'pdf.piutang')->name('pdf.piutang');
    Route::view('/pdf/pelanggan', 'pdf.pelanggan')->name('pdf.pelanggan');
    Route::view('/pdf/barang', 'pdf.barang')->name('pdf.barang');
    Route::view('/pdf/karyawan', 'pdf.karyawan')->name('pdf.karyawan');

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





