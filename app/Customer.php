<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;

    protected $hidden = ['pivot'];

    protected $fillable = ['first_name', 'last_name', 'phone', 'email', 'address_one', 'address_two', 'city', 'state'];

    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer'
    ];

    /* Relationships */

    public function invoices()
    {
        return $this->belongsToMany('App\Invoice', 'car_customer_invoice');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /* Getters */

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

}
