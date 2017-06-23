<?php

namespace App\Http\Middleware;

use Closure;

class LabOwnershipMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $id = $request->route()->parameter('id')->id ?? $request->input('lab_id', 0);

        if ($request->user()->labs()->where('labs.id', $id)->count() < 1) {
            return response()->json(['Invalid Request']);
        }
        return $next($request);
    }
}
