@extends('layouts.master')
@section('title')
    Nuevo caddy
@endsection
@section('styles')
<link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
@endsection

@section('scripts')
<script src="{{asset('js/pages/admin/menu.js')}}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.js"></script>    
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
<script>
    $('#telefono').mask('(99) 9999 9999');
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

<div class="card">
    <div class="card-body">
        <div class="row">    
            <table class="table table-bordered">
                    <thead>                
                      <tr>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <form class="form-group" action="{{ route('registerCad') }}" id="newCadForm" method="POST">
                                @csrf
                                
                                <td>
                                    <div class="col-sm-6 col-md-12">
                                        <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" value="{{old('nombre', $data->nombre ?? '')}}" required>
                                    </div>
                                </td>
                                <td>
                                    <div class="col-sm-6 col-md-12">
                                        <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Teléfono" value="{{old('nombre', $data->telefono ?? '')}}" required>
                                    </div>
                                </td>
                                <td class="justify-content-center">
                                    <button type="submit" class="btn btn-success">Guardar</button>    
                                </td>
                            </form>
                          </tr>
                    </tbody>
            </table>
        </div> 
        <button type="button" class="p-2 border rounded bg-dark">
            <a class="text-white" href="javascript:history.back()" style="text-decoration: none;">Regresar</a>
        </button>         
    </div>
</div>
<script>
$(document).ready(function() {
    $("#newCadForm").validate({
        rules: {
                nombre: {required: true},
                telefono: {required: true}
            },
        messages:{
                nombre: {required : "Este campo es requerido."},
                telefono: {required: "Este campo es requerido."}
            }
    });
});
</script>

@endsection