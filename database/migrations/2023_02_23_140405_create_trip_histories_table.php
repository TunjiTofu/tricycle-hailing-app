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
        Schema::create('trip_histories', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('rider_id');
            $table->string('keke_id');
            $table->integer('status');
            $table->timestamp('start_trip_time');
            $table->point('start_location');
            $table->point('current_location')->nullable();
            $table->timestamp('end_trip_time')->nullable();
            $table->point('end_location')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trip_histories');
    }
};
