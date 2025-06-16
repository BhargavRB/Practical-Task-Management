<?php

use App\Models\Task;
use App\Policies\TaskPolicy;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\CheckTaskOwnership;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',  
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'task.owner' => CheckTaskOwnership::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
