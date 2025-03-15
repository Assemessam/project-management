<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\Occupation;
use App\Models\OccupationAttributeValue;
use Illuminate\Database\Seeder;

class OccupationAttributeValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $attributes = Attribute::all();
        $occupations = Occupation::all();

        foreach ($occupations as $occupation) {
            foreach ($attributes as $attribute) {
                $value = match ($attribute->type) {
                    'number' => rand(1, 10),
                    'boolean' => rand(0, 1), // stored as integer
                    'date' => now()->subDays(rand(1, 365))->toDateString(),
                    'text' => 'Sample text',
                    'select' => collect(json_decode($attribute->options, true))->random(),
                    default => '',
                };

                OccupationAttributeValue::create([
                    'occupation_id' => $occupation->id,
                    'attribute_id' => $attribute->id,
                    'value' => (string) $value, // always store as string
                ]);
            }
        }
    }
}
