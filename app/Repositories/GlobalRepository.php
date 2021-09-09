<?php
namespace App\Repositories;

use App\Models\caddy;
use App\Models\dispositivos;
use App\Models\registros;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class GlobalRepository{

    //Estatus de Dispositivos
    public function getDispositivos(){

        return DB::table('inn_catalog_dispositivos as disp')
        ->leftjoin(DB::raw("(SELECT distinct(dispositivo) as dispositivo_nombre, MAX(tim) as ultimo FROM api_dispositivos GROUP BY dispositivo) AS e "),"disp.dispositivo_nombre","e.dispositivo_nombre")
        //->leftJoin("dispositivos_logs as dl","disp.dispositivo_id","")
        ->leftJoin('dispositivos_logs as dl',function($join)
        {
            $join->on('disp.dispositivo_id','dl.id_dispositivo')->whereNULL('dl.fecha_salida');

        })
        ->leftJoin('inn_registros as r','r.registro_id','dl.id_contacto','r','r.acompanantes')
        ->leftJoin('inn_catalog_caddy as caddy','caddy.caddy_id','r.caddy_id')
        ->select('disp.dispositivo_nombre as dispositivo_id_disp','disp.status',
        DB::raw("CONCAT(r.nombre,' ',r.apellido)as nombre"),'disp.bateria',
        DB::raw("CONCAT(caddy.caddy_nombre,' - ',caddy.telefono) as caddie "),'e.ultimo',
        DB::raw("CONCAT(r.acompanantes)as acompanantes"),
        DB::raw('(CASE
                 WHEN disp.status = "0" THEN "Asignado a:"
                 WHEN disp.status = "1" THEN "Sin asignar"
                 END) AS status'))
        ->get();
    }


    //Registro Rapido
    public function getDispositivosCombo(){
        return dispositivos::where('status', 1)->pluck('dispositivo_nombre','dispositivo_id')->toArray();
        // return DB::table('inn_catalog_dispositivos as d')
        // ->join('inn_registros as r', 'd.dispositivo_id', 'r.dispositivo_id')
        // ->select('d.dispositivo_id')
        // ->where('d.status', 0)->get();
    }
    public function getCaddysCombo(){
        return caddy::where('status', 1)->where('situacion','=', 1)->pluck('caddy_nombre','caddy_id')->toArray();
    }

    public function getRegisterActives(){
        return DB::table('inn_registros as r')
         ->join('inn_catalog_dispositivos as d','r.dispositivo_id','d.dispositivo_id')
         ->select('r.registro_id',DB::raw("CONCAT(r.nombre,' ',r.apellido,'(',d.dispositivo_nombre,')')as nombre"))
         ->where('r.status', 0)->get();
    }



    // public function getCaddiesCombo(){
    //     return caddy::where('status',0)->pluck('caddy_nombre')->toArray();
    // }


    // public function guardarDatos($quest){
    //     caddy::create([
    //     'columna'=>$request->name,
    //     'columna2'=>$request->val2
    //    ]);
    // }


}
