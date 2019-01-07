<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_service', function (Blueprint $table) {
            $table->increments('data_service_id');
            $table->integer('report_id');
            $table->integer('all_listing_service');
            $table->integer('active_service');
            // $table->integer('sold_service');
            $table->integer('urgent_service');
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
        Schema::dropIfExists('data_service');
    }
}
