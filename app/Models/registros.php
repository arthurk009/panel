<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class registros extends Model
{
    protected $table = "inn_registros";
    protected $fillable = ['nombre','apellido','acompanantes','dia','hora','status','caddy_id','dispositivo_id'];
    protected $guarded  =  ['registro_id'];

    protected $primaryKey = 'registro_id';

}
