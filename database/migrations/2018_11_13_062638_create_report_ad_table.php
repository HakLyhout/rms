<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportAdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_ad', function (Blueprint $table) {
            $table->increments('report_id');
            $table->integer('ad_status_id');
            $table->integer('ad_type_id');
            $table->string('name');
            $table->string('type_name');
            $table->integer('report_type_id');
            $table->integer('main_type_id');
            $table->string('import_file');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('status');
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
        Schema::dropIfExists('report_ad');
    }
}
