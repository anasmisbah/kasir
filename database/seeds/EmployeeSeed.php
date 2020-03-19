<?php

use Illuminate\Database\Seeder;

class EmployeeSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employees')->insert([
            [
                'nama' => 'Jhon Doe',
                'jenis_kelamin'=>'laki-laki',
                'jabatan'=>'Direktur',
                'branch_id'=>1,
                'alamat'=>'jl samarinda',
                'telepon'=>'085253456545',
                'kode'=>'PT01',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
