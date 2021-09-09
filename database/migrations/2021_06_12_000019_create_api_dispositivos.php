<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApiDispositivos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('api_dispositivos', function (Blueprint $table) {
            $table->string('id');
            $table->string('lat');
            $table->string('lon');
            $table->string('tim');
            $table->string('sos');
            $table->tinyInteger('bat');
            $table->string('evt');
            $table->bigInteger('ts');
            $table->string('dispositivo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('api_dispositivos');
    }
}
