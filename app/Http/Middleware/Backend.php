<?php

namespace App\Http\Middleware;

use Closure;
use Gate;
use gateweb\common\Presenter;

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
            Presenter::message('This action is unauthorized');
            return redirect(route('frontend.home'));
        }
        
        return $next($request);

    }
}
