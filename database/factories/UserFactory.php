<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Employee;
use App\Level;
/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    $user = User::all()->random();
    $employeesAll = Employee::all();
    $employee = null;
    foreach ($employeesAll as $employ) {
        if (!$employ->user) {
            $employee = $employ;
            break;
        }
    }
    return [
        'username'=>$faker->firstName,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
        'level_id'=>function() {
            return Level::all()->random();
        },
        'employee_id'=>$employee->id,
        'created_by'=>$user->id,
        'updated_by'=>$user->id

    ];
});
