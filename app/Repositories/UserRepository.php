<?php 
namespace App\Repositories;

use App\Models\ModelHasRole;
use App\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Session;
class UserRepository{

    public function getUsers($id = false){
        if($id){
            return User::select('users.id','users.name','users.email','users.status','roles.name as roleName','roles.id as roleId')
            ->join('model_has_roles','users.id','model_has_roles.model_id')
            ->join('roles','model_has_roles.role_id','roles.id')->where('users.id',$id)->first();
        }else
        return User::select('users.id','users.name','users.email','users.status','roles.name as roleName')
        ->join('model_has_roles','users.id','model_has_roles.model_id')
        ->join('roles','model_has_roles.role_id','roles.id')->paginate(10);

    }


    public function saveUser($request){
        try{
            DB::beginTransaction();

                $id=User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password'=>$request->password
                    ])->id;
            
                ModelHasRole::create([
                        'role_id' => $request->role,
                        'model_type' => 'App\User',
                        'model_id' => $id

                ]);
                DB::commit();                
        }catch(QueryException $error){
            DB::rollBack();
            throw $error;
        }


       
    }


    public function updateUser($request, $id){
        try{
            DB::beginTransaction();
                $user = User::findOrFail($id);
                $user->name = $request->name;
                $user->password = $request->password;
                $user->save();
                DB::commit();                
        }catch(QueryException $error){
            DB::rollBack();
            throw $error;
        }


       
    }
    


}