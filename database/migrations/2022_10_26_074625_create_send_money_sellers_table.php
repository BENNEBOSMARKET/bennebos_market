<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSendMoneySellersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('send_money_sellers', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('seller_id');

            $table->foreign('seller_id')->references('id')->on('sellers');
            $table->bigInteger('money');
            $table->text('description')->nullable();
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
        Schema::dropIfExists('send_money_sellers');
    }
}
