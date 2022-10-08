<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            // Product Information
            $table->string('added_by')->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreignId('category_id')->constrained()->nullable();
            $table->bigInteger('brand_id')->unsigned()->nullable();
            $table->bigInteger('size_id')->unsigned()->nullable();
            $table->bigInteger('color_id')->unsigned()->nullable();
            $table->bigInteger('main_product_id')->unsigned()->nullable();
            $table->string('name')->nullable();
            $table->string('slug')->unique()->nullable();
            $table->string('unit')->nullable();
            $table->double('min_qty')->nullable();
            $table->string('barcode')->nullable();
            $table->string('refundable')->default(0);
            // Product Images
            $table->string('thumbnail')->nullable();
            $table->longText('gallery_image')->nullable();
            $table->string('video')->nullable();
            $table->mediumText('color')->nullable();
            $table->mediumText('color_image')->nullable();
            $table->longText('color_titles')->nullable();
            $table->longText('color_prices')->nullable();
            $table->mediumText('size')->nullable();
            // Product price + stock
            $table->double('unit_price')->nullable();
            $table->date('discount_date_from')->nullable();
            $table->date('discount_date_to')->nullable();
            $table->string('discount')->nullable();
            $table->string('quantity')->nullable();
            $table->string('sku')->nullable();
            $table->string('total_review')->default(0);
            $table->string('avg_review')->default(0);
            // Product Description SEO Meta
            $table->longText('description')->nullable();
            $table->text('meta_title')->nullable();
            $table->longText('meta_description')->nullable();

            $table->string('featured')->default(0);
            $table->string('status')->default(0);
            $table->string('admin_approval')->default(0);

            $table->string('deal_of_day')->default(0);

            // features product
            $table->string('right_slider')->default(0);
            $table->string('new_arrival')->default(0);
            $table->string('top_ranked')->default(0);
            $table->string('dropshipping')->default(0);
            $table->string('true_view')->default(0);
            $table->string('best_selling')->default(0);
            $table->string('category_featured')->default(0);
            $table->string('category_pinned')->default(0);

            //BigDeals
            $table->string('best_big_deal')->default(0);
            $table->string('big_deal_new_arrival')->default(0);
            $table->string('big_deal_most_viewed')->default(0);
            $table->string('deal_of_season')->default(0);
            $table->string('big_needs')->default(0);
            $table->string('big_quantity')->default(0);

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
        Schema::dropIfExists('products');
    }
}
