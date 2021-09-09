const Sconfirm = Swal.mixin({
    confirmButtonText: 'Si',
    cancelButtonText: 'No',
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    type: 'warning',
    reverseButtons: true,
    showCancelButton: true,
    animation: false            
  })

var Project = function () {
    return {
        validacionGeneral: function (id, reglas, mensajes) {
            const formulario = $('#' + id);
            formulario.validate({
                rules: reglas,
                messages: mensajes,
                highlight: function(element) {
                    $(element).closest('.form-group').find(".form-control:first").addClass('is-invalid');
                },
                unhighlight: function(element) {
                    $(element).closest('.form-group').find(".form-control:first").removeClass('is-invalid');
                    $(element).closest('.form-group').find(".form-control:first").addClass('is-valid');
            
                },
                errorElement: 'span',
                errorClass: 'invalid-feedback',
                errorPlacement: function(error, element) {
                    if(element.parent('.input-group').length) {
                        error.insertAfter(element.parent());
                    } else {
                        error.insertAfter(element);
                    }
                },
                invalidHandler: function (event, validator) { //display error alert on form submit
                    
                },
                submitHandler: function (form) {
                    return true;
                }
            });
        },
        notificaciones: function (mensaje, titulo, tipo) {
            toastr.options = {
                closeButton: true,
                newestOnTop: true,
                positionClass: 'toast-top-right',
                preventDuplicates: true,
                timeOut: '5000'
            };
            if (tipo == 'error') {
                toastr.error(mensaje, titulo);
            } else if (tipo == 'success') {
                toastr.success(mensaje, titulo);
            } else if (tipo == 'info') {
                toastr.info(mensaje, titulo);
            } else if (tipo == 'warning') {
                toastr.warning(mensaje, titulo);
            }
        },
        confirm: function (mensaje, titulo, tipo) {
            toastr.options = {
                closeButton: true,
                newestOnTop: true,
                positionClass: 'toast-top-right',
                preventDuplicates: true,
                timeOut: '5000'
            };
            if (tipo == 'error') {
                toastr.error(mensaje, titulo);
            } else if (tipo == 'success') {
                toastr.success(mensaje, titulo);
            } else if (tipo == 'info') {
                toastr.info(mensaje, titulo);
            } else if (tipo == 'warning') {
                toastr.warning(mensaje, titulo);
            }
        },
    }
}();

$(document).ready(function(){
    //$('.sidebar a.active').closest('ul').closest('a').addClass('active');
    //$('.sidebar a.active').closest('ul').parent().find('a').addClass('qwerty');
    $('.sidebar a.active').closest('ul').closest('li').addClass('menu-open');
    //$('.sidebar a.active').closest('ul').closest('li').find('a:first').addClass('active');
});