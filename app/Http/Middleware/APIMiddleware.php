<?php

namespace App\Http\Middleware;

use Closure;
use function method_exists;
use function response;

class APIMiddleware
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
        $response = $next($request);

        if ($request->wantsJson() || $request->acceptsJson()) {

            return response()->api((method_exists($response, 'getData')) ? $response->getData() : $response->content(), 200, $response->status() == 200 ? false : true);
        }

        return $response;
    }
}
