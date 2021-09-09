<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogsModel extends Model
{
    protected $table = "dispositivos_logs";
    protected $fillable = ['id_dispositivo','id_contacto', 'fecha_asignacion', 'fecha_salida'];
    public $timestamps = false;

}
