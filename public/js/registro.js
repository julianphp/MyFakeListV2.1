
function compruebaNick(txt){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url : 'registro/alias',
        method: 'POST',
        dataType: 'JSON',
        data : {
            txt : txt
        },
    })
        .done(function (data) {
            if (data.repe) {
                $(".rep1").removeAttr("hidden");
                $("#env").prop("disabled","e")
            } else {
                $(".rep1").prop("hidden","e");
                $("#env").removeAttr("disabled")
            }

        })
}


$(document).ready(function () {
    hidden1 = "";
    hidden = "";
    $(".nick").keyup(function () {
        var txt = $(this).val();
        if (txt.length > 20){
            $(".nickcheck").removeAttr("hidden");
            $("#env").prop("disabled","e");
        } else {

            $(".nickcheck").prop("hidden","e");
            $("#env").removeAttr("disabled");
            compruebaNick(txt);
        }



    });
    //usado para el registro y el cambio de contraseña
    $(".pass").focusout(function () {
        var pass = $(this).val();
        if (pass.length < 6){
            $(".passreq").removeAttr("hidden");
            $("#env").prop("disabled","e");
             hidden = false;
        } else {
            if (hidden1 === true) {
                $(".passreq").prop("hidden","e");
                $("#env").removeAttr("disabled");

            }
            hidden = true;

        }
    })
    // usado para el registro y el cambio de contraseña
    $(".passcon").keyup(function () {
        var pass = $(".pass").val();
        var pass1 = $(this).val();
            if (pass !== pass1){
                $(".passfail").removeAttr("hidden");
                $("#env").prop("disabled","e");
                hidden1 = false;
            } else {
                if (hidden === true){
                    $(".passfail").prop("hidden","e");
                    $("#env").removeAttr("disabled");
                    hidden1 = true;
                }


            }

    })

});
