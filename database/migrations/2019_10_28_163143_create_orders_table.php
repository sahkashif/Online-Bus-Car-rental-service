<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('bus_id');
            $table->unsignedBigInteger('start_stop_id');
            $table->datetime('dep_time');
            $table->unsignedBigInteger('end_stop_id');
            $table->datetime('arr_time');
            $table->decimal('price',10,3);
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('start_stop_id')
                ->references('id')
                ->on('stops')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            
            $table->foreign('end_stop_id')
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
        Schema::dropIfExists('orders');
    }
}
