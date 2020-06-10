/**
 * Search AJAX, seaarch anime an users
 * @param texto
 */
function obtener_registros(texto)
{
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url : APP_URL+'/busqueda1',
        type : 'POST',
        dataType: 'HTML',
        data : { texto: texto,

        },
    })

        .done(function(data){
            console.log(data)

            $("#resultadoBus").html(data);
        })
}

/**
 * Send the characterer type in the search box
 */
$(document).on('keyup', '#busqueda', function()
{

    var valorBusqueda=$(this).val();
    //alert(valorBusqueda)
    if (valorBusqueda!=""){
        obtener_registros(valorBusqueda);
    }
    else {
        $("#resultadoBus").html("");
    }


});
