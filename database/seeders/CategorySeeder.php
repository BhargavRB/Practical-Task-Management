<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Work', 'description' => 'Tasks related to job or professional work'],
            ['name' => 'Personal', 'description' => 'Personal tasks and errands'],
            ['name' => 'Shopping', 'description' => 'Things to buy'],
            ['name' => 'Health', 'description' => 'Health and fitness related tasks'],
            ['name' => 'Learning', 'description' => 'Educational and skill development tasks'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
