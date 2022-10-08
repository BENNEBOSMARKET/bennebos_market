<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->nullable();
            $table->bigInteger('color_id')->nullable();
            $table->bigInteger('size_id')->nullable();
            $table->foreignId('seller_id')->constrained()->nullable();
            $table->string("name")->nullable();
            $table->string("slug")->nullable();
            $table->string("title")->nullable();
            $table->text('description');
            $table->string("images")->nullable();
            $table->string("thumbnail")->nullable();
            $table->double("price");
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
        Schema::dropIfExists('product_details');
    }
}
