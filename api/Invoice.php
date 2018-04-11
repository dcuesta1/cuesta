<?php

namespace Api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use SoftDeletes;

    const PENDING_PAYMENT = 1;
    const ESTIMATE = 2;
    const CLOSED = 4;
    const CANCELLED = 8;

    protected $fillable = ['cost, car_id'];
    protected $guarded = ['status', 'user_id', 'number'];
    protected $hidden = ['pivot'];

    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'car_id' => 'integer',
        'number' => 'string',
        'cost' => 'integer'
    ];

    // RELATIONSHIPS

    public function payments()
    {
        return $this->hasMany('App\Payment');
    }

    public function customer()
    {
        return $this->belongsToMany('App\Customer');
    }

    public function car()
    {
        return $this->belongsToMany('App\Car');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function items()
    {
        return $this->hasMany('App\Item');
    }

    /* Helper Functions */

    public static function generateNumber($customerId, $userId)
    {
        $seed = str_split('0123456789abcdefghijklmnopqrstuvwxyz');
        shuffle($seed); // probably optional since array_is randomized; this may be redundant
        $number = '';
        foreach (array_rand($seed, 5) as $k) $number .= $seed[$k];

        return $userId.date('y').$customerId.$number;
    }

    /**
     * balance
     *
     * Subtracts net payed from invoice cost to return the outstanding balance.
     *
     * @return float
     */
    public function balance() :int
    {
        return ($this->cost - $this->net());
    }

    /**
     * net
     *
     * Returns sum of all net of payments
     *
     * @return int
     */
    public function net() :int
    {
        $payments = $this->payments;

        $net = 0;
        foreach ($payments as $payment) {
            $net += $payment->net;
        }

        return $net;
    }

    /**
     * tips
     *
     * Returns sum of all the tips made in payments to this invoice.
     *
     * @return int
     */
    public function tips() :int
    {
        $payments = $this->payments;

        $tips = 0;
        foreach ($payments as $payment) {
            $tips += $payment->tip;
        }

        return $tips;
    }

    /**
     * merchantFees
     *
     * Returns the sum of all credit card transaction fees.
     *
     * @return int
     */
    public function merchantFees() :int
    {
        $payments = $this->payments;

        log($payments);

        $merchantFees = 0;
        foreach ($payments as $payment) {
            $merchantFees += $payment->merchant_fees;
        }

        return $merchantFees;
    }

    /**
     * Fees
     *
     *
     * @return int
     */
    public function fees() :int
    {
        $payments = $this->payments;

        $fees = 0;
        foreach ($payments as $payment) {
            $fees += $payment->fees;
        }

        return $fees;
    }

    /**
     * totalPaid
     *
     * Returns all the ammount the customer has paid including all fees, tips and net.
     * @return int
     */
    public function totalPaid() :int
    {
        $payments = $this->payments;

        return ($this->net() + $this->tips() + $this->merchantFees() + $this->fees());
    }

}
