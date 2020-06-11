
$(document).ready(function () {
    /**
     * Show the modal 1 for change the password
     */
    $(".btn1").click(function () {

        $(".modal1").modal();
    });
    /**
     * Show the modal 2 for change the email
     */
    $("#btnEmail").click(function () {

        $(".modal2").modal();
    });
    $("#btnDelAcc").click(function () {

        $(".modal3").modal();
    });
    /**
     * Get the name of the file for upload an avatar
     */
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
        $('.uplpht').removeAttr('disabled');
    });
});

