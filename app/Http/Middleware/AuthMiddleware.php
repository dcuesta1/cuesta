<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
//use Illuminate\Http\RedirectResponse;

class AuthMiddleware
{
	public function handle($request, Closure $next)
	{
		Authenticator()->attempt($request->header('Authorization'));

		$response = $next($request);

		if(Authenticator()->refreshed()) {
		//	$response = $response instanceof RedirectResponse ? $response : response($response);
			return $response->header('refreshed', Authenticator()->refreshed());
		}

		return $response;
	}
}
