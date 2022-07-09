<?php

namespace Database\Seeders;

use App\Models\Deliverable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeliverableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Deliverable::create([
            'name' => 'Indoor Photography',
            'description' => 'Indoor photography is the photography of indoor spaces. It is a type of photography that is done in a space, usually a building, or a room.',
            'price' => 100,
            'unit' => 'hour',
        ]);
        Deliverable::create([
            'name' => 'Outdoor Photography',
            "description" => "Outdoor photography is the photography of outdoor spaces. It is a type of photography that is done in a space, usually a building, or a room.",
            'price' => 100,
            'unit' => 'hour',
        ]);
    }
}
