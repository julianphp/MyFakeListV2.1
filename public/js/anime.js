function setEst(usu, se) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({

        url: APP_URL+'/serie/status',
        type: 'POST',
        dataType: 'HTML',
        data: {
            usu : usu,
            se : se,
        },
    })
        .done(function (data) {

            location.reload();
        })

}
function subeCa(usu, se) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: APP_URL+'/serie/cap',
        type: 'POST',
        dataType: 'HTML',
        data: { usu : usu,
                se : se
        },

    })
        .done(function (data) {
            $("#cap"+se).html(data);
        })
}
function subeSc(usu, se, sc){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url:APP_URL+'/serie/score',
        type: 'POST',
        dataType: 'HTML',
        data: {
            usu : usu,
            se : se,
            sc : sc,
        }

    })

}
function borraSeUsu(usu, se){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url : APP_URL+'/serie/borrarUsuSe',
        type : 'POST',
        dataType: 'HTML',
        data : {
            usu : usu,
            se : se
        },
    })
        .done(function (data) {
            location.reload();
        })
}
function modEst(usu, se, est){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url : APP_URL+'/serie/modStatus',
        type : 'POST',
        dataType: 'HTML',
        data : {
            usu : usu,
            se : se,
            est : est
        }
    })
        .done(function () {
            location.reload();
        })
}
function modFav(usu, se, opeS){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url : APP_URL+'/serie/favoritos',
        type: 'POST',
        dataType: 'HTML',
        data : {
            usu : usu,
            se : se,
            opeS : opeS
        }
    })
        .done(function () {
            location.reload();
        })
}
$(document).ready(function () {
    $(".selEst").focusout(function () {
        var sts = $(this).val();
        var usu = $(this).data("usu");
        var se = $(this).data("se");
        if (sts === "Para Ver") {
            sts = "Para_Ver";
        }
        modEst(usu, se,sts);



    });
    // añade la serie a la lista de seguimiento del usuario
    $("#add").click(function () {
        var usu = $(this).data("usu");
        var se = $(this).data("se");

        setEst(usu,se);

    });

    //sube un capitulo visto
    $( ".fa-plus-circle" ).click(function() { // repetida de lista;
        var usu = $(this).data("usu");
        var se = $(this).data("se");
        subeCa(usu, se);
    });
    // sube la puntuacion
    $(".score").focusout(function () { // repetida de lista pero con cosas borradas
        var score = $(this).val();
        var usu = $(this).data("usu");
        var se = $(this).data("se");
        if (!isNaN(score)) {
            subeSc(usu,se,score);
        }



    });
    $("#btnd").click(function () {

        var usu = $(this).data("usu");
        var se = $(this).data("se");
        var ti = $(this).data("til");
        $("#borrarserie").modal();
        $("#md").text(ti);
        $("#del").click(function () {
            borraSeUsu(usu, se);
        })

    });
    $("#fav").click(function () {
        var fav = $(this).data("ope");
        var usu = $(this).data("usu");
        var se = $(this).data("se");
        modFav(usu,se, fav);
    });
});
