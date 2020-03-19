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
        $this->call(EmployeeSeed::class);
        $this->call(UserSeed::class);
        $this->call(CreateSeeder::class);
        $this->call(ApplicationSeeder::class);

        // =========== OLD SEEDER FOR TESTING =========
        // $this->call(CategorySeeder::class);
        // $this->call(ItemSeeder::class);

        // factory(\App\Category::class, 7)->create();
        // factory(\App\Item::class, 100)->create();
        // factory(\App\Branch::class, 8)->create();
        // factory(\App\Customer::class, 100)->create();
        // factory(\App\Employee::class, 20)->create();
        // factory(\App\User::class, 10)->create();
        // factory(\App\Supply::class, 200)->create();
        // factory(\App\Bill::class, 50)->create();
        // factory(\App\Transaction::class, 500)->create();



    }
}
