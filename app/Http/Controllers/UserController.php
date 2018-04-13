<?php

namespace Api\Http\Controllers;

use Api\Exceptions\{
    BadInputException, ModelNotFoundException
};
use Api\User;
use Illuminate\Http\Request;
use Validator;

class UserController extends Controller
{
    public function all()
    {
    	$users = User::orderBy('name')->get();
    	foreach($users as $user) {
    	    $user->invoices;
        }

        return $users;
    }

    public function getUsersByRole($role)
    {
    	$users = User::role($role)->get();
    	foreach($users as $user) {
    	    $user->invoices();
        }

        if($users->isEmpty()) {
    	    throw new ModelNotFoundException('USERS_NOT_FOUND');
        }

    	return $users;
    }

    public function get($user)
    {
        return $user;
    }

    public function store(Request $request)
    {
	    $this->validate($request, [
		    'name' => 'required|max:191',
		    'username' => 'required|max:30|unique:users',
		    'email' => 'required|unique:users|email',
			'role' => 'nullable|integer'
	    ]);

	    #TODO: Send password reset email
	    $user = new User($request->all());
	    $user->password = str_random();
	    $user->save();

        return $user;
    }

	public function update(Request $request, User $user)
	{


    dd($user);

//		$this->validate($request, [
//			'name' => 'nullable|max:191',
//            'email' => 'nullable|unique:users,email,'.$user->id.'|email',
//			'role' => 'nullable|integer'
//		]);
//
//		$user = $user->fill($request->all());
//        $user->save();
//
//		return $user;
	}

	public function destroy(User $user)
	{
		return ['success' => $user->delete()];
	}
}
