<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\userValidation;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    protected $userRepository;
    protected $roleRepository;

    public function __construct(UserRepository $userRepository, RoleRepository $roleRepository)
    {
        $this->middleware('auth');
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $users = $this->userRepository->getUsers();
        return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $comboRoles =  $this->roleRepository->getComboRoles();
        // $users = $this->userRepository->getUsers();
        return view('admin.users.create',compact('comboRoles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(userValidation $request)
    {
        try {
            
            $this->userRepository->saveUser($request);
            $notification = array('message' => 'Usuario creado con exito','alert-type' => 'success');
            
        }catch (Exception $th) {
           
            $notification = array('message' => $th->getMessage(),'alert-type' => 'error');
            
        }finally{
            return Redirect::to('admin/user/create')->with($notification)->withInput($request->except('password'));
        }
        
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $data = $this->userRepository->getUsers($id);
        $comboRoles =  $this->roleRepository->getComboRoles();
        return view('admin.users.edit',compact('comboRoles'),compact('data'));


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(userValidation $request, $id)
    {

        try {
            $this->userRepository->updateUser($request, $id);
            $notification = array('message' => 'Usuario actualizado con exito','alert-type' => 'success');
            
        }catch (Exception $th) {
           
            $notification = array('message' => $th->getMessage(),'alert-type' => 'error');
            
        }finally{
            return Redirect::to('admin/user/'.$id.'/edit')->with($notification)->withInput($request->except('password'));
        }





        // Menu::findOrFail($id)->update($request->all());
        // $notification = array('message' => 'Menú actualizado con exito','alert-type' => 'success');
        // return Redirect::to('admin/menu')->with($notification);



        // try {
        //     Menu::destroy($id);
        //     $notification = array('message' => 'Menú eliminado con exito','alert-type' => 'success');
            
        // } catch (QueryException $e) {
        //     $notification = array('message' => 'Es necesario desasignar los roles asociados a este menú','alert-type' => 'error');
        // }



       
        //return Redirect::to('admin/menu')->with($notification);



    }


    public function updateStatus(Request $request)
    {
        if ($request->ajax()) {
            $user = User::findOrFail($request->input('id'));
            $user->status = $request->input('status');
            $user->save();
            return response()->json(['respuesta' => 'El estatus se actualizó correctamente']);
            
        } else {
            abort(404);
        }
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
