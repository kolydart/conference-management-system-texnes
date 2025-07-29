<?php

namespace App\Http\Middleware;

use Closure;
use Gate;

class Backend
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
        if( Gate::denies('backend_access') ){
            return redirect(route('frontend.home'))->with('error', 'This action is unauthorized');
        }
        
        return $next($request);

    }
}
