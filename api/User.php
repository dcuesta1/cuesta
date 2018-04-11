<?php

namespace Api;

use Api\Http\Controllers\UserController;
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
    protected $fillable = ['name', 'email', 'username'];

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
     */
    protected $hidden = ['password', 'pivot'];

    // ROLE HELPER FUNCTIONS

    /**
     * Cheks if the current user is of role: Superuser
     *
     * @return bool
     */
    public function isSuperuser()
    {
    	return ($this->role === self::SUPERUSER);
    }

    /**
     * Checks if the current user is of role: Admin
     *
     * @return bool
     */
    public function isAdmin()
    {
    	return ($this->role === self::ADMIN);
    }

    // SCOPE FUCNTIONS

    /**
     * Helper to retrive users by role
     *
     * @usedBy UserController:getUsersByRole
     * @param $query
     * @param $role
     * @return mixed
     */
	public function scopeRole($query, $role)
	{
		return $query->where('role', '=', $role);
	}

	// RELATIONSHIPS

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
