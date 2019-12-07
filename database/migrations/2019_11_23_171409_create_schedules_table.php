<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('bus_id');
            $table->unsignedBigInteger('stop_id');
            $table->datetime('arr_time');
            $table->datetime('dep_time');
            $table->timestamps();

            $table->foreign('bus_id')
                ->references('id')
                ->on('buses')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        
            $table->foreign('stop_id')
                ->references('id')
                ->on('stops')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}
