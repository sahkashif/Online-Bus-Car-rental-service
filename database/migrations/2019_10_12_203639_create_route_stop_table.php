<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRouteStopTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('route_stop', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('stop_id')->nullable();
            $table->unsignedBigInteger('route_id')->nullable();
            $table->timestamps();

            $table->foreign('stop_id')
                ->references('id')
                ->on('stops')
                ->onDelete('set null')
                ->onUpdate('cascade');
            
            $table->foreign('route_id')
                ->references('id')
                ->on('routes')
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
        Schema::dropIfExists('route_stop');
    }
}
