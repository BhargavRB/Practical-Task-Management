<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    public function run()
    {
        // Get or create a test user
        $user = User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => bcrypt('password'),
            ]
        );

        $tasks = [
            [
                'title' => 'Complete project report',
                'description' => 'Finish the quarterly project report for management',
                'category_id' => 1, // Work
                'due_date' => now()->addDays(3),
                'status' => 'pending',
                'priority' => 'high'
            ],
            [
                'title' => 'Buy groceries',
                'description' => 'Milk, eggs, bread, and vegetables',
                'category_id' => 3, // Shopping
                'due_date' => now()->addDay(),
                'status' => 'pending',
                'priority' => 'medium'
            ],
        ];

        foreach ($tasks as $task) {
            $user->tasks()->create($task);
        }
    }
}