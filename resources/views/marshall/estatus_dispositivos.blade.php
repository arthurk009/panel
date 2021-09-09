@extends('layouts.master')
@section('title')
    Estatus de Dispositivos
@endsection
@section('scripts')
<script src="{{asset('js/pages/admin/menu.js')}}" type="text/javascript"></script>
@endsection
@section('content')
<div class="card table-responsive" style="background-color:  rgba(109, 109, 109, 0.5)"><br>
<table class="table" style="font-family: Arial, Helvetica, sans-serif">
    <thead class="text-white">
        <tr>
            <td scope="col">Dispositivo</th>
            <td scope="col">Estatus</th>
            <td scope="col">Acompañantes</th>
            <td scope="col">Caddie</th>
            <td scope="col">Último Registro</th>
            <td scope="col">Bateria%</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($dispositivos as $disp)
            <tr class="text-white">
                <td>{{$disp->dispositivo_id_disp}}</td>
                <td>{{$disp->status}} {{$disp->nombre}}</td>
                <td>{{$disp->acompanantes}}</td>
                <td>{{$disp->caddie}}</td>
                <td>{{$disp->ultimo}}</td>
                <td>{{$disp->bateria}}</td>
            </tr>
        @endforeach
    </tbody>
</table><br>
</div><br><br>
@endsection
