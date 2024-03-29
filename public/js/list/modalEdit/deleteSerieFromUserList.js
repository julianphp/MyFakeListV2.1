window.addEventListener('load', function () {
    const btnDelete = document.getElementById('btnd');
    if (btnDelete) {
        btnDelete.addEventListener('click', function () {
            new bootstrap.Modal(document.getElementById('modalDeleteSerieFromUserList')).show();
            document.getElementById('del').addEventListener('click', function () {
                sendRequest('/serie/borrarUsuSe', {
                    'usu': document.getElementById('idUsuM').value,
                    'ser': document.getElementById('idSeM').value,
                }).then(data => {
                    if (data.error) {
                        alert(langGeneric[language].error_generic);
                    }
                    window.location.reload();
                })
            });
        });
    }

});
