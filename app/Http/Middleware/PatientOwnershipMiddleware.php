<?php

namespace App\Http\Middleware;

use Closure;
use function response;

class PatientOwnershipMiddleware
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

        $patient = ($request->route()->parameter('patient'));
        $p = $request->user()->patients()->where('patients.id', $patient->id)->first() ?? false;

        if (!$p)
            return response('Invalid Request', 401);

        return $next($request);
    }
}
