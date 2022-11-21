<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBigDealsProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('big_deals_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('product_img');
            $table->foreignId('category_id')->constrained('categories')->nullable();
            $table->foreignId('sub_sub_category_id')->constrained('categories')->cascadeOnDelete();
            $table->foreignId('subCategory_id')->constrained('categories')->cascadeOnDelete();
            $table->bigInteger('country_id')->unsigned();
            $table->foreignId('seller_id')->constrained('sellers')->cascadeOnDelete();
            $table->string('model_no');
            $table->string('certification');
            $table->string('feet');
            $table->string('condition');
            $table->bigInteger('sku');
            $table->bigInteger('price');
            $table->bigInteger('quantity');
            $table->longText('description');
            $table->longText('description_photo');
            $table->longText('note')->nullable();
            $table->integer('refundable')->default(0);
            $table->integer('best_big_deal')->default(0);
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
        Schema::dropIfExists('big_deals_products');
    }
}
