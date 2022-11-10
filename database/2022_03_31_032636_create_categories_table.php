<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('parent_id')->unsigned()->default(0);
            $table->bigInteger('sub_parent_id')->unsigned()->default(0);
            $table->string('name')->nullable();
            $table->string('slug')->unique();
            $table->double('commision_rate');
            $table->string('banner')->nullable();
            $table->string('image')->nullable();
            $table->string('featured_image')->nullable();
            $table->string('mega_banner')->nullable();
            $table->string('featured')->default(0);
            $table->string('brands')->default('[]');
            $table->string('icon')->nullable();
            $table->text('meta_title')->nullable();
            $table->longText('meta_description')->nullable();
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
        Schema::dropIfExists('categories');
    }
}