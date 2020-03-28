<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventRegistersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_register', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('event_name');
            $table->string('venue');
            $table->date('event_date');
            $table->timeTz('event_startTime');
            $table->timeTz('event_endTime');
            $table->string('event_category');
            $table->string('event_details');
            $table->string('user_id');
            $table->string('count')->defaults(0);
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
        Schema::dropIfExists('event_registers');
    }
}
