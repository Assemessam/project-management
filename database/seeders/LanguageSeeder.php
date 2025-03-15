<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $languages = ['PHP', 'JavaScript', 'Python', 'Ruby', 'Java'];

        foreach ($languages as $lang) {
            Language::firstOrCreate(['name' => $lang]);
        }
    }
}
