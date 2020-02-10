<?php

use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('items')->insert([
            [
                'nama' => 'Beras Murtiara',
                'harga'=>5000,
                'category_id'=>1,
                'created_by'=>1,
                'updated_by'=>1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'nama' => 'Oronamin C',
                'harga'=>5000,
                'category_id'=>2,
                'created_by'=>1,
                'updated_by'=>1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'nama' => 'Indomie',
                'harga'=>5000,
                'category_id'=>3,
                'created_by'=>1,
                'updated_by'=>1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
