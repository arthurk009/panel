@extends('layouts.master')
@section('title')
    Recepcion de Dispositivos
@endsection
@section('scripts')
<script src="{{asset('js/pages/admin/menu.js')}}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.js"></script>
<script>
$(document).ready(function() {
    $("#recepcion-form").validate({
        rules: {
            registro_id: {required: true}

            },
        messages:{
            registro_id: {required : "Este campo es requerido."}

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
        <form action="{{route('recepcion.baja')}}" id="recepcion-form" method="post">
            @csrf
            <br><br>
            <center><img src=" {{ asset('img/recepcion.png') }}" width="190" height="190"></center><br>
            <div class="card-body">
                <br>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label requerido text-white" for="">Dispositivo Asignado:</label>
                        <div class="col-sm-6">
                            <select name='registro_id' id='registro_id' class='form-control' required>
                                <option value='' selected disabled>Seleccione Dispositivo</option>
                                        @foreach ($registros as $reg)
                                            <option value="{{$reg->registro_id}}">{{$reg->nombre}} </option>
                                        @endforeach
                            </select>
                        </div>
                </div>
            </div><br><br><br><br>
            <div class="card-footer" style="background-color:  rgba(109, 109, 109, 0.5)">
                <div class="text-center">
                    <button type="submit" class="btn btn-primary ">Recibir</button>
                </div>
            </div>
        </form>
    </div><br><br><br><br>
@endsection
