<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class caddy extends Model
{
    protected $table = "inn_catalog_caddy";
    protected $fillable = ['caddy_nombre','status','telefono', 'situacion'];

    protected $primaryKey = 'caddy_id';

}
