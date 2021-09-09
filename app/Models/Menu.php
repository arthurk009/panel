<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = "menus";
    protected $fillable = ['nombre','url','icono','order','menu_id'];
    protected $guarded  =  ['id'];
    //public $timestamp = false;

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'menu_roles');
    }

    
}
