<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_id')->unsigned()->nullable();
            $table->bigInteger('seller_id')->unsigned()->nullable();
            $table->bigInteger('product_id')->unsigned()->nullable();
            $table->longText('variation')->nullable();
            $table->string('color')->nullable();
            $table->string('size')->nullable();
            $table->double('price')->default(0);
            $table->string('tax')->default(0);
            $table->string('shipping_cost')->default(0);
            $table->string('quantity')->default(0);
            $table->double('total')->default(0);
            // $table->string('payment_status')->default('unpaid');
            $table->string('profit_margin')->nullable();
            // $table->string('delivery_status')->default('pending');
            $table->string('shipping_type')->nullable();
            $table->string('pickup_point_id')->nullable();
            $table->string('product_referral_code')->nullable();
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
        Schema::dropIfExists('order_details');
    }
}
