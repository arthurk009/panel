<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDispositivosLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dispositivos_logs', function (Blueprint $table) {
            $table->integer('id_dispositivo_log');
            $table->integer('id_dispositivo');
            $table->integer('id_contacto');
            $table->dateTime('fecha_asignacion');
            $table->dateTime('fecha_salida');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dispositivos_logs');
    }
}

