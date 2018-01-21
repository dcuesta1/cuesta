<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarCustomerInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_customer_invoice', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->bigInteger('invoice_id');
            $table->bigInteger('customer_id')->nullable();
            $table->bigInteger('car_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('car_customer_invoice');
    }
}
