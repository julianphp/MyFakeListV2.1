document.addEventListener("DOMContentLoaded", function(event) {
    document.getElementById('btnEmail').addEventListener('click', function () {
        let myModal = new bootstrap.Modal(document.getElementById('modalChangeEmail'))
        myModal.toggle();
    });
    document.getElementById('btnDelAcc').addEventListener('click', function () {
        new bootstrap.Modal(document.getElementById('modalDeleteAccount')).toggle();
    })
    document.getElementById('inputPhotoUser').addEventListener('change', function () {
        document.getElementById('btnUploadPhotoUser').disabled = false;
    })
});


