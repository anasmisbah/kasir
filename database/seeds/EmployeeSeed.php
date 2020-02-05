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
                'nama' => 'admin utama',
                'jenis_kelamin'=>'laki-laki',
                'jabatan'=>'ketua admin utama',
                'branch_id'=>1,
                'alamat'=>'jl samarinda',
                'telepon'=>'085253456545',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'nama' => 'admin cabang',
                'jenis_kelamin'=>'perempuan',
                'jabatan'=>'bendahara cabang',
                'branch_id'=>2,
                'alamat'=>'jl balikpapan utara',
                'telepon'=>'085253456545',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'nama' => 'kasir cabang',
                'jenis_kelamin'=>'laki-laki',
                'jabatan'=>'kasir',
                'branch_id'=>2,
                'alamat'=>'jl balikpapan selatan',
                'telepon'=>'085253456545',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
