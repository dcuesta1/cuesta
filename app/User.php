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
        'name', 'email', 'username'
    ];

    /**
     *   The attributes that should be cast to native types.
     *
     * @var array
     */

    protected $casts = [
        'id' => 'integer',
        'role' => 'integer'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     *
     * fendoandres  alavarez cristian
     */
    protected $hidden = [
        'password', 'pivot'
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

	public function invoices()
    {
        return $this->hasMany('App\Invoice')->orderByDesc('created_at');
    }

    public function customers()
    {
        return $this->hasMany(('App\Customer'));
    }
}

