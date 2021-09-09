<?php 
namespace App\Repositories;

use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RoleRepository{

    public function getComboRoles(){
        return Role::all()->pluck('name','id')->toArray();
       

    }
    


}