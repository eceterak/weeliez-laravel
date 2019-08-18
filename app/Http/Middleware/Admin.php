<?php

namespace App\Http\Middleware;

use Closure;

class Admin 
{
    /**
     * Check if user has admin privileges.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) 
    {
        if(auth()->check()) 
        {
            if(auth()->user()->isAdmin) 
            {
                return $next($request);
            }
            else 
            {
                return redirect()->route('home'); // User is not an admin.
            }
        }
        else 
        {
            return redirect()->route('admin.login'); // User is not logged in.
        }
    }
}