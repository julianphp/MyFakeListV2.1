/**
 * Busqueda global de series y usuarios.
 */
document.addEventListener("DOMContentLoaded", function(event) {
    document.getElementById('busqueda').addEventListener('keyup', function (e) {
        if (e.target.value !== "" && e.target.value.length >= 3) {
            setTimeout(function () {
                sendRequest("/busqueda1", {
                    'texto' : e.target.value
                }).then( data => {
                    if (typeof data.error !== "undefined") {
                        return;
                    }
                    document.getElementById('resultadoBus').innerHTML = data;
                });
            }, 500);
        }
    });
});
