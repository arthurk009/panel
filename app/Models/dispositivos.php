<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class dispositivos extends Model
{
    protected $table = "inn_catalog_dispositivos";
    protected $fillable = ['dispositivo_nombre','imei','desc','bateria','status'];
    protected $guarded  =  ['dispositivo_id'];

    protected $primaryKey = 'dispositivo_id';

}
