<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('clinic');
            $table->integer('category');
            $table->integer('doctor');
            $table->date('dateofappointment');
            $table->time('timeofappointment');
            $table->integer('status');
            $table->integer('refferedto');
            $table->integer('refferedto_doctor');
            $table->text('remarks');
            $table->text('treatment');
            $table->rememberToken();
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
        Schema::dropIfExists('appointments');
    }
};
