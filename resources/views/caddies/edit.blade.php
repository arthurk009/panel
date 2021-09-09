@extends('layouts.master')
@section('title')
    Editar caddy
@endsection
@section('styles')
<link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.js"></script>    
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
<script>
$(document).ready(function() {
    $("#editForm").validate({
    rules: {
            nombre: {required: true},
            telefono: {required: true}
        },
    messages:{
            nombre: {required : "Este campo es requerido."},
            telefono: {required: "Este campo es requerido (10 dígitos)."}
        }
});
});

</script>
<script>
    $('#telefono').mask('(99) 9999 9999');
</script>

@endsection

@section('content')

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
                        <form action="#" id="editForm">
                            <input type="hidden" id="caddy" value="{{$caddy->caddy_id}}">
                            <td><input type="text" class="form-control" name="nombre" id="nombre" value="{{$caddy->caddy_nombre}}"></td>
                            <td><input type="text" class="form-control" name="telefono" id="telefono" value="{{$caddy->telefono}}"></td>
                            <td class="justify-content-center">
                                <button type="button" class="btn btn-success saveCad" id="saveCad">Guardar</button>    
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js" integrity="sha512-WNLxfP/8cVYL9sj8Jnp6et0BkubLP31jhTG9vhL/F5uEZmg5wEzKoXp1kJslzPQWwPT1eyMiSxlKCgzHLOTOTQ==" crossorigin="anonymous"></script>
<script>
$("#saveCad").on('click',function(){
    let url = "{{ route('saveCad') }}";
    let nombre = $('#nombre').val();
    let telefono = $('#telefono').val();
    let caddy = $('#caddy').val();

    if(nombre == ''){
          alert('Por favor ingresa el nombre del caddy.');
          $('#nombre').focus();
          return false;
    }
    if(telefono == ''){
          alert('Por favor ingresa un número de teléfono (10 dígitos).');
          $('#telefono').focus();
          return false;
    }

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url,
        type: 'POST',
        data: {caddy:caddy, nombre:nombre, telefono:telefono},
        success: function (response){
        if(response.success==true){
            Project.notificaciones(response.html, '', 'success');
            setTimeout(() => { location.reload();}, 2000);
            
        }else{
            Project.notificaciones(response.html, '', 'warning');
        }

        }
    });
});
</script>

@endsection