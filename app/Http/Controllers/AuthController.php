<?php

namespace App\Http\Controllers;

use App\AuthToken;
use App\Exceptions\BadInputException;
use App\Exceptions\UnauthorizedAccessException;
use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{
	public function authenticate(Request $request)
    {
        $credentials = ['email' => $request->email, 'password' => $request->password];

        if (!Auth::attempt($credentials)) {
            throw new UnauthorizedAccessException('invalid_credentials');
        }

        if (empty($request->device)) {
            throw new BadInputException('missing_device');
        }

        $user = Auth::user();
        $token = new AuthToken($request->all());
        $token->value = authenticator()->hash();
        $user->authTokens()->save($token);

        return response($user)
            ->header('token', $token->value);
    }
}
