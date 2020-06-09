
$(document).ready(function () {
    $(".btn1").click(function () {

        $(".modal").modal('show');
    });

    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
        $('.uplpht').removeAttr('disabled');
    });
});

