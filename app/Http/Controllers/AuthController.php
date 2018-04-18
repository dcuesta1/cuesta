<?php

namespace App\Http\Controllers;

use App\{ AuthToken, User};
use App\Exceptions\BadInputException;
use App\Exceptions\UnauthorizedAccessException;
use Illuminate\Http\Request;
use Auth, Validator;

class AuthController extends Controller
{
	public function authenticate(Request $request)
    {
        $credentials = ['email' => $request->email, 'password' => $request->password];

        if (!Auth::attempt($credentials)) {
            throw new UnauthorizedAccessException('INVALID_CREDENTIALS');
        }

        if (empty($request->device)) {
            throw new BadInputException('MISSING_DEVICE_ID');
        }

        $user = Auth::user();
        $token = new AuthToken($request->all());
        $token->value = authenticator()->hash();
        $user->authTokens()->save($token);

        return response($user)
            ->header('token', $token->value);
    }

    public function register(Request $request)
    {
        if (empty($request->device)) {
            throw new BadInputException('MISSING_DEVICE_ID');
        }

        $validation = Validator::make($request->user, [
            'name' => 'required|max:191',
            'username' => 'required|max:30|unique:users',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:8' // TODO: establish password regex
        ]);

        if($validation->fails()) {
            throw new BadInputException('BAD_DATA_ENTRY');
        }
        #TODO: Send email confirmation
        $user = new User($request->user);
        $user->role = 2;
        $user->password = Authenticator()->encrypt($request->input('user.password'));
        $user->save();

        $token = new AuthToken();
        $token->value = Authenticator()->hash();
        $token->device = $request->device;
        $user->authTokens()->save($token);

        return response($user)
            ->header('token', $token->value);
    }
}
