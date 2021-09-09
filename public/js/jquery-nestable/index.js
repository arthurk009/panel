$(document).ready(function(){    
    $('#nestable').nestable().on('change', function () {
        const data = {
            menu: window.JSON.stringify($('#nestable').nestable('serialize')),
            _token: $('input[name=_token]').val()
        };
        $.ajax({
            url: $("#thisurl").val()+'/admin/menu/save-order',
            type: 'POST',
            dataType: 'JSON',
            data: data,
            success: function (respuesta) {
            }
        });
    });

    $('.eliminar-menu').on('click', function(event){
        event.preventDefault();
        
        const url = $(this).attr('href');


          Sconfirm.fire({
            text: "¿Desea Eliminar el menú?"
          }).then((result) => {
            if (result.value) {
                window.location.href = url;
              }



          })
    })

})
