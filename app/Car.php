<?php

namespace Api;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{
    use SoftDeletes;

    protected $hidden = ['pivot'];
    protected $fillable = ['model', 'make', 'year', 'number'];
    protected $casts = [
        'year' => 'integer',
        'customer_id' => 'integer'
    ];

    function invoices()
    {
        return $this->belongsToMany('Api\Invoice', 'car_customer_invoice');
    }

    function customer()
    {
        return $this->belongsTo('Api\Customer');
    }
}