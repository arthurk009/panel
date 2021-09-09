<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInnCatalogCaddyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inn_catalog_caddy', function (Blueprint $table) {
            $table->bigIncrements('caddy_id');
            $table->string('caddy_nombre');
            $table->string('telefono');
	        $table->string('responsable');
            $table->tinyInteger('status')->default(0)->comment("1=disponible 0=ocupado");
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
        Schema::dropIfExists('inn_catalog_caddy');
    }
}
