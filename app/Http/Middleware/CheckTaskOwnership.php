<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckTaskOwnership
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $task = $request->route('task'); // Implicit model binding
  
        if (!empty($task) && $task->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
