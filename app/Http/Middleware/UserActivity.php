<?php

namespace App\Http\Middleware;

use App\Events\UserActivity as EventsUserActivity;
use Closure;
use Illuminate\Http\Request;

class UserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Track user's activities
        event(new EventsUserActivity($request));

        return $response;
    }
}
