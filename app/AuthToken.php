<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuthToken extends Model
{
    protected $fillable = ['value', 'user_id', 'device'];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
