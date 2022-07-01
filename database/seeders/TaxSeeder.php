<?php

namespace Database\Seeders;

use App\Models\Tax;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tax::create([
            'name' => 'VAT',
            'value' => 20,
            'type' => 'percentage',
        ]);
        Tax::create([
            'name' => 'GST',
            'value' => 18,
            'type' => 'percentage',
        ]);
    }
}
