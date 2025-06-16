<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Models\Category;
use App\Services\TaskService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index(Request $request)
    {
        $sortField = $request->get('sort_by', 'created_at');
        $sortDirection = $request->get('sort_dir', 'desc');
        
        $filters = [
            'search' => $request->get('search'),
            'status' => $request->get('status'),
            'category_id' => $request->get('category_id')
        ];

        $tasks = $this->taskService->getPaginatedTasksForUser(
            $request->user(), 
            $filters,
            $sortField,
            $sortDirection
        );  

        $categories = Category::select('id','name')->get();

        return view('tasks.index', compact('tasks', 'categories', 'filters', 'sortField', 'sortDirection'));
    }

    public function create()
    {
        $categories = Category::select('id','name')->get();

        return view('tasks.create', compact('categories'));
    }

    public function store(StoreTaskRequest $request)
    {
        $this->taskService->createTask($request->validated(), $request->user());

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    public function show(Task $task)
    {

        $task = $this->taskService->getTaskWithCategory($task);

        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {    
        $categories = Category::select('id','name')->get();

        return view('tasks.edit', compact('task', 'categories'));
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        $this->taskService->updateTask($task, $request->validated());
        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        $this->taskService->deleteTask($task);
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}