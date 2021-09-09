<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleMenu extends Model
{
    protected $table = "menu_roles";
    protected $fillable = ['role_id','menu_id'];
    public $timestamps = false;
}
