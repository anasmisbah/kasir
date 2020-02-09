<?php

use Illuminate\Database\Seeder;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('applications')->insert([
            [
                'nama' => 'bedu',
                'toko'=>'cici bedu jaya',
                'alamat'=>'jl samarinda',
                'telepon'=>'085252525223',
                'created_by'=>1,
                'updated_by'=>1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
