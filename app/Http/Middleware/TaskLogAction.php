<?php

namespace App\Http\Middleware;

use App\Models\TaskLog;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TaskLogAction
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if ($request->isMethod('post') || $request->isMethod('put') || $request->isMethod('delete')) {
            TaskLog::create([
                'user_id' => auth()->id(),
                'action' => $request->method() . ' ' . $request->path(),
                'endpoint' => $request->path(),
                'created_at' => now(),
                'update_at' => now(),
            ]);
        }
        return $next($request);
    }
}
