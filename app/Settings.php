<?php

namespace App;

use Illuminate\Database\Eloquent\{ Model, SoftDeletes};

class Settings extends Model
{
    use SoftDeletes;

    const FREE = 0;
    const BASIC = 1;
    const PREMIUM = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'business_name',
        'business_email',
        'business_phone',
        'user_id', // TODO: remove, server should establish it
        'fee',
        'tax',
        'plan', // TODO: remove, server should establish it
        'expiration',
        'sq_merchant_id',
        'sq_subscription_id'
    ];

    /**
     *   The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'fee' => 'float',
        'tax' => 'float',
        'plan' => 'integer'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     *
     */
    protected $hidden = ['sq_merchant_id', 'sq_subscription_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}