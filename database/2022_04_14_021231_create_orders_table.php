<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
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
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->bigInteger('seller_id')->unsigned()->nullable();
            $table->bigInteger('address_id')->unsigned()->nullable();
            $table->longText('shipping_address')->nullable();
            $table->string('delivery_status')->default('pending');
            $table->string('payment_type')->nullable();
            $table->string('payment_status')->default('unpaid');
            $table->longText('payment_details')->nullable();
            $table->double('grand_total')->default(0);
            $table->string('discount')->default(0);
            $table->string('coupon_discount')->default(0);
            $table->string('profit_margin')->nullable();
            $table->mediumText('code')->nullable();
            $table->string('date')->nullable();
            $table->timestamp('delivery_date')->nullable();
            $table->string('points_used')->default(0);
            $table->string('viewed')->default(0);
            $table->string('delivery_viewed')->default(1);
            $table->string('payment_status_viewed')->default(1);
            $table->string('commission_calculated')->default(0);
            $table->string('order_status', 30)->default('none');
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
}
