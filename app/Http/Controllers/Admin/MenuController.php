<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\validacionMenu;
use App\Models\Menu;
use App\Repositories\MenuRepository;
use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
class MenuController extends Controller
{
    
    protected $menuRepository;

    public function __construct(MenuRepository $menuRepository)
    {
        $this->middleware('auth');
        $this->menuRepository = $menuRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $menus = $this->menuRepository->getMenu();
        return view('admin.menu.index',compact('menus'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('admin.menu.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(validacionMenu $request)
    {
        Menu::create($request->all());

        $notification = array('message' => 'Menú creado con exito','alert-type' => 'success');
        return Redirect::to('admin/menu/create')->with($notification);
    }

    
    public function saveOrder(Request $request)
    {
        if($request->ajax()){
            $this->menuRepository->saveOrder($request->menu);
        }else{
            abort(404);
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
        $data = Menu::findOrFail($id);
        return view('admin.menu.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(validacionMenu $request, $id)
    {
        Menu::findOrFail($id)->update($request->all());
        $notification = array('message' => 'Menú actualizado con exito','alert-type' => 'success');
        return Redirect::to('admin/menu')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Menu::destroy($id);
            $notification = array('message' => 'Menú eliminado con exito','alert-type' => 'success');
            
        } catch (QueryException $e) {
            $notification = array('message' => 'Es necesario desasignar los roles asociados a este menú','alert-type' => 'error');
        }
       
        return Redirect::to('admin/menu')->with($notification);
    }
}
