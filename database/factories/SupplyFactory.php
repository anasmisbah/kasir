<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Supply;
use Faker\Generator as Faker;
use App\Item;
use App\Branch;
use App\User;
$factory->define(Supply::class, function (Faker $faker) {
    $item = Item::all()->random();
    $harga = $item->harga + 4000;

    return [
        'harga_selisih'=>4000,
        'harga_cabang'=>$harga,
        'stok'=>100,
        'item_id'=>$item->id,
        'branch_id'=>function() {
            return Branch::all()->random();
        },
        'created_by'=>function() {
            return User::all()->random();
        },
        'updated_by'=>function() {
            return User::all()->random();
        }
    ];
});
