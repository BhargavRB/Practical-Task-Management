<?php

namespace App\Services;

use App\Models\Task;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class TaskService
{
    public function getPaginatedTasksForUser(User $user, array $filters = [], string $sortField = 'created_at', string $sortDirection = 'desc'): LengthAwarePaginator
    {
        return $user->tasks()
            ->with('category')
            ->when(isset($filters['search']), function ($query) use ($filters) {
                $query->where(function ($q) use ($filters) {
                    $q->where('title', 'like', '%'.$filters['search'].'%')
                      ->orWhere('description', 'like', '%'.$filters['search'].'%');
                });
            })
            ->when(isset($filters['status']), function ($query) use ($filters) {
                $query->where('status', $filters['status']);
            })
            ->when(isset($filters['category_id']), function ($query) use ($filters) {
                $query->where('category_id', $filters['category_id']);
            })
            ->orderBy($sortField, $sortDirection)
            ->paginate(10);
    }

    public function createTask(array $data, User $user): Task
    {
        return $user->tasks()->create($data);
    }

    public function updateTask(Task $task, array $data): bool
    {
        return $task->update($data);
    }

    public function deleteTask(Task $task): bool
    {
        return $task->delete();
    }

    public function getTaskWithCategory(Task $task): Task
    {
        return $task->load('category');
    }
}