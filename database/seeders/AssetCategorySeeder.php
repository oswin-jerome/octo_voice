<?php

namespace Database\Seeders;

use App\Models\Asset;
use App\Models\AssetCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AssetCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AssetCategory::create([
            'name' => 'Camera',
            'description' => 'Computer assets',
        ]);
        AssetCategory::create([
            'name' => 'Lighting',
            'description' => 'Computer assets',
        ]);
        AssetCategory::create([
            'name' => 'Storage',
            'description' => 'Computer assets',
        ]);
    }
}
