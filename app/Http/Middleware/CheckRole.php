<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
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
        if($request->user()->hasRole('admin')){
            return redirect()->route('home');
        }

        if($request->user()->hasRole('companies')){
            return redirect()->route('home');
        }
    }
}
