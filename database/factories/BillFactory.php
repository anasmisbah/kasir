<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Bill;
use Faker\Generator as Faker;
use App\User;
use App\Customer;
use App\Branch;
use Carbon\Carbon;

$factory->define(Bill::class, function (Faker $faker) {
    $user = User::all()->random();
    $date = Carbon::now();
    $branch = Branch::all()->random();
    $lastBill = Bill::select('id')->orderBy('id','desc')->first();
    $nnk = $branch->id."". $user->employee_id ."" .($faker->numberBetween(999,9999))."".$date->day."".$date->month."".$date->second;
    $total = 100000;
    $jml = $faker->numberBetween(80000,95000);
    $kembalian = $jml - $total;
    return [
        'tanggal_nota'=>$faker->dateTime($max = 'now', $timezone = null),
        'diskon'=>10,
        'total_nota'=>$total,
        'jumlah_uang_nota'=>$jml,
        'kembalian_nota'=>$kembalian,
        'status'=>'lunas',
        'branch_id'=>$branch->id,
        'user_id'=>$user->id,
        'customer_id'=>function() {
            return Customer::all()->random();
        },
        'no_nota_kas'=>$nnk,
        'created_by'=>$user->id,
        'updated_by'=>$user->id
    ];
});
