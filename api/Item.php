<?php
/**
 * Item Model Class for labor hrs and parts prices.
 *
 * @author: Cuesta
 */

namespace Api;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use SoftDeletes;

    protected $fillable = ['cost', 'description', 'provider', 'is_labor', 'name'];
    protected $hidden = ['pivot'];
    protected $casts = [
        'cost' => 'integer',
        'is_labor' => 'boolean'
    ];

    public function invoice()
    {
        return $this->belongsTo('App\Invoice');
    }
}