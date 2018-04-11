<?php

namespace Api\Http\Controllers;

use Api\Exceptions\{ModelNotFoundException, BadInputException};
use Api\{Customer, Invoice, User};
use Illuminate\Http\Request;
use Input, Validator;

class InvoiceController extends Controller
{
    public function all()
    {
        $invoices = Invoice::all();

        foreach($invoices as $invoice) {
            $invoice->payments;
            $invoice->customer;
        }

        return $invoices;
    }


    public function userInvoices(User $username) {
        $user = $this->user()->isSuperuser() ? $username : $this->user();

        $invoices = $user->invoices;

        foreach ($invoices as $invoice) {
            $invoice->payments;
            $customer = $invoice->customer()->withTrashed()->get();
            $car = $invoice->car()->withTrashed()->get();

            $invoice->customer = $customer;
            $invoice->car = current($car)[0];
        }

        return $invoices;
    }

    public function get(Invoice $invoice)
    {
        return $invoice;
    }

    /**
     *  create
     *
     * Method use to create invoice (estimate or unpaid as status)
     *
     * @param Request $request
     * @return Invoice
     */
    public function create(Request $request)
    {
        $this->validate($request->all(), [
            'cost' => 'required|numeric',
            'user_id' => 'required|numeric'
        ]);

        #TODO: clean up the order the customer and invoice gets save.
        $userId = $this->user()->isSuperuser() ? $request->user_id : $this->user()->id;

        $invoice = new Invoice();
        $invoice->status = Invoice::ESTIMATE;
        $invoice->cost = $request->input('cost');

        $user = User::findOrFail($userId);
        $invoice = $user->invoices()->save($invoice);
        $customer = new Customer($request->input('customer'));
        $customer->business_id = $userId;
        $customer = $invoice->customer()->save($customer);
        $invoice->number = Invoice::generateNumber($customer->id, $userId);
        $invoice->customer;
        return $invoice;
    }

    public function update(Request $request, $id)
    {
        $invoice = Invoice::findOrFail($id);

        if(!$this->user()->isSuperuser() && $invoice->user_id !== $this->user()->id)  {
            throw new ModelNotFoundException();
        }

        $this->validate($request, [
            'cost' => 'numeric'
        ]);

        $invoice->update($request->all());
        $invoice->save();

        return $invoice;
    }

    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);

        if(!$this->user()->isSuperuser() && $invoice->user_id !== $this->user()->id)  {
            throw new ModelNotFoundException();
        }

        $invoice->delete();

        return 1;
    }
}
