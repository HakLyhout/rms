<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataCarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_car', function (Blueprint $table) {
            $table->increments('data_car_id');
            $table->integer('report_id');
            $table->integer('all_listing_car');
            $table->integer('active_car');
            $table->integer('sold_car');
            $table->integer('urgent_car');
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
        Schema::dropIfExists('data_car');
    }
}
