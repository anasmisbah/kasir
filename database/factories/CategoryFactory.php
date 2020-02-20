<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;
use App\User;
$factory->define(Category::class, function (Faker $faker) {
    return [
        'nama' => $faker->word,
        'created_by'=> function() {
            return User::all()->random();
        },
        'updated_by'=>function() {
            return User::all()->random();
        },
    ];
});
