<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Branch;
use Faker\Generator as Faker;
use App\User;

$factory->define(Branch::class, function (Faker $faker) {
    return [
        'nama'=>$faker->city,
        'alamat'=>$faker->address,
        'telepon'=>$faker->phoneNumber,
        'pimpinan'=>$faker->name,
        'created_by'=>function() {
            return User::all()->random();
        },
        'updated_by'=>function() {
            return User::all()->random();
        }
    ];
});
