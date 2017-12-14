<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;
    const SUPERUSER = 1;
    const ADMIN = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function isSuperuser()
    {
    	return ($this->role === self::SUPERUSER);
    }

    public function isAdmin()
    {
    	return ($this->role === self::ADMIN);
    }

	public function scopeRole($query, $role)
	{
		return $query->where('role', '=', $role);
	}

	public function authTokens()
	{
		return $this->hasMany('App\AuthToken');
	}

}
