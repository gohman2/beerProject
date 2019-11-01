<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beers', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('type_id')->nullable();
            $table->unsignedBigInteger('manufacturer_id')->nullable();

            $table->string('title');
            $table->string('description')->nullable();

            $table->foreign('type_id')->references('id')->on('type_beers');
            $table->foreign('manufacturer_id')->references('id')->on('manufacturers');

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
        Schema::dropIfExists('beers');
    }
}
