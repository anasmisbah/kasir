<?php

use Illuminate\Database\Seeder;

class BranchSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('branches')->insert([
            [
                'nama' => 'Pusat',
                'alamat'=>'jl samarinda',
                'kode'=>'PT',
                'kecamatan'=>'Sempaja',
                'kota'=>'Samarinda',
                'provinsi'=>'Kalimantan Timur',
                'telepon'=>'085253456545',
                'pimpinan'=>'Direktur',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
        ]);
    }
}
