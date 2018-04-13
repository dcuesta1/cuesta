<?php
/**
 * Class Controller to manage cars
 *
 * @author: Cuesta
 */

namespace Api\Http\Controllers;
use Api\Car;
use Api\Customer;
use Api\Exceptions\ModelNotFoundException;
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

        if(!$this->user()->isSuperuser() && $customer->user_id !== $this->user()->id){
            throw new ModelNotFoundException('BUSINESS_CUSTOMER_NOT_FOUND');
        }

        $this->validate($request, [
            'make' => 'required',
            'customer_id' => 'required|numeric',
            'model' => 'required',
            'year' => 'required|numeric',
            'number' => 'nullable|unique:cars,number'
        ]);

        $car = new Car($request->all());
        $car = $customer->cars()->save($car);

        return $car;
    }

    public function update(Request $request, Car $car) : Car
    {
        $this->validate($request, [
            'make' => 'nullable|min:3',
            'model' => 'nullable|min:3',
            'year' => 'nullable|numeric',
            'number' => 'nullable|unique:cars,number'
        ]);

        $car = $car->fill($request->all());
        $car->save();

        return $car;
    }

    public function destroy(Car $car) {
        return ['success' => $car->delete()];
    }
}