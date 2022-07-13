<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'key' => 'company_name',
            'value' => 'Laravel',
        ]);
        Setting::create([
            'key' => 'company_address',
            'value' => 'Laravel',
        ]);
        Setting::create([
            'key' => 'company_phone',
            'value' => 'Laravel',
        ]);
        Setting::create([
            'key' => 'company_email',
            'value' => 'Laravel',
        ]);
        Setting::create([
            'key' => 'id_format',
            'value' => '{{INDEX}}',
        ]);
    }
}
