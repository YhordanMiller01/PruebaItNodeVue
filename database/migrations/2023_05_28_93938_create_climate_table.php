<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClimateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('climate', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('date');
            $table->string('lon');
            $table->string('lat');
            $table->string('temp');
            $table->string('feels_like');
            $table->string('temp_min');
            $table->string('temp_max');
            $table->string('pressure');
            $table->string('humidity');
            $table->string('speed');
            $table->string('deg');
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
        Schema::dropIfExists('climate');
    }
}
