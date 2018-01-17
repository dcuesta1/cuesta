<?php

use App\AuthToken;
use App\Invoice;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
	const SUPERUSER_TOKEN = "09652dd658c893862eb687af55b9716e304650a53957f8d2a6dcdb616a6542df36ad9a86889be77ac4f405da8fd567f31c6c5acf6d091697546dd1b7a0521957";
	const ADMIN_TOKEN = "b2d76cc6ea6780b97371dbb3633b334e447c045236a94befdf3d82b812b8543093d4f3a6df5144474267f3df57f7e45187a31d74390baa53d6af56d03eb77d22";

	public function run()
	{
		/*
		 *  Create one user of each role static for constant api testing
		 */

		// Create a static Superuser
		$superUser = User::create([
			'name' => 'Daniel Cuesta',
			'username' => 'dcuesta',
			'email' => 'cuestadaniel31@gmail.com',
			'password' => authenticator()->encrypt('password'),
			'role' => User::SUPERUSER
		]);

		$authToken = new AuthToken();
		$authToken->value = self::SUPERUSER_TOKEN;
		$authToken->device = str_random(12);
		$superUser->authTokens()->save($authToken);

		//create static Admin User
		$superUser = User::create([
			'name' => 'John Doe',
			'username' => 'djoe',
			'email' => 'jdoe@gmail.com',
			'password' => authenticator()->encrypt('password'),
			'role' => User::ADMIN
		]);

		$authToken = new AuthToken();
		$authToken->value = self::ADMIN_TOKEN;
		$authToken->device = str_random(12);
		$superUser->authTokens()->save($authToken);

		factory(App\User::class, 3)->create()->each(function (User $user) {
			$authToken = new AuthToken();
			$authToken->value = authenticator()->hash();
			$authToken->device = str_random(12);
			$user->authTokens()->save($authToken);
		});
	}
}
