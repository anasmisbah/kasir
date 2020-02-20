<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Employee;
use Faker\Generator as Faker;
use App\User;
use App\Branch;
$factory->define(Employee::class, function (Faker $faker) {
    $user = User::all()->random();
    return [
        'nama'=>$faker->name,
        'jenis_kelamin'=>$faker->randomElement(['laki-laki','perempuan']),
        'jabatan'=>$faker->word,
        'alamat'=>$faker->address,
        'telepon'=>$faker->phoneNumber,
        'branch_id'=>function() {
            return Branch::all()->random();
        },
        'created_by'=>$user->id,
        'updated_by'=>$user->id
    ];
});
