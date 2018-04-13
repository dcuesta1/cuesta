<?php

namespace App\Http\Controllers;
use App\{
    Customer, Exceptions\ModelNotFoundException, User
};
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function show($id)
    {
        return Customer::findOrFail($id);
    }

    public function create(Request $request)
    {
        #TODO: Do address validation.
        $user = ($this->user()->isAdmin() ? User::findOrFail($request->user_id) : $this->user());
        $this->validate($request, [
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'email' => 'required|email',
            'address_one' => 'nullable|min:3',
            'state' => 'nullable|max:2',
        ]);

        $customer = new Customer($request->all());
        $customer->user_id = null;
        $customer = $user->customers()->save($customer);
        return $customer;
    }

    public function userCustomers($username)
    {
        $user = $this->user()->isSuperuser() ? $username : $this->user();

        $customers = $user->customers;

        foreach ($customers as $customer) {
            $customer->invoices;
            $customer->cars;
        }

        return $customers;
    }

    public function update(Request $request, $id) : Customer
    {
        $customer = Customer::findOrFail($id);

        if(!$this->user()->isSuperuser() && $customer->user_id !== $this->user()->id)  {
            throw new ModelNotFoundException();
        }

        $this->validate($request, [
            'email' => 'nullable|email',
        ]);

        $customer->update($request->all());
        $customer->save();

        return $customer;
    }

    public function destroyMultiple(Request $request, $username) {

        $user = $this->user()->isSuperuser() ? User::where('username', $username)->get() : $this->user();

        if(!$this->user()->isSuperuser() && $username !== $user->username) {
            throw new ModelNotFoundException();
        }

        $customers = Customer::findOrFail($request->all());

        $ids = [];
        foreach ($customers as $customer) {
            if($customer->user_id !== $user->id) {
                return 0;
            }
            $ids[] = $customer->id;
        }

        Customer::destroy($ids);
        return 1;
    }
}