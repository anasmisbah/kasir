<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(LevelSeed::class);
        $this->call(BranchSeed::class);
        $this->call(CategorySeeder::class);
        $this->call(EmployeeSeed::class);
        $this->call(UserSeed::class);
        $this->call(ItemSeeder::class);

    }
}
