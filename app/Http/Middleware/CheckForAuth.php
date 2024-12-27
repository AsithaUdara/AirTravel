<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class CheckForAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is trying to access the login page
        if ($request->is('admin/login')) {
            // If the admin is already logged in, redirect them to the dashboard
            if (Auth::guard('admin')->check()) {
                return redirect()->route('admins.dashboard');
            }
        }

        // Continue with the request if the login page is not being accessed
        return $next($request);
    }
}



