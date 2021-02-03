<?php

namespace Cms\Http\Middleware;

use Closure;
use Gate;

class Cms
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // if (Gate::allows('siravel')) {
            return $next($request);
        // }

        return response('Unauthorized.', 401);
    }
}
