<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use phpDocumentor\Reflection\Types\Integer;

class Payment extends Model
{
    use SoftDeletes;

    protected $casts = [
        'id' => 'integer',
        'invoice_id' => 'integer',
        'net' => 'integer',
        'tip' => 'integer',
        'fees' => 'integer',
        'merchant_fees' => 'integer',
        'cc_last_four' => 'integer',
        'ref' => 'integer',
        'type' => 'integer'
    ];

    protected $fillable = ['net', 'tip', 'fees', 'type', 'merchant_fees', 'cc_last_four'];
    protected $hidden = ['pivot'];

    const CASH = '1';
    const CARD_SLIDE = '2';
    const CARD_ONLINE = '4';

    public function invoice()
    {
        return $this->belongsTo('App\Invoice');
    }

    public static function generateRef(int $invoiceId, int $type) : int
    {
        $seed = str_split('0123456789');
        shuffle($seed); // probably optional since array_is randomized; this may be redundant
        $number = '';
        foreach (array_rand($seed, 4) as $k) $number .= $seed[$k];

        return $type.$invoiceId.$number;
    }
}
