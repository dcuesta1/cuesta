<?php

namespace Api\Http;


use Api\Invoice;
use Illuminate\Validation\Rules\In;

/**
 * Class PaymentHelper
 * @package App\Http
 */
class PaymentHelper
{
    /**
     * balance
     *
     * Subtracts net payed from invoice cost to return the outstanding balance.
     *
     * @param Invoice $invoice
     *
     * @return float
     */
    public static function balance(Invoice $invoice) :float
    {
        return ($invoice->cost - self::net($invoice));
    }

    public static function net(Invoice $invoice) :float
    {
        $payments = $invoice->payments;

        $net = 0.00;
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
     * @param Invoice $invoice
     *
     * @return float
     */
    public static function tips(Invoice $invoice) :float
    {
        $payments = $invoice->payments;

        $tips = 0.00;
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
     * @param Invoice $invoice
     *
     * @return float
     */
    public static function merchantFees(Invoice $invoice) :float
    {
        $payments = $invoice->payments;

        $merchantFees = 0.00;
        foreach ($payments as $payment) {
            $merchantFees += $payment->merchant_fees;
        }

        return $merchantFees;
    }

    /**
     * Fees
     *
     * Returns the sum of all company fees
     *
     * @param Invoice $invoice
     *
     * @return float
     */
    public static function fees(Invoice $invoice) :float
    {
        $payments = $invoice->payments;

        $fees = 0.00;
        foreach ($payments as $payment) {
            $fees += $payment->fees;
        }

        return $fees;
    }

    /**
     * totalPaid
     *
     * Returns all the amount the customer has paid including all fees, tips and net.
     * @param Invoice $invoice
     *
     * @return float
     */
    public static function totalPaid(Invoice $invoice) :float
    {
        $payments = $invoice->payments;

        return (self::net($invoice) + self::tips($invoice) + self::merchantFees($invoice) + self::fees($invoice));
    }
}