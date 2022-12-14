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
            $table->date('dateofappointment')->nullable();
            $table->time('timeofappointment')->nullable();
            $table->integer('status');
            $table->integer('ad_status');
            $table->integer('refferedto');
            $table->integer('refferedto_doctor');
            $table->text('remarks');
            $table->text('diagnostics');
            $table->text('treatment');
            $table->text('attachedfile')->nullable();
            $table->integer('laps');
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
