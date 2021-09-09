@extends('layouts.master')
@section('title')
    Inicio
@endsection
@section('content')
{{-- <div class="wrapper bg-image" style="background-image: url('{{ asset('img/fondo.png') }}')"> --}}
<div class="row" style="font-family: Arial, Helvetica, sans-serif">

    <div class="col-lg-6 col-12"><br>
        <div class="small-box" style="background-color:  rgba(109, 109, 109, 0.5)">
            <div class="card-body">
                <div class="inner">
                    <div align="right"><img src=" {{ asset('img/home/weather-white.png') }}"  width="80" height="80"></div>
                    <center><h1 class="text-white">Madeiras Country Club </h1><br>
                    <div class="table-responsive">
                        <div id="TT_FejALBYBYdCaEcMA7fuE11EEE9aATfChqBaxqzBzzHv"></div>
                        <script type="text/javascript" src="https://www.tutiempo.net/s-widget/l_FejALBYBYdCaEcMA7fuE11EEE9aATfChqBaxqzBzzHv"></script>
                    </div></center><br>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6 col-12"> <br>
        <div class="small-box" style="background-color: rgba(109, 109, 109, 0.5)">
            <div class="card-body">
                <div class="inner">
                    <div align="right"><img src=" {{ asset('img/home/user-white.png') }}"  width="79" height="79"></div><br><br>
                    <center><h1 class="text-white"> Bienvenido {{\auth()->user()->name}}</h1>
                    <center><h2 class="text-white"> {{\auth()->user()->getRoleNames()->first()}}</h2></center>
                    <br><br><br>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6 col-12"><br>
        <div class="small-box" style="background-color: rgba(109, 109, 109, 0.5)">
            <div class="card-body">
                <div class="inner">
                    <div align="right"><img src=" {{ asset('img/home/player-white.png') }}"  width="80" height="80"></div><br>
                    <table class="table text-center">
                        <thead>
                            <tr >
                                <td class="text-white" style="font-size: 160%"><h2>Grupos en el campo</h2></td>
                                <td class="text-white" style="font-size: 160%"><h2>Jugadores en el campo</h2></td>
                            </tr>
                        </thead>


                        <tbody>
                            <tr>
                                <td class="text-white" style="font-size: 200%">{{$grupos}}</td>
                                <td class="text-white" style="font-size: 200%">{{$total}}</td>
                            </tr>
                        </tbody>
                    </table><br><br>

                    {{-- <center><h1 class="text-white" style="font-size: 300%">{{$total}}</h1> <h1 class="text-white">Jugadores en el campo</h1></center>
                    <center><h1 class="text-white" style="font-size: 300%">{{$grupos}}</h1> <h1 class="text-white">Jugadores en el campo</h1></center> --}}

                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6 col-12"><br>
        <div class="small-box" style="background-color: rgba(109, 109, 109, 0.5)">
            <div class="card-body">
                <div class="inner">
                    <div align="right"><img src=" {{ asset('img/home/calendar-white.png') }}"  width="87" height="87"></div><br>
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <td class="text-white" scope="col" style="font-size: 130%"><h2>Fecha</h2></th>
                                    <td class="text-white" scope="col" style="font-size: 130%"><h2>Hora</h2></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-white" style="font-size: 170%">{{date('d-m-y') }}</td>
                                    <td class="text-white" style="font-size: 170%">{{date('h:i:s A') }}</td>
                                </tr>
                            </tbody>
                        </table><br><br>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- </div> --}}
@endsection
