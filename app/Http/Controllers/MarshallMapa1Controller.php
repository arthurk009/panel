<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\dispositivos;
use Illuminate\Support\Facades\Auth;


class MarshallMapa1Controller extends Controller
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

    public function viewMap(){
        $ubicaciones = DB::table('inn_catalog_ubicacion_mapa')->where('tipo',1)->get();

        $ubicacionesMapa = $this->getUbicaciones();

        $ubicacionesInicial=(count($ubicacionesMapa)>0)?$ubicacionesMapa:array();


        return view('marshall.viewmap',compact('ubicaciones','ubicacionesInicial'));
    }

    public function Rutas()
    {
        $ubicaciones = DB::table('inn_catalog_ubicacion_mapa')->where('tipo',1)->get();

        $comboDispositivos = $this->getDispositivosActivos();

        return view('marshall.rutas', compact('ubicaciones','comboDispositivos'));
    }

    public function getDispositivosActivos(){
        return DB::table('inn_catalog_dispositivos as a')
        ->join('inn_registros as b','a.dispositivo_id','b.dispositivo_id')
        ->select('a.dispositivo_id', 'b.registro_id', 'a.dispositivo_nombre', 'a.imei', DB::raw("CONCAT(b.nombre, ' ',b.apellido)as persona"))
        ->where('b.created_at', '>=', DB::raw('curdate()'))
        ->get();
    }

    public function getUbicacionesDispositivo($dispositivo_id){


        $arrayDatos=array();
        $arrayPolylines=array();
        $arrayReturn=array();
        $arrayDatos=explode("-",$dispositivo_id);
        $dispositivo_id=$arrayDatos[0];
        $contacto_id=$arrayDatos[1];

        $disUbicacion = DB::table('dispositivo_ubicacion as a')
                        ->where('id_dispositivo', '=', $dispositivo_id, 'AND', 'id_contacto', '=',$contacto_id)
                        ->orderBy('created_at', 'asc')
                        ->get();

        // $sql_i="select a.*
        // FROM dispositivo_ubicacion a
        // WHERE id_dispositivo='$dispositivo_id' AND id_contacto='$contacto_id' ORDER BY timestamp ASC";

        // $query_i = $db->sql_query($sql_i) or die("Error al obtener datos ");
        if (count($disUbicacion) > 0){

            foreach($disUbicacion as $datos){
                $arrayDatos[] = $datos;
                $arrayPolylines[]=array("lat"=>(float)$datos->latitud,"lng"=>(float)$datos->longitud);
            }


            $registro = DB::table('inn_registros as a')
                        ->select(DB::raw("CONCAT(a.nombre,' ',a.apellido) as nombre"), 'a.created_at', 'b.fecha_ws')
                        ->join(DB::raw("(SELECT id_dispositivo,fecha_ws
                                            FROM dispositivo_ubicacion
                                            WHERE id_dispositivo='$dispositivo_id' AND id_contacto ='$contacto_id' ORDER BY fecha_ws DESC LIMIT 1
                                        ) as b"),'a.dispositivo_id','b.id_dispositivo'
                        )
                        ->where('a.dispositivo_id', $dispositivo_id)
                        ->where('a.registro_id',$contacto_id)
                        ->first();


            $arrayReturn['info']=array("nombre"=>$registro->nombre,"fecha_registro"=>$registro->created_at,"fecha_fin"=>$registro->fecha_ws);
            $arrayReturn['datos']=$arrayDatos;
            $arrayReturn['polylines']=$arrayPolylines;

            return $arrayReturn;

        }


    }

    public function mapa1(){

        $ubicaciones = DB::table('inn_catalog_ubicacion_mapa')->where('tipo',1)->get();

        $ubicacionesMapa = $this->getUbicaciones();

        $ubicacionesInicial=(count($ubicacionesMapa)>0)?$ubicacionesMapa:array();


        return view('marshall.mapa1',compact('ubicaciones','ubicacionesInicial'));
    }

    public function mapa2(){
        $ubicaciones = DB::table('inn_catalog_ubicacion_mapa')->where('tipo',1)->get();

        $ubicacionesMapa = $this->getUbicaciones();

        $ubicacionesInicial=(count($ubicacionesMapa)>0)?$ubicacionesMapa:array();


        return view('marshall.mapa2',compact('ubicaciones','ubicacionesInicial'));
    }

    public function getInterval(Request $request){
        if($request->ajax()){

            $gigs = $this->getUbicaciones();
            echo json_encode($gigs);

        }else{
            abort(404);
        }
    }

    public function getUbicaciones(){
        return  DB::table('dispositivo_ubicacion as a')
        ->join('inn_registros as b',function($join)
                {
                    $join->on('a.id_dispositivo','b.dispositivo_id');
                    $join->on('a.id_contacto','=','b.registro_id');
                })
        ->join('inn_catalog_dispositivos as c','a.id_dispositivo','c.dispositivo_id')
        ->where('a.estatus',1)
        ->where('a.fecha_ws', '>=', DB::raw('curdate()'))
        ->select('a.id_dispositivo','a.latitud','a.longitud',DB::raw("CONCAT(b.nombre,' ',b.apellido) AS nombre"),'b.created_at as fecha_registro','c.dispositivo_nombre as imagen','c.bateria')
        ->get()->toArray();
    }

    public function track(Request $request){
        if($request->ajax()){
            $dispositivo_id = $request->dispositivo_id;

            $gigs = $this->getUbicacionesDispositivo($dispositivo_id);
            echo json_encode($gigs);

        }else{
            abort(404);
        }
    }


}
