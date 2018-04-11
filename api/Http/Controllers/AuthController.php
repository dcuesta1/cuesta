<?php

namespace Api\Http\Controllers;

use Api\AuthToken;
use Api\Exceptions\BadInputException;
use Api\Exceptions\UnauthorizedAccessException;
use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{
	public function authenticate(Request $request)
    {
        $credentials = ['email' => $request->email, 'password' => $request->password];

        if (!Auth::attempt($credentials)) {
            throw new UnauthorizedAccessException('INVALID_CREDENTIALS');
        }

        if (empty($request->device)) {
            throw new BadInputException('MISSING_DEVICE');
        }

        $user = Auth::user();
        $token = new AuthToken($request->all());
        $token->value = authenticator()->hash();
        $user->authTokens()->save($token);

        return response($user)
            ->header('token', $token->value);
    }
}
