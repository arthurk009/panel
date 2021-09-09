<?php

namespace App\Http\Controllers;

use App\Models\dispositivos;
use App\Models\LogsModel;
use App\Models\registros;
use App\Models\caddy;
use App\Repositories\GlobalRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;


class RegisterController extends Controller
{



    private $globalRepository;

    public function __construct(GlobalRepository $globalRepository)
    {
        $this->globalRepository = $globalRepository;
        $this->middleware('auth');
    }

    public function index(){

        $dispositivos = $this->globalRepository->getDispositivosCombo();
        $caddys = $this->globalRepository->getCaddysCombo();

        return view('registro.registro_clientes',compact('dispositivos','caddys'));
    }

    public function alta(Request $request){

        //return $request;

        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'acompanantes' => 'required',
            'dia' => 'required',
            'caddy_nombre' => 'required',
            'dispositivo_nombre' => 'required'
        ]);

        $registros = new registros();

        $registros->nombre = $request->nombre;
        $registros->apellido = $request->apellido;
        $registros->acompanantes = $request->acompanantes;
        $registros->dia = $request->dia;
        $registros->hora = $request->hora;
        $registros->caddy_id = $request->caddy_nombre;
        $registros->dispositivo_id = $request->dispositivo_nombre;

        $disp = dispositivos::where('dispositivo_id', $registros->dispositivo_id)->first();
        $disp->status=0;
        $disp->save();
        $caddie = caddy::where('caddy_id', $registros->caddy_id)->first();
        $caddie->status =0;
        $caddie->save();

        $registros->save();

        $logs = new LogsModel();

        $logs->id_dispositivo = $registros->dispositivo_id;
        $logs->id_contacto = $registros->registro_id;
        $logs->fecha_asignacion = NOW();
        #$logs->fecha_salida = "'0000-00-00 00:00:00'";

        //return $logs;
        $logs->save();

        $notification = array('message' => 'Registro creado con exito','alert-type' => 'success');
        return Redirect::to('registro')->with($notification);
    }
}
