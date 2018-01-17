<?php

namespace App\Http\Controllers;

use App\Exceptions\{BadInputException, ModelNotFoundException};
use App\User;
use Illuminate\Http\Request;
use Validator;

class UserController extends Controller
{
    public function index()
    {
    	$users = User::orderBy('name')->get();
    	foreach($users as $user) {
    	    $user->invoices;
        }
    	return $users;
    }

    public function getUsersByRole($roleId)
    {
    	$users = User::role($roleId)->get();
    	//if(!count($users)) throw new ModelNotFoundException();
    	foreach($users as $user) {
    	    $user->invoices();
        }

    	return $users;
    }

    public function show($id)
    {
    	$id = $this->getCurrentUser()->isSuperuser() ?  $id : $this->getCurrentUser()->id;

    	$user = User::findOrFail($id);
    	return $user;
    }

    public function create(Request $request)
    {
	    $validator = Validator::make($request->all(), [
		    'name' => 'required|max:191',
		    'username' => 'required|max:30|unique:users',
		    'email' => 'required|unique:users|email',
			'role' => 'nullable|integer'
	    ]);

	    if(!$validator->passes()) {
			throw new BadInputException('validation_failed');
	    }

	    #TODO: send password email to user
	    $user = User::create($request->all());
		$user->password = bcrypt(str_random(18));
		$user->save();

	    return $user;
    }

	public function update(Request $request, int $id)
	{
		$id = $this->getCurrentUser()->isSuperuser() ?  $id : $this->getCurrentUser()->id;

		$validator = Validator::make($request->all(), [
			'name' => 'nullable|max:191',
            'email' => 'nullable|unique:users,email,'.$id.'|email',
			'role' => 'nullable|integer'
		]);

		if(!$validator->passes()) {
			throw new BadInputException('validation_failed');
		}

		$user = User::findOrFail($id);
		$user->update($request->all());
		dd($user);
		$user->role = User::ADMIN;
		$user->save();

		return $user;
	}

	public function destroy($id)
	{
		$user = User::findOrFail($id);
		$user->delete();
		return 1;
	}
}
