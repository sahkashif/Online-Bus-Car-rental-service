<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusStopTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bus_stop', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('bus_id')->nullable();
            $table->unsignedBigInteger('stop_id')->nullable();
            $table->datetime('arr_time');
            $table->datetime('dep_time');
            $table->timestamps();

            $table->foreign('bus_id')
                ->references('id')
                ->on('buses')
                ->onDelete('set null')
                ->onUpdate('cascade');
            
            $table->foreign('stop_id')
                ->references('id')
                ->on('stops')
                ->onDelete('set null')
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
        Schema::dropIfExists('bus_stop');
    }
}
