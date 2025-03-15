<?php

namespace Database\Seeders;

use App\Models\Attribute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Attribute::create(['name' => 'years_experience', 'type' => 'number']);
        Attribute::create(['name' => 'start_date', 'type' => 'date']);
        Attribute::create(['name' => 'requires_equipment', 'type' => 'boolean']);
        Attribute::create([
            'name' => 'employment_level',
            'type' => 'select',
            'options' => json_encode(['junior', 'mid', 'senior']),
        ]);
    }
}
