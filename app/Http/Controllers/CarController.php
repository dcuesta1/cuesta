<?php
/**
 * Class Controller to manage cars
 *
 * @author: Cuesta
 */

namespace App\Http\Controllers;
use App\Car;
use App\Customer;
use App\Exceptions\ModelNotFoundException;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function show($id)
    {
        return Car::findOrFail($id);
    }

    public function create(Request $request) : Car
    {
        $customer = Customer::find($request->customer_id);

        if(!$this->getCurrentUser()->isSuperuser() && $customer->user_id !== $this->getCurrentUser()->id){
            throw new ModelNotFoundException('BUSINESS_CUSTOMER_NOT_FOUND');
        }

        $this->validate($request, [
            'make' => 'required',
            'customer_id' => 'required|numeric',
            'model' => 'required',
            'year' => 'required|numeric',
        ]);

        $car = new Car($request->all());
        $car = $customer->cars()->save($car);

        return $car;
    }

    public function update(Request $request, $id) : Car
    {
        $car = Car::findOrFail($id);
        $customer = $car->customer()->get()->first();

        if(!$this->getCurrentUser()->isSuperuser() && $customer->user_id !== $this->getCurrentUser()->id){
            throw new ModelNotFoundException('BUSINESS_CUSTOMER_NOT_FOUND');
        }

        $car->update($request->all());
        $car->save();
        return $car;

    }

    public function destroy($id) {
        $car = Car::findOrFail($id);
        $customer = $car->customer()->get()->first();

        if(!$this->getCurrentUser()->isSuperuser() && $customer->user_id !== $this->getCurrentUser()->id){
            throw new ModelNotFoundException('BUSINESS_CUSTOMER_NOT_FOUND');
        }

        $car->delete();
        return 1;
    }
}