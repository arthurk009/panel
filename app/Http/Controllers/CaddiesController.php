<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\caddy;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class CaddiesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    public function index()
    {
        $caddy = caddy::select()
        ->where('situacion','!=', 2)
        ->get();

        $caddys = DB::table('inn_catalog_caddy')
        ->select()
        ->paginate(15);

        return view('caddies.index', compact('caddy', 'caddys'));
    }

    public function new()
    {
        return view('caddies.new');
    }

    public function registercad(Request $request, caddy $caddy)
    {
        $nombre = $request->nombre;
        $telefono = $request->telefono;

        $registro = new caddy;
        $registro->caddy_nombre = $nombre;
        $registro->telefono = $telefono;
        $registro->status = 1;
        $registro->responsable = '';

        $registro->save();

        return redirect('/caddies');

    }

    public function edit(Request $request)
    {
        $id = $request->id;

        $caddy = DB::table('inn_catalog_caddy')
        ->where('caddy_id', '=', $id)
        ->first();

        return view('caddies.edit', compact('caddy'));
    }

    public function updateCaddies(Request $request)
    {
        //return $request->input('id');
        if ($request->ajax()) {
            $caddy = caddy::findOrFail($request->input('id'));
            $caddy->situacion = $request->input('situacion');
            $caddy->save();
            return response()->json(['respuesta' => 'El estatus se actualizó correctamente']);

        } else {
            abort(404);
        }
    }

    public function save(Request $request)
    {
        $caddy = caddy::findOrFail($request->caddy);
        $caddy->caddy_nombre = $request->nombre;
        $caddy->telefono = $request->telefono;

        $caddy->save();

        return response()->json(array('success' => true, 'html'=>'Caddy actualizado correctamente'));

    }


    public function delCad(Request $request)
    {

        if ($request->ajax()) {
            $caddy = caddy::findOrFail($request->input('id'));
            $caddy->situacion = "2";
            $caddy->save();

            return response()->json(['respuesta' => 'El caddy se eliminó correctamente']);

        } else {
            abort(404);
        }
    }
}
