<?php

namespace App\Http\Middleware;

use App\Exceptions\UnauthorizedAccessException;
use Auth;
use Closure;

class SuperuserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     * @throws UnauthorizedAccessException
     */
    public function handle($request, Closure $next)
    {
    	if(!Auth::user()->isSuperuser()){
    		throw new UnauthorizedAccessException('insufficient_permission');
	    }

        return $next($request);
    }
}
