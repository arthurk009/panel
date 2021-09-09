<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDispositivoUbicacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dispositivo_ubicacion', function (Blueprint $table) {
            $table->integer('id_dispositivo_ubicacion');
            $table->integer('id_dispositivo');
            $table->integer('id_contacto');
            $table->string('latitud');
            $table->string('longitud');
            $table->dateTime('fecha_ws');
            $table->timestamps();
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
        Schema::dropIfExists('dispositivo_ubicacion');
    }
}
