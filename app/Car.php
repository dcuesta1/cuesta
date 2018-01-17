<?php

namespace App;
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

    function customer()
    {
        return $this->belongsTo('App\Customer');
    }
}