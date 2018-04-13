<?php

namespace Api\Http\Controllers;

use Api\Exceptions\BadInputException;
use Api\{
    Http\PaymentHelper, Invoice, Payment
};
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\In;

class PaymentController extends Controller
{
    public function index()
    {

    }

    public function show($id)
    {
        #todo: not in use.
        $payments = Payment::all();
        return $payments;
    }

    public function create(Request $request, $id)
    {

        $this->validate($request, [
            'net' => 'required|numeric',
            'tip' => 'required|numeric',
            'fees' => 'required|numeric',
            'type' => 'required|numeric',
            'merchant_fees' => 'numeric',
            'cc_last_four' => 'numeric'
        ]);

        $invoice = Invoice::findOrFail($id);

        if($invoice->status === Invoice::CLOSED) {
            throw new BadInputException('This invoice has been fully paid');
        }

        // Check ownership
        if(!$this->user()->isSuperuser() && $this->user()->id === $invoice->user_id) {
            throw new ModelNotFoundException();
        }

        $payment = new Payment($request->all());
        $payment->ref = Payment::generateRef($invoice->id, $request->input('type'));

        // Check for overpayment;
        #TODO: fix balanca caching problem.
        $balance = $invoice->balance();
        if($balance < $payment->net) {
            throw new BadInputException('Payment exceeds balance.');
        }

        $payment = $invoice->payments()->save($payment);

        if(!$balance - $payment->net) {
            $invoice->status = Invoice::CLOSED;
            $invoice->save();
        }


        return $payment;
    }

    #todo: not in use
    public  function update(Request $request, $id)
    {

    }

    #todo: not in use
    public function destroy($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();

        return 1;
    }
}