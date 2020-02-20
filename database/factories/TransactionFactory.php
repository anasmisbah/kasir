<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Transaction;
use Faker\Generator as Faker;
use App\Supply;
use App\User;
use App\Bill;
$factory->define(Transaction::class, function (Faker $faker) {
    $user = User::all()->random();
    $supply = Supply::all()->random();
    $qty = $faker->numberBetween(10,500);
    $harga = $supply->harga_cabang * $qty;
    return [
        'kuantitas'=>$qty,
        'total_harga'=>$harga,
        'no_urut'=>0,
        'bill_id'=>function() {
            return Bill::all()->random();
        },
        'supply_id'=>$supply->id,
        'created_by'=>$user->id,
        'updated_by'=>$user->id
    ];
});
