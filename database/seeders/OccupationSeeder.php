<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Language;
use App\Models\Location;
use App\Models\Occupation;
use Illuminate\Database\Seeder;

class OccupationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $occupations = [
            [
                'title' => 'Full Stack Web Developer',
                'description' => 'Build and maintain modern web applications using Laravel and Vue.js.',
                'company_name' => 'CodeWave',
                'salary_min' => 55000,
                'salary_max' => 85000,
                'is_remote' => true,
                'job_type' => 'full-time',
                'status' => 'published',
            ],
            [
                'title' => 'Frontend Engineer',
                'description' => 'Develop user interfaces with React and Tailwind CSS.',
                'company_name' => 'PixelPerfect Ltd.',
                'salary_min' => 60000,
                'salary_max' => 90000,
                'is_remote' => false,
                'job_type' => 'contract',
                'status' => 'published',
            ],
            [
                'title' => 'Backend Developer',
                'description' => 'API development using Laravel and PostgreSQL.',
                'company_name' => 'TechBridge',
                'salary_min' => 65000,
                'salary_max' => 95000,
                'is_remote' => true,
                'job_type' => 'freelance',
                'status' => 'published',
            ],
            [
                'title' => 'DevOps Engineer',
                'description' => 'Manage CI/CD pipelines and cloud infrastructure.',
                'company_name' => 'CloudStream',
                'salary_min' => 70000,
                'salary_max' => 105000,
                'is_remote' => true,
                'job_type' => 'full-time',
                'status' => 'published',
            ],
            [
                'title' => 'Mobile App Developer',
                'description' => 'Develop cross-platform apps using Flutter.',
                'company_name' => 'AppNest',
                'salary_min' => 60000,
                'salary_max' => 88000,
                'is_remote' => false,
                'job_type' => 'full-time',
                'status' => 'draft',
            ],
        ];

        $categoryMap = [
            'Full Stack Web Developer' => ['Full Stack Development', 'Web Development'],
            'Frontend Engineer' => ['Frontend Development', 'Web Development'],
            'Backend Developer' => ['Backend Development', 'Software Engineering'],
            'DevOps Engineer' => ['DevOps', 'Software Engineering'],
            'Mobile App Developer' => ['Mobile Development', 'Software Engineering'],
        ];

        foreach ($occupations as $data) {
            $occupation = Occupation::create([
                ...$data,
                'published_at' => now(),
            ]);

            // Assign relevant languages based on title
            $languages = match (true) {
                str_contains($data['title'], 'Web Developer') => ['PHP', 'JavaScript'],
                str_contains($data['title'], 'Frontend') => ['JavaScript'],
                str_contains($data['title'], 'Backend') => ['PHP'],
                str_contains($data['title'], 'DevOps') => ['Python', 'Ruby'],
                str_contains($data['title'], 'Mobile') => ['Java'],
                default => ['PHP']
            };

            $languageIds = Language::whereIn('name', $languages)->pluck('id');
            $locationIds = Location::inRandomOrder()->limit(2)->pluck('id');

            $categories = $categoryMap[$data['title']] ?? ['Software Engineering'];
            $categoryIds = Category::whereIn('name', $categories)->pluck('id');

            $occupation->languages()->sync($languageIds);
            $occupation->locations()->sync($locationIds);
            $occupation->categories()->sync($categoryIds);
        }
    }
}
