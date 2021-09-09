<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CarritoSolicitudesController extends Controller
{

    public function index(){
        return view('carrito.solicitudes');
    }
}

