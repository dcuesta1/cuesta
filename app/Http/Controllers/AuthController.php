<?php

namespace App\Http\Controllers;

use App\AuthToken;
use App\Exceptions\UnauthorizedAccessException;
use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{
	public function authenticate(Request $request)
	{
		$credentials = ['email' => $request->email, 'password' => $request->password];

		if(!Auth::attempt($credentials)) {
			throw new UnauthorizedAccessException('invalid_credentials');
		}

		$user = Auth::user();
		$token = new AuthToken();
		$token->value = authenticator()->hash();
		$token->device = $request->device;
		$user->authTokens()->save($token);

		return [
			'user' => $user,
			'token' => $token->value
		];
	}

}
