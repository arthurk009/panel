<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CarritoMapaController extends Controller
{

    public function index(){
        return view('carrito.mapa');
    }
}


