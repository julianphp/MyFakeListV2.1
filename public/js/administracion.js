function borrar(usu) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: APP_URL+'/borrarUsu',
        type: 'POST',
        dataType: 'HTML',
        data: { usu : usu
        },

    })
        .done(function () {
            location.reload();
        })
}
function recuperar(usu) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: APP_URL+'/recuperarUsu',
        type: 'POST',
        dataType: 'HTML',
        data: { usu : usu
        },

    })
        .done(function () {
            location.reload();
        })
}

$(document).ready(function () {
    $(".btn1").click(function () {

        id = $(this).data('id');
        var nick = $(this).data('nick')
        var email = $(this).data('email')
        $( "#nick" ).text( nick);
        $( "#email" ).text(email);
        $( "#txt" ).text("marcar como borrado al usuario");
        $( "#ope" ).text("Borrar");
        $(".del").removeAttr("hidden")
        $(".rec").prop("hidden","e")
        $(".modal").modal('show');
    });

    $(".del").click(function () {

        borrar(id);
    });
    $(".btnR").click(function () {

        id = $(this).data('id');
        var nick = $(this).data('nick')
        var email = $(this).data('email')
        $( "#nick" ).text( nick);
        $( "#email" ).text(email);
        $( "#txt" ).text("recuperar al usuario");
        $( "#ope" ).text("Recuperar");
        $(".del").prop("hidden","e")
        $(".rec").removeAttr("hidden")
        $(".modal").modal('show');


    });
    $(".rec").click(function () {

        recuperar(id);
    });
});
