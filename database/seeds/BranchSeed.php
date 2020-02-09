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
                'nama' => 'samarinda',
                'alamat'=>'jl samarinda',
                'telepon'=>'085253456545',
                'pimpinan'=>'ahmad',

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'nama' => 'balikpapan',
                'alamat'=>'jl balikpapan',
                'telepon'=>'085253456545',
                'pimpinan'=>'tello',

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'nama' => 'tenggarong',
                'alamat'=>'jl tenggarong',
                'telepon'=>'085253456545',
                'pimpinan'=>'adi',

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
