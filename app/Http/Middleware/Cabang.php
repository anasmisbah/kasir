<?php

namespace App\Http\Middleware;

use Closure;

class Cabang
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()->level == 'cabang') {
            return $next($request);
        }
        return redirect()->route('login');
    }
}
