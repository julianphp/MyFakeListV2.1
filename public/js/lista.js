/**
 * NOT IN USE.
 * AJAX Request for upload an eps of the anime
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
        url: APP_URL+'/lista/cap',
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
 * AJAX Request send the review
 * @param usu
 * @param se
 * @param text
 */
function subDes(usu, se, text) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: APP_URL+'/lista/review',
        type: 'POST',
        dataType: 'HTML',
        data: {
            usu : usu,
            se : se,
            text : text,
        }
    })


}

/**
 * AJAX Request, send the score of an anime
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
        url: APP_URL+'/lista/score',
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
 * AJAX Request, modal add/del favorite anime of user
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
            setTimeout(function () {
                $(".btnSendF").prop('hidden','e').delay(5000);
                if (opeS === 1) {
                    $("#favD").show();
                } else {
                    $("#favA").show();
                }
            },1000)

        })
}

/**
 * AJAX Request, Modal delete anime from list
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
$(document).ready(function () {

    /**
     * NOT IN USE.
     * Upload a eps on click
     */
    $( ".fa-plus-circle" ).click(function() {
        var usu = $(this).data("usu");
        var se = $(this).data("se");
       // subeCa(usu, se);
    });
    /**
     * Show the modal for edit the entry of the anime user
     */
    $(".edit").click(function () {
        $("#titulo").text($(this).data('titulo'))
        $("#idSeM").val($(this).data('idse'));
        $("#tit").val($(this).data('tit'));
        $("#cap").val($(this).data('cap'));
        $("#cap").val($(this).data('cap'));
        $("#rev").val($(this).data('rev'));
        $("#fec_ini").text($(this).data('ini'));
        $("#fec_fin").text($(this).data('fin') === "" ? "No terminada aun" : $(this).data('fin'));
        var sts = $(this).data('sts');
        var fav = $(this).data('fav');

        if (sts === "Para_Ver") {
             sts = "Para Ver"
        }
        if (fav === 1){
            $("#favD").show();
            $("#favA").hide();
        } else {
            $("#favA").show();
            $("#favD").hide();
        }

        $(".selEst").val(sts).find("option[value='" + sts +"']").attr('selected', true);
       // $("#"+sts).attr('selected');
        $("#staticBackdrop").modal('show');
    });
    /**
     * Check if the anime is in favorites or not
     */
    $(".btnfav").click(function () {
        $(this).hide();
        var ope = $(this).data('opefav');
        var idSe = $("#idSeM").val();
        var idUsu = $("#idUsuM").val()
        $(".btnSendF").removeAttr('hidden');


        modFav(idUsu,idSe,ope);
    });

    /**
     * Delete the anime from the user list
     */
    $("#btnd").click(function () {
        var titulo = $("#tit").val();
        var idSe = $("#idSeM").val();
        var idUsu = $("#idUsuM").val()
        $("#md").text(titulo);
        $("#borrarserie").modal();

        $("#del").click(function () {
            import(borraSeUsu(idUsu,idSe))
        })
    });

    /**
     * edit the score
     */
    $(".sco1").click(function () {
        var id = $(this).data("idsc");
        $("#sco1"+id).hide();
        $("#sco"+id).removeAttr("hidden");

    });
    /**
     * edit the score
     */
    $(".score").focusout(function () {
        var score = $(this).val();
        var usu = $(this).data("usu");
        var se = $(this).data("se");
        var id = $(this).data("idscore");
        if (score !== "-") {


            subeSc(usu,se,score);

        }
        $("#sco1"+id).text(score);
        $("#sco"+id).prop("hidden","e");
        $("#sco1"+id).show();

    });
    /**
     * the review of the anime
     */
    /*
    $(".spanCommentUser").click(function () {
        var text1 = $(this).text();
        var id = $(this).data("ids");
        $("#s"+id).hide();

        $("#txt"+id).val(text1);
        $("#txt"+id).removeAttr("hidden");

    });
    /**
     * Edit the textbox of the review
     */
    /*
    $(".tex1").focusout( function () {
        var id = $(this).data("idt");
        var text =$(this).val();
        $("#s"+id).text(text);
        $("#txt"+id).prop("hidden","e");
        $("#s"+id).show();

        var usu = $(this).data("usu");
        var se = $(this).data("se");
        if (text !== "--- ") {

            subDes(usu, se, text);
        }

    });

     */


});
