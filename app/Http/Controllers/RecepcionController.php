<?php

namespace App\Http\Controllers;

use App\Models\caddy;
use App\Models\registros;
use App\Models\dispositivos;
use App\Models\LogsModel;
use App\Repositories\GlobalRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class RecepcionController extends Controller
{
    private $globalRepository;

    public function __construct(GlobalRepository $globalRepository)
    {
        $this->globalRepository = $globalRepository;
        $this->middleware('auth');
    }

    public function index(){
        $registros = $this->globalRepository->getRegisterActives();

        return view('registro.recepcion_dispositivos', compact('registros'));
    }

    public function baja(Request $request){

        $registros = registros::where('registro_id',$request->registro_id)->first();
        print_r($registros);
        $registros->status = 1;
        $registros->save();

        $fecha = NOW();

        LogsModel::where('id_contacto',$request->registro_id )
        ->update(['fecha_salida' =>$fecha]);

        $disp = dispositivos::where('dispositivo_id', $registros->dispositivo_id)->first();
        $disp->status=1;
        $disp->save();

        $caddie = caddy::where('caddy_id', $registros->caddy_id)->first();
        $caddie->status =1;
        $caddie->save();

        $notification = array('message' => 'Recepción de dispositivo con exito','alert-type' => 'success');
        return Redirect::to('recepcion')->with($notification);
    }
}

