<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Session;

class CheckForPrice
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
{
    // Check if the current route is 'traveling/success' or 'traveling/pay'
    if ($request->routeIs('traveling.success') || $request->routeIs('traveling.pay')) {
        if (!Session::has('price') || Session::get('price') == 0) {
            return abort(403, 'Forbidden: Invalid or missing price');
        }
    }
    
    return $next($request);
}

}
