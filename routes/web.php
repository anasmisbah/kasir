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
