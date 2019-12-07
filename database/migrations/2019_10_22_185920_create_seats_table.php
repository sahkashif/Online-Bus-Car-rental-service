<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('seat_code');
            $table->string('seat_slug');
            $table->string('status');
            $table->decimal('price',10,2);
            $table->unsignedBigInteger('bus_id')->nullable();
            $table->timestamps();

            $table->foreign('bus_id')
                ->references('id')
                ->on('buses')
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
        Schema::dropIfExists('seats');
    }
}
