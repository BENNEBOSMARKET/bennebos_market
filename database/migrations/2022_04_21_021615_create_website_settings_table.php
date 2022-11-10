<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebsiteSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('website_settings', function (Blueprint $table) {
            $table->id();
            $table->string('header_logo')->nullable();
            $table->string('fav_icon')->nullable();
            $table->string('footer_logo')->nullable();
            $table->string('facebook_url')->default('#');
            $table->string('twitter_url')->default('#');
            $table->string('whatsapp_url')->default('#');
            $table->string('linkedin_url')->default('#');
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
        Schema::dropIfExists('website_settings');
    }
}
