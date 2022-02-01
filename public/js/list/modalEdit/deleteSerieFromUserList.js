window.addEventListener('load', function () {
    const btnDelete = document.getElementById('btnd');
    if (btnDelete) {
        btnDelete.addEventListener('click', function () {
            $("#borrarserie").modal();
            document.getElementById('del').addEventListener('click', function () {
                sendRequest('/serie/borrarUsuSe', {
                    'usu': document.getElementById('idUsuM').value,
                    'ser': document.getElementById('idSeM').value,
                }).then(data => {
                    if (data.error) {
                        alert(lang[language].error_generic);
                    }
                    window.location.reload();
                })
            });
        });
    }

});
