<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Item;
use Faker\Generator as Faker;
use App\Category;
use App\User;
$factory->define(Item::class, function (Faker $faker) {
    return [
        'nama'=>$faker->word,
        'harga'=>$faker->randomNumber(4,false),
        'category_id'=>function() {
            return Category::all()->random();
        },
        'created_by'=>function() {
            return User::all()->random();
        },
        'updated_by'=>function() {
            return User::all()->random();
        }
    ];
});
