<?php

namespace MillCloud\LaravelIgnition\Http\Middleware;

use Closure;
use MillCloud\LaravelIgnition\Support\RunnableSolutionsGuard;

class RunnableSolutionsEnabled
{
    public function handle($request, Closure $next)
    {
        if (! RunnableSolutionsGuard::check()) {
            abort(404);
        }

        return $next($request);
    }
}
