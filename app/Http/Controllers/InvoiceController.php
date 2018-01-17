<?php

namespace App\Http\Controllers;

use App\Exceptions\{ModelNotFoundException, BadInputException};
use App\{Customer, Invoice, User};
use Illuminate\Http\Request;
use Input, Validator;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::all();

        foreach($invoices as $invoice) {
            $invoice->payments;
            $invoice->customer;
        }

        return $invoices;
    }


    public function userInvoices($username) {
        $user = $this->getCurrentUser()->isSuperuser() ? User::where('username', $username)->get() : $this->getCurrentUser();

        if(!$this->getCurrentUser()->isSuperuser() && $username !== $user->username) {
            throw new ModelNotFoundException();
        }

        $invoices = $user->invoices;

        foreach ($invoices as $invoice) {
            $invoice->payments;
            $invoice->customer;
        }

        return $invoices;
    }

    public function show($id)
    {
        if(!$this->getCurrentUser()->isSuperuser()) {
        $invoices = $this->getCurrentUser()->invoices;

            foreach($invoices as $invoice) {
                if($invoice->id == $id) {
                    $invoice->customer;
                    $invoice->payments;

                    return $invoice;
                } else {
                    throw new ModelNotFoundException("invoice_not_found");
                }
            }
        }

        $invoice =  Invoice::findOrFail($id);
        $invoice->customer;
        $invoice->payments;

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
        $userId = $this->getCurrentUser()->isSuperuser() ? $request->user_id : $this->getCurrentUser()->id;

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

        if(!$this->getCurrentUser()->isSuperuser() && $invoice->user_id !== $this->getCurrentUser()->id)  {
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

        if(!$this->getCurrentUser()->isSuperuser() && $invoice->user_id !== $this->getCurrentUser()->id)  {
            throw new ModelNotFoundException();
        }

        $invoice->delete();

        return 1;
    }
}
