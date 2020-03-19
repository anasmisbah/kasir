<?php

use Illuminate\Database\Seeder;
use App\Employee;
use App\Branch;
class CreateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employee = Employee::first();
        $employee->update([
            'created_by'=>1,
            'updated_by'=>1,
        ]);

        $branche = Branch::first();
        $branche->update([
            'created_by'=>1,
            'updated_by'=>1,
        ]);
    }
}
