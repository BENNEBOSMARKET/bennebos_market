<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQutotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qutotations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->bigInteger('category_id');
            $table->bigInteger('user_id');
            $table->string('sourcing');
            $table->string('sourcing_type')->nullable();
            $table->string('quantity');
            $table->string('piece')->nullable();
            $table->string('trade_terms')->nullable();
            $table->string('max_budget');
            $table->string('curency');
            $table->string('repitation')->nullable();
            $table->string('days')->nullable();
            $table->string('duration')->nullable();
            $table->longText('details')->nullable();
            $table->string('image')->nullable();
            $table->string('shipping_method')->nullable();
            $table->string('country')->nullable();
            $table->string('lead_time')->nullable();
            $table->string('status')->nullable()->default(0);
            $table->string('payment_method')->nullable();
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
        Schema::dropIfExists('qutotations');
    }
}
