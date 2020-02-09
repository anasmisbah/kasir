<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'username' => 'adminutama',
                'email'=>'adminutama@admin.com',
                'password'=>Hash::make("123123"),
                'level_id'=>1,
                'employee_id'=>1,
                'created_by'=>1,
                'updated_by'=>1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'username' => 'admincabang',
                'email'=>'admincabang@admin.com',
                'password'=>Hash::make("123123"),
                'level_id'=>2,
                'employee_id'=>2,
                'created_by'=>1,
                'updated_by'=>1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'username' => 'kasircabang',
                'email'=>'kasircabang@admin.com',
                'password'=>Hash::make("123123"),
                'level_id'=>3,
                'employee_id'=>3,
                'created_by'=>1,
                'updated_by'=>1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
