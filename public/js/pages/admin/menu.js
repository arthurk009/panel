$(document).ready(function(){
    Project.validacionGeneral('form_guardar_menu');

    $("#icono").on("blur",function(){
        $("#mostrar-icono").removeClass().addClass("fa fa-"+ $(this).val());

    })
});