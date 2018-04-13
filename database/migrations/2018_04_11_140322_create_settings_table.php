<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('business_name');
            $table->string('business_phone');
            $table->string('business_email');
            $table->float('fee')->default(0.00);
            $table->float('tax')->default(0.00);
            $table->integer('plan')->default(0);
            $table->timestamp('expiration')->nullable()->default(null);
            $table->string('sq_merchant_id')->nullable();
            $table->string('sq_subscription_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
