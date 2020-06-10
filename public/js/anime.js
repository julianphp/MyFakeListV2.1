/**
 * Ajax request for change the status anime of the user
 * @param usu
 * @param se
 */
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

/**
 * Ajax request to update a eps seeing for the user
 * @param usu
 * @param se
 */
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

/**
 * Ajax request for update the score of the user anime
 * @param usu
 * @param se
 * @param sc
 */
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

/**
 * Ajax request for delete a anime user in list
 * @param usu
 * @param se
 */
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

/**
 * Ajax Request to change the status of the anime user
 * @param usu
 * @param se
 * @param est
 */
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

/** Ajax Request to add an anime to favorites
 *
 * @param usu
 * @param se
 * @param opeS
 */
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
    /**
     * Select the status and call to the ajax function
     */
    $(".selEst").focusout(function () {
        var sts = $(this).val();
        var usu = $(this).data("usu");
        var se = $(this).data("se");
        if (sts === "Para Ver") {
            sts = "Para_Ver";
        }
        modEst(usu, se,sts);



    });
    /**
     * Add the anime to the anime list of the user at click in the botton
     */
    $("#add").click(function () {
        var usu = $(this).data("usu");
        var se = $(this).data("se");

        setEst(usu,se);

    });

    /**
     * Up a eps watch for the user and call to the ajax function
     */
    $( ".fa-plus-circle" ).click(function() { // repetida de lista;
        var usu = $(this).data("usu");
        var se = $(this).data("se");
        subeCa(usu, se);
    });
    /**
     * Upload the score
     */
    $(".score").focusout(function () { // repetida de lista pero con cosas borradas
        var score = $(this).val();
        var usu = $(this).data("usu");
        var se = $(this).data("se");
        if (!isNaN(score)) {
            subeSc(usu,se,score);
        }



    });
    /**
     * Delete the anime of the anime list.
     */
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
    /**
     * Add/delete to the favirites user list
     */
    $("#fav").click(function () {
        var fav = $(this).data("ope");
        var usu = $(this).data("usu");
        var se = $(this).data("se");
        modFav(usu,se, fav);
    });
});
