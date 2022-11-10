<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTradeProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trade_profiles', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('report_map_id')->unsigned();
            $table->longText('country')->nullable();
            $table->longText('description_import')->nullable();
            $table->longText('description_export')->nullable();
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
        Schema::dropIfExists('trade_profiles');
    }
}
