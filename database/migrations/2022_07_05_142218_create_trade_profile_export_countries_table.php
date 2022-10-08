<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTradeProfileExportCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trade_profile_export_countries', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('trade_profile_id')->unsigned();
            $table->string('country')->nullable();
            $table->string('trade_percentage')->nullable();
            $table->string('status')->default(1);
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
        Schema::dropIfExists('trade_profile_export_countries');
    }
}
