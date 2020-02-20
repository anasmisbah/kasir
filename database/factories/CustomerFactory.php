<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Customer;
use Faker\Generator as Faker;
use App\Branch;
use App\User;
$factory->define(Customer::class, function (Faker $faker) {
    return [
        'nama'=>$faker->name,
        'alamat'=>$faker->address,
        'telepon'=>$faker->phoneNumber,
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
