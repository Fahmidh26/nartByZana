<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_id');
            $table->string('customer_name');
            $table->text('address');
            $table->string('phone_no');
            $table->unsignedBigInteger('product_id');
            $table->string('product_code');
            $table->string('product_name');
            $table->string('payment_type');
            $table->string('amount');
            $table->string('qty');
            $table->string('color');
            $table->string('size');
            $table->string('delivery_charge')->nullable();
            $table->string('delivery_company')->nullable();
            $table->string('order_date')->nullable();
            $table->string('order_month')->nullable();
            $table->string('order_year')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
