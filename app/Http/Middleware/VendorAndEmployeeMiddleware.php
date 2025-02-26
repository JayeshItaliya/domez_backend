<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VendorAndEmployeeMiddleware
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
        if (in_array(auth()->user()->type, [2, 4])) {
            return $next($request);
        }
        return redirect()->back();
    }
}
