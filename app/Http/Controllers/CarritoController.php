<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CarritoController extends Controller
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

    public function mapa(){

        $ubicaciones = DB::table('inn_catalog_ubicacion_mapa')->where('tipo',1)->get();

        $ubicacionesMapa = $this->getUbicaciones();

        $ubicacionesInicial=(count($ubicacionesMapa)>0)?$ubicacionesMapa:array();

        return view('carrito.mapa',compact('ubicaciones','ubicacionesInicial'));
    }

    public function solicitudes(){

        $ubicaciones = DB::table('inn_catalog_ubicacion_mapa')->where('tipo',1)->get();

        //$ubicacionesMapa = $this->getUbicaciones();
        $ubicacionesMapa = $this->getUbicacionesMapaSolicitud();

        $ubicacionesInicial=(count($ubicacionesMapa)>0)?$ubicacionesMapa:array();

        return view('carrito.solicitudes',compact('ubicaciones','ubicacionesInicial'));
    }
    public function solicitudesMapa2(){

        $ubicaciones = DB::table('inn_catalog_ubicacion_mapa')->where('tipo',1)->get();

        //$ubicacionesMapa = $this->getUbicaciones();
        $ubicacionesMapa = $this->getUbicacionesMapaSolicitud();

        $ubicacionesInicial=(count($ubicacionesMapa)>0)?$ubicacionesMapa:array();

        return view('carrito.solicitudesMapa2',compact('ubicaciones','ubicacionesInicial'));
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
        return DB::table('dispositivo_ubicacion as a')
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

    public function getUbicacionesMapaCar(){

        return DB::table('dispositivo_ubicacion_car as a')
        ->join('inn_catalog_dispositivos', 'a.id_dispositivo', '=', 'inn_catalog_dispositivos.dispositivo_id')
        ->select('a.id_dispositivo', 'a.latitud', 'a.longitud', 'inn_catalog_dispositivos.dispositivo_nombre')
        ->where('a.estatus', '=', '1', 'AND', 'a.fecha_ws', '>=', 'CURDATE()')
        ->get()
        ->toArray();

    }

    public function getUbicacionesMapaCarCombine(Request $request){

        if($request->ajax()){

            // $gigs = $this->getUbicacionesMapaCar();
            $gigs = $this->getUbicacionesMapaSolicitud();
            echo json_encode($gigs);

        }else{
            abort(404);
        }


    }

    public function getUbicacionesMapaSolicitud(){
        return DB::table('dispositivo_ubicacion_sos as a')
        ->join('inn_registros as b', 'a.id_contacto', '=', 'b.registro_id')

        //->join('dispositivo_ubicacion as c','b.dispositivo_id','c.id_dispositivo')
        ->join('dispositivo_ubicacion as c',function($join)
                {
                    $join->on('b.dispositivo_id','c.id_dispositivo');
                    $join->on('b.registro_id','=','c.id_contacto');
                    $join->on('c.estatus',DB::raw("1"));
                })
        ->leftJoin('inn_catalog_caddy as d','b.caddy_id','d.caddy_id')
        ->select('a.id_dispositivo', 'a.latitud', 'a.longitud', 'inn_catalog_dispositivos.dispositivo_nombre')
        ->where('a.fecha_solicitud', '>=', DB::raw('curdate()'))
        ->where('a.fecha_respuesta',null)
        ->select('c.id_dispositivo','c.latitud','c.longitud',DB::raw("CONCAT(b.nombre,' ',b.apellido) AS nombre"),
        'b.created_at as fecha_registro','a.fecha_solicitud',DB::raw(" '0' as tipo"),'a.id_dispositivo_ubicacion_sos',DB::raw("CONCAT(d.caddy_nombre,' (',d.telefono,')') AS nombre"))
        ->get()
        ->toArray();
    }

    public function enviaPedido(Request $request){

        if($request->ajax()){

            $idsos = $request->idsos;

            DB::table('dispositivo_ubicacion_sos')
                ->WHERE('id_dispositivo_ubicacion_sos', '=',$idsos)
                ->update(['fecha_respuesta' => NOW()]);

            return "true";


        }else{
            abort(404);
        }

    }

    public function peticiones()
    {
        $solicitudes = DB::table('dispositivo_ubicacion_sos')
        ->where('fecha_solicitud', '>=', DB::raw('curdate()'))
        ->where('fecha_respuesta', '=', NULL )
        ->get();

        return $solicitudes->count();
        //return 2;

    }

}


