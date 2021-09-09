<?php

namespace App\Http\Controllers;
use App\Repositories\GlobalRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MarshallEstatusController extends Controller
{

    private $globalRepository;

    public function __construct(GlobalRepository $globalRepository)
    {
        $this->globalRepository = $globalRepository;
        $this->middleware('auth');
    }
    public function index(){

        $dispositivos = $this->globalRepository->getDispositivos();
        return view('marshall.estatus_dispositivos',compact('dispositivos'));
    }
}
