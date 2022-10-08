<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_infos', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->nullable();
            $table->longText('description')->nullable();
            $table->string('logo', 1000)->nullable();
            $table->string('category')->nullable();
            $table->string('sub_category')->nullable();
            $table->string('established')->nullable();
            $table->string('proprietor')->nullable();
            $table->string('telephone')->nullable();
            $table->string('fax')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('address')->nullable();
            $table->string('state_id')->nullable();
            $table->string('country_id')->nullable();

            $table->longText('social_media')->nullable();
            $table->string('social_media_count')->default(0);

            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instragram')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('youtube')->nullable();

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
        Schema::dropIfExists('company_infos');
    }
}
