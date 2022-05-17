<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weather', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('country_id')->index();
            $table->unsignedInteger('state_id')->index()->nullable();
            $table->unsignedInteger('city_id')->index()->nullable();
            $table->text('latitude');
            $table->text('longitude');
            $table->string('temp');
            $table->string('expires_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('weather');
    }
};
