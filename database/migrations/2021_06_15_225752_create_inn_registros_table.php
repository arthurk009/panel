<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInnRegistrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inn_registros', function (Blueprint $table) {
            $table->bigIncrements('registro_id');
            $table->string('nombre');
            $table->string('apellido');
	        $table->tinyInteger('acompanantes');
            $table->string('dia');
            $table->time('hora');
            $table->tinyInteger('status')->default(0);
            $table->unsignedBigInteger('caddy_id')->nullable();
            $table->foreign('caddy_id')->references('caddy_id')->on('inn_catalog_caddy');
            $table->unsignedBigInteger('dispositivo_id')->nullable();
            $table->foreign('dispositivo_id')->references('dispositivo_id')->on('inn_catalog_dispositivos');
            //$table->string('caddy_nombre');
	        //$table->string('dispositivo_nombre');

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
        Schema::dropIfExists('inn_registros');
    }
}
