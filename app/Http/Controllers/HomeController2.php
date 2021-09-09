<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController2 extends Controller
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
        $dias = array(
            1 => 'Lunes',
            2 => 'Martes',
            3 => 'Miércoles',
            4 => 'Jueves',
            5 => 'Viernes',
            6 => 'Sábado',
            7 => 'Domingo'
        );

        $months = array(
            1 => 'Enero',
            2 => 'Febrero',
            3 => 'Marzo',
            4 => 'Abril',
            5 => 'Mayo',
            6 => 'Junio',
            7 => 'Julio',
            8 => 'Agosto',
            9 => 'Septiembre',
            10 => 'Octubre',
            11 => 'Noviembre',
            12 => 'Diciembre'
        );

        $mes = $months[date('n')];
        $day = $dias[date('N')];
        $dia_mes = date('j');
        $año = date('Y');

        // $madeiras: lat:19.614270, lng: -99.268847};
        $api_clima = "http://api.openweathermap.org/data/2.5/weather?zip=54766,mx&appid=d7d7e1f2ff359361239bdf8cc458721c";

        $weather_data = json_decode(file_get_contents($api_clima), true);

        $temp = $weather_data["main"]["temp"];

        $temp_c = $temp - 273.15;

        $activos = DB::table('inn_registros')
        ->where('status', '=', 0)
        ->get();

        $cuenta = $activos->count();

        $user = Auth::user();
        $rol = $user->roles->implode('name',', ');
        
        return view('home3', compact('rol', 'temp_c', 'day', 'dia_mes', 'mes', 'año', 'cuenta'));
    }
}
