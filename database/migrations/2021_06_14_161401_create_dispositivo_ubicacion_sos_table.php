<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDispositivoUbicacionSosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dispositivo_ubicacion_sos', function (Blueprint $table) {
            $table->integer('id_dispositivo_ubicacion_sos');
            $table->integer('id_dispositivo_ubicacion');
            $table->integer('id_contacto');
            $table->dateTime('fecha_solicitud');
            $table->dateTime('fecha_respuesta');
            $table->integer('estatus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dispositivo_ubicacion_sos');
    }
}
