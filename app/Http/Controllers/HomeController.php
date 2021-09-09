<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
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
        $user = Auth::user();
        $rol = $user->roles->implode('name',', ');

        return view('home',["rol"=>$rol]);
    }


    public function menu2()
    {
        $user = Auth::user();
        $rol = $user->roles->implode('name',', ');


        $invitados = DB::table('inn_registros')
        ->where('status', 0)
		->select(DB::raw("SUM(acompanantes) as acompanantes"))
        ->first();
        $jugadores = DB::table('inn_registros')
        ->where('status', 0)
        ->get();

        $grupos = $jugadores->count();
        $total = $invitados->acompanantes+$jugadores->count();
        return view('home2',["rol"=>$rol], compact('total','grupos'));

    }
}
