<?php

namespace Database\Seeders;

use App\Models\ExpenseCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExpenseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ExpenseCategory::create([
            'name' => 'Salary',
        ]);
        ExpenseCategory::create([
            'name' => 'Editing',
        ]);
        ExpenseCategory::create([
            'name' => 'Transportation',
        ]);
    }
}
