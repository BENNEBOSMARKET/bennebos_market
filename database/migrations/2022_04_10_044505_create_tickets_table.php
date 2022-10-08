<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('user_type')->nullable();
            $table->bigInteger('user_id')->unsigned();
            $table->string('subject')->nullable();
            $table->longText('message')->nullable();
            $table->string('status')->default(0);
            $table->string('attachment')->nullable();
            $table->string('viewed')->default(0);
            $table->string('seller_viewed')->default(0);
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
