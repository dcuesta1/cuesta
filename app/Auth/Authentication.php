<?php

namespace App\Auth;
use App\AuthToken;
use App\Exceptions\UnauthorizedAccessException;
use Auth;
use Carbon\Carbon;
use Hash;

class Authentication {

	private $_refreshed;

	public function attempt($token)
	{
		$this_refreshed = null;

		if(!$token = AuthToken::where('value', $token)->first()) {
			throw new UnauthorizedAccessException('invalid_token');
		}

		$expirationDate = Carbon::parse($token->updated_at)->addDays(30);

		if($expirationDate <= Carbon::now()) {
			throw new UnauthorizedAccessException('token_expired');
		} else if($expirationDate->diffInDays(Carbon::now()) <= 7){
			$token->value = $this->hash();
			$token->save();
			$this->_refreshed = $token->value;
		}

		Auth::login($token->user);

		return $this;
	}

	public function hash($n = 64)
	{
		return bin2hex(random_bytes($n));
	}

	public function encrypt($string)
	{
		return bcrypt($string);
	}

	public function user()
	{
		return $this->_user;
	}

	public function refreshed()
	{
		return $this->_refreshed;
	}

}