<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInnCatalogDispositivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inn_catalog_dispositivos', function (Blueprint $table) {
            $table->bigIncrements('dispositivo_id');
            $table->string('dispositivo_nombre');
            $table->string('imei');
            $table->string('desc');
            $table->tinyInteger('bateria');
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('inn_catalog_dispositivos');
    }
}
