<?php

use App\{Customer, Invoice, Car, Payment, Item};
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Database\Faker\{CarFaker, ItemFaker};

class InvoicesTableSeeder extends Seeder
{
    private $faker;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function __construct(Faker $faker)
    {
        $this->faker = $faker;
    }

    public function run()
    {
        factory(App\Invoice::class, 2)->create()->each(function (Invoice $invoice) {
            $net = $invoice->cost;
            $fees = $net*.03;
            $tip = $this->faker->randomNumber(4);

            $payment = new Payment();
            $payment->invoice_id = $invoice->id;
            $payment->ref = Payment::generateRef($invoice->id, Payment::CARD_SLIDE);
            $payment->type = Payment::CARD_SLIDE;
            $payment->net = $invoice->id === 1 ? $net-50000 : $net;
            $payment->tip = $invoice->id === 1  ? 0 : $tip;
            $payment->fees = $invoice->id === 1 ? 0 : $fees;
            $payment->merchant_fees = $invoice->id === 1 ? ($net-50000)*.0275 : ($net+$fees+$tip)*.0275;
            $payment->cc_last_four = $this->faker->randomNumber(4);
            $invoice->payments()->save($payment);

            $fakerCar = new CarFaker();
            $car = new Car((array) $fakerCar);
            $car->year = $this->faker->numberBetween($min = 2000, $max = 2017);
            $car->customer_id =

            $fakerItem = new ItemFaker();
            $item = new Item((array) $fakerItem);
            $item->ref = 'pa'.$this->faker->numberBetween($min = 10000, $max = 200000);
            $item->cost = $this->faker->numberBetween($min = 10000, $max = 200000);

            $labor = new Item();
            $labor->name = 'labor';
            $labor->is_labor = true;
            $labor->cost = $this->faker->numberBetween($min = 10000, $max = 200000);
            $invoice->items()->save($item);
            $invoice->items()->save($labor);

            $customer = new Customer();
            $customer->user_id = $invoice->user_id;
            $customer->first_name = $this->faker->firstName();
            $customer->last_name = $this->faker->lastName();
            $customer->phone = $this->faker->phoneNumber();
            $customer->email = $this->faker->freeEmail();
            $customer->address_one = $this->faker->streetAddress();
            $customer->address_two = '';
            $customer->city = $this->faker->city();
            $customer->state = $this->faker->stateAbbr();
            $customer = $invoice->customer()->save($customer);
            $car->customer_id = $customer->id;
            $invoice->car()->save($car);

            $invoice->number = Invoice::generateNumber($customer->id, $invoice->user_id);

            if($invoice->id === 1) {
                $invoice->status = Invoice::PENDING_PAYMENT;
            }

            $invoice->save();
        });
    }
}
