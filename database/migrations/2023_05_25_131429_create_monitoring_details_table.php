<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonitoringDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monitoring_details', function (Blueprint $table) {
            $table->id();
            $table->string('activitie');
            $table->dateTime('date');
            $table->integer('state')->default(1);
            $table->unsignedBigInteger('monitoring_id');
            $table->foreign('monitoring_id')->references('id')->on('monitorings');
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
        Schema::dropIfExists('monitoring_details');
    }
}
