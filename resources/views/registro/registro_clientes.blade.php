@extends('layouts.master')
@section('title')
    Registro
@endsection

@section('scripts')

<script src="{{asset('js/pages/admin/menu.js')}}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.js"></script>
<script>
$(document).ready(function() {
    $("#registro-form").validate({
        rules: {
                nombre: {required: true},
                apellido: {required: true},
                dia: {required: true},
                caddy_nombre: {required: true},
                dispositivo_nombre: {required: true}
            },
        messages:{
                nombre: {required : "Este campo es requerido."},
                apellido: {required: "Este campo es requerido."},
                dia: {required: "Este campo es requerido."},
                caddy_nombre: {required: "Este campo es requerido."},
                dispositivo_nombre: {required: "Este campo es requerido."}
            }
    });
});

</script>

@endsection

@section('content')

<style>
label.error {
    color: red;
    font-size: .8rem;
    display: block;
    margin-top: 5px;
}

input.error {
    border: 1px dashed red;
    font-weight: 300;
    color: red;
}
</style>

    <div class="card" style="background-color:  rgba(109, 109, 109, 0.5)"><br><br>
        <form action="{{route('registro.alta')}}" id="registro-form" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group row pb-3">
                    <label class="col-sm-3 col-form-label requerido text-white" for="nombre">Nombre:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" value="{{old('nombre', $data->nombre ?? '')}}" required>
                    </div>
                </div>

                <div class="form-group row pb-3">
                    <label class="col-sm-3 col-form-label requerido text-white" for="apellido">Apellido:</label>
                    {{--  <div class="col-sm-6">
                        <input type="text" name="apellido" id="apellido" class="form-control" placeholder="Apellido" value="" required>
                    </div>  --}}
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="apellido" id="apellido" placeholder="Apellido" value="{{old('apeliido', $data->apellido ?? '')}}" required>
                    </div>
                </div>

                <div class="form-group row pb-3">
                    <label class="col-sm-3 col-form-label requerido text-white" for="acompanantes">No de acompañantes:</label>
                    <div class="col-sm-6">
                        <select name="acompanantes" id="acompanantes" class="form-control">
                            <option value="0" selected>0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row pb-3">
                    <label class="col-sm-3 col-form-label requerido text-white" for="dia">Preferencia de horario (Día):</label>
                    <div class="col-sm-6">
                        <select name="dia" id="dia" class="form-control" required>
                            <option value="0" selected disabled> Seleccione día</option>
                            <option value="1">Lunes</option>
                            <option value="2">Martes</option>
                            <option value="3">Miércoles</option>
                            <option value="4">Jueves</option>
                            <option value="5">Viernes</option>
                            <option value="6">Sábado</option>
                            <option value="7">Domingo</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row pb-3">
                    <label class="col-sm-3 col-form-label requerido text-white">Hora salida:</label>
                        <div class="col-sm-6">
                            <select name="hora" id="hora" class="form-control" required>
                                <option value='07:00' >07:00 AM</option><option value='07:10' >07:10 AM</option><option value='07:20' >07:20 AM</option><option value='07:30' >07:30 AM</option><option value='07:40' >07:40 AM</option><option value='07:50' >07:50 AM</option>
                                <option value='08:00' >08:00 AM</option><option value='08:10' >08:10 AM</option><option value='08:20' >08:20 AM</option><option value='08:30' >08:30 AM</option><option value='08:40' >08:40 AM</option><option value='08:50' >08:50 AM</option>
                                <option value='09:00' >09:00 AM</option><option value='09:10' >09:10 AM</option><option value='09:20' >09:20 AM</option><option value='09:30' >09:30 AM</option><option value='09:40' >09:40 AM</option><option value='09:50' >09:50 AM</option>
                                <option value='10:00' >10:00 AM</option><option value='10:10' >10:10 AM</option><option value='10:20' >10:20 AM</option><option value='10:30' >10:30 AM</option><option value='10:40' >10:40 AM</option><option value='10:50' >10:50 AM</option>
                                <option value='11:00' >11:00 AM</option><option value='11:10' >11:10 AM</option><option value='11:20' >11:20 AM</option><option value='11:30' >11:30 AM</option><option value='11:40' >11:40 AM</option><option value='11:50' >11:50 AM</option>
                                <option value='12:00' >12:00 PM</option><option value='12:10' >12:10 PM</option><option value='12:20' >12:20 PM</option><option value='12:30' >12:30 PM</option><option value='12:40' >12:40 PM</option><option value='12:50' >12:50 PM</option>
                                <option value='13:00' >13:00 PM</option><option value='13:10' >13:10 PM</option><option value='13:20' >13:20 PM</option><option value='13:30' >13:30 PM</option><option value='13:40' >13:40 PM</option><option value='13:50' >13:50 PM</option>
                                <option value='14:00' >14:00 PM</option><option value='14:10' >14:10 PM</option><option value='14:20' >14:20 PM</option><option value='14:30' >14:30 PM</option><option value='14:40' >14:40 PM</option><option value='14:50' >14:50 PM</option>
                                <option value='15:00' >15:00 PM</option><option value='15:10' >15:10 PM</option><option value='15:20' >15:20 PM</option><option value='15:30' >15:30 PM</option><option value='15:40' >15:40 PM</option><option value='15:50' >15:50 PM</option>
                                <option value='16:00' >16:00 PM</option><option value='16:10' >16:10 PM</option><option value='16:20' >16:20 PM</option><option value='16:30' >16:30 PM</option><option value='16:40' >16:40 PM</option><option value='16:50' >16:50 PM</option>
                                <option value='17:00' >17:00 PM</option><option value='17:10' >17:10 PM</option><option value='17:20' >17:20 PM</option><option value='17:30' >17:30 PM</option><option value='17:40' >17:40 PM</option><option value='17:50' >17:50 PM</option>
                                <option value='18:00' >18:00 PM</option>
                            </select>
                        </div>
                </div>

                <div class="form-group row pb-3">
                    <label class="col-sm-3 col-form-label requerido text-white" for="">Caddie:</label>
                        <div class="col-sm-6">
                            <select name='caddy_nombre' id='caddy_nombre' class='form-control' required>
                                <option value='' selected disabled>Seleccione Caddie</option>

                                @foreach ($caddys as $caddyId => $caddyName)
                                    <option value="{{ $caddyId }}">{{ $caddyName}} </option>
                                @endforeach
                            </select>
                        </div>
                </div>

                <div class="form-group row pb-3">
                    <label class="col-sm-3 col-form-label requerido text-white" for="">Dispositivo Asignado:</label>
                        <div class="col-sm-6">
                            <select name='dispositivo_nombre' id='dispositivo_nombre' class='form-control' required>
                                <option value='' selected disabled>Seleccione Dispositivo</option>

                                @foreach ($dispositivos as $dispId => $dispName)
                                    <option value="{{ $dispId }}">{{ $dispName}} </option>
                                @endforeach
                            </select>
                        </div>
                </div>
            </div>

            <div class="card-footer" style="background-color:  rgba(109, 109, 109, 0.5)">
                <div class="text-center">
                    <button type="submit" class="btn btn-primary ">Guardar</button>
                </div>
            </div>
        </form>
    </div>

@endsection
