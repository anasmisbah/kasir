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

Route::get('/reset',function()
{
    return view('auth.passwords.email');
});

Auth::routes();

Route::middleware(['auth'])->group(function (){

    Route::get('/beranda', 'AdminController@beranda')->name('beranda');

    Route::middleware(['utama'])->group(function (){

        Route::get('/cabang', 'BranchController@index')->name('cabang.index');
        Route::get('/cabang/tambah', 'BranchController@create')->name('cabang.tambah');
        Route::post('/cabang/simpan','BranchController@store')->name('cabang.simpan');
        Route::get('/cabang/ubah/{id}', 'BranchController@edit')->name('cabang.ubah');
        Route::put('/cabang/{id}', 'BranchController@update')->name('cabang.perbarui');
        Route::delete('/cabang/hapus/{id}','BranchController@delete')->name('cabang.hapus');

        Route::get('/barang/tambah', 'ItemController@create')->name('barang.tambah');
        Route::post('/barang/simpan','ItemController@store')->name('barang.simpan');
        Route::get('/barang/ubah/{id}', 'ItemController@edit')->name('barang.ubah');
        Route::put('/barang/{id}', 'ItemController@update')->name('barang.perbarui');
        Route::delete('/barang/hapus/{id}','ItemController@delete')->name('barang.hapus');


        Route::get('/jenis', 'CategoryController@index')->name('jenis.index');
        Route::get('/jenis/tambah', 'CategoryController@create')->name('jenis.tambah');
        Route::post('/jenis/simpan','CategoryController@store')->name('jenis.simpan');
        Route::get('/jenis/ubah/{id}', 'CategoryController@edit')->name('jenis.ubah');
        Route::put('/jenis/{id}', 'CategoryController@update')->name('jenis.perbarui');
        Route::delete('/jenis/hapus/{id}','CategoryController@delete')->name('jenis.hapus');

        Route::get('/pengguna', 'UserController@index')->name('pengguna.index');
        Route::get('/pengguna/tambah', 'UserController@create')->name('pengguna.tambah');
        Route::post('/pengguna/simpan','UserController@store')->name('pengguna.simpan');
        Route::get('/pengguna/ubah/{id}', 'UserController@edit')->name('pengguna.ubah');
        Route::put('/pengguna/{id}', 'UserController@update')->name('pengguna.perbarui');
        Route::get('/pengguna/detail/{id}','UserController@show')->name('pengguna.detail');
        Route::delete('/pengguna/hapus/{id}','UserController@delete')->name('pengguna.hapus');

        Route::get('/tentang', 'ApplicationController@index')->name('tentang.index');
        Route::get('/tentang/ubah', 'ApplicationController@edit')->name('tentang.ubah');
        Route::put('/tentang/{id}', 'ApplicationController@update')->name('tentang.perbarui');
    });

    Route::middleware(['cabang'])->group(function (){
        Route::get('/pelanggan/tambah', 'CustomerController@create')->name('pelanggan.tambah');
        Route::post('/pelanggan/simpan','CustomerController@store')->name('pelanggan.simpan');
        Route::get('/pelanggan/ubah/{id}', 'CustomerController@edit')->name('pelanggan.ubah');
        Route::put('/pelanggan/{id}', 'CustomerController@update')->name('pelanggan.perbarui');

        Route::get('/stok/tambah', 'SupplyItemController@create')->name('stok.tambah');
        Route::post('/stok/simpan','SupplyItemController@store')->name('stok.simpan');
        Route::get('/stok/ubah/{id}', 'SupplyItemController@edit')->name('stok.ubah');
        Route::put('/stok/{id}', 'SupplyItemController@update')->name('stok.perbarui');

    });
    Route::middleware(['cabangutama'])->group(function (){

        // DETAIL PAGE
        Route::get('/jenis/detail/{id}','CategoryController@show')->name('jenis.detail');
        Route::get('/barang/detail/{id}','ItemController@show')->name('barang.detail');
        Route::get('/cabang/detail/{id}','BranchController@show')->name('cabang.detail');


        Route::get('/penjualan', 'BillController@index')->name('penjualan.index');
        Route::get('/penjualan/detail/{id}','BillController@show')->name('penjualan.detail');
        Route::get('/penjualan/cetaknota/{id}','BillController@cetaknota')->name('penjualan.cetaknota');
        Route::delete('/penjualan/hapus/{id}','BillController@delete')->name('penjualan.hapus');

        Route::get('/piutang', 'BillController@piutangAll')->name('piutang.index');
        Route::get('/piutang/lunas/{id}','BillController@piutanglunas')->name('piutang.lunas');
        Route::get('/piutang/detail/{id}','BillController@showPiutang')->name('piutang.detail');
        Route::get('/piutang/cetaknota/{id}','BillController@cetaknotapiutang')->name('piutang.cetaknota');


        Route::get('/pelanggan', 'CustomerController@index')->name('pelanggan.index');
        Route::get('/pelanggan/detail/{id}','CustomerController@show')->name('pelanggan.detail');
        Route::delete('/pelanggan/hapus/{id}','CustomerController@delete')->name('pelanggan.hapus');


        Route::get('/stok', 'SupplyItemController@index')->name('stok.index');
        Route::get('/stok/detail/{id}','SupplyItemController@show')->name('stok.detail');
        Route::delete('/stok/hapus/{id}','SupplyItemController@delete')->name('stok.hapus');

        Route::get('/karyawan', 'EmployeeController@index')->name('karyawan.index');
        Route::get('/karyawan/tambah', 'EmployeeController@create')->name('karyawan.tambah');
        Route::post('/karyawan/simpan','EmployeeController@store')->name('karyawan.simpan');
        Route::get('/karyawan/ubah/{id}', 'EmployeeController@edit')->name('karyawan.ubah');
        Route::put('/karyawan/{id}', 'EmployeeController@update')->name('karyawan.perbarui');
        Route::get('/karyawan/detail/{id}','EmployeeController@show')->name('karyawan.detail');
        Route::delete('/karyawan/hapus/{id}','EmployeeController@delete')->name('karyawan.hapus');
        Route::get('/pengguna/getEmployeeJson','EmployeeController@getEmployeeJson')->name('karyawan.data');

        Route::get('/barang/getjsonitem','ItemController@getJsonItem')->name('barang.data');
        Route::get('/barang', 'ItemController@index')->name('barang.index');
        Route::get('/barang/print','ItemController@print')->name('barang.print');

        Route::get('/pengguna/profile','UserController@profile')->name('pengguna.profile');
        Route::put('/profile','UserController@profileupdate')->name('pengguna.profile.perbarui');
    });

    Route::middleware(['kasir'])->group(function (){
        Route::get('/kasir','BillController@kasir')->name('kasir.index');
        Route::get('/pelanggan/getjsoncustomer','CustomerController@getJsonCustomer')->name('pelanggan.data');
        Route::get('/stok/getjsonsupply','SupplyItemController@getJsonSupply')->name('stok.data');
        Route::post('customer/storeajax','CustomerController@storeAjax')->name('kasir.pelanggan.simpan');
        Route::get('/kasir/simpan','BillController@saveBillAjax')->name('kasir.simpan.nota');
        Route::get('/kasir/cetaknota/{id}','BillController@cetaknota')->name('kasir.cetaknota');
        Route::get('/kasir/unduhnota/{id}','BillController@unduhknota')->name('kasir.unduhnota');

        Route::get('/pelanggan/fetchpelanggan','CustomerController@getdatajson')->name('pelanggan.datajson');
        Route::get('/stok/fetchbarang','SupplyItemController@getdatajson')->name('barang.datajson');

        // Pengguna Kasir
        Route::get('/kasir/pengguna','CashierController@userlogin')->name('kasir.pengguna');
        Route::get('/kasir/edit/pengguna','CashierController@edit')->name('kasir.ubah');
        Route::put('/kasir/pengguna','CashierController@update')->name('kasir.perbarui');
    });

});






