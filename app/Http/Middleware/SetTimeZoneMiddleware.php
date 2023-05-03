<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetTimeZoneMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        date_default_timezone_set(config('app.timezone'));
        if (config('app.env') == 'production') {
            if (strpos($request->header('User-Agent'), 'Mobile') !== false || strpos($request->header('User-Agent'), 'Android') !== false || strpos($request->header('User-Agent'), 'iPhone') !== false) {
                // Request is coming from a mobile device
            } else {
                abort(404);
            }
        }
        return $next($request);
    }
}
