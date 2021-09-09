$(document).ready(function(){
    rules ={name:{required:true,minlength:4,maxlength:50},email:{required:true,email: true},password:{required:true,minlength:4,maxlength:50},password_confirmation:{equalTo:"#password"},role:{required:true}};

    Project.validacionGeneral('form_save_user',rules);

    $('.user_status').on('change', function () {
        var data = {
            id: $(this).attr('id'),

            _token: $('input[name=_token]').val()
        };
        if ($(this).is(':checked')) {
            data.status = 1
        } else {
            data.status = 0
        }
        ajaxRequest($("#thisurl").val()+"/admin/updateStatus",data);

    });
    
    
});

function ajaxRequest (url, data) {
    $.ajax({
        url: url,
        type: 'POST',
        data: data,
        success: function (respuesta) {
            Project.notificaciones(respuesta.respuesta, '', 'success');
        }
    });
}