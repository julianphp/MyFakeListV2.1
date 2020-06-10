/**
 * AJAX and CHARTJS, get the stats of the user and display the chartjs
 * @param usu
 */
function getInfo(usu) {
    $.ajaxSetup({

        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: APP_URL+'/perfil/stats',
        type: 'POST',
        dataType: 'HTML',
        data: { usu : usu
        },
        success: function (data) {
            const datos = JSON.parse(data)
            if (datos.all === 0){
               $("#nochartjs").text("No tiene ninguna serie en su lista aun :(")
            } else {
                $("#all").text(datos.all)
                $("#completed").text(datos.completed)
                $("#drop").text(datos.drop)
                $("#ptw").text(datos.paraver)
                $("#viendo").text(datos.viendo)
                var ctxP = document.getElementById("pieChart").getContext('2d');
                var myPieChart = new Chart(ctxP, {

                    type: 'pie',
                    data: {
                        labels: ["Total", "Viendo", "Completado", "Para Ver", "Dropeado"],
                        datasets: [{
                            data: [datos.all, datos.viendo, datos.completed, datos.paraver, datos.drop],
                            backgroundColor: ["#0075c6", "#08b300", "#fdb45c", "#4D5360", "#b70000"],
                            hoverBackgroundColor: ["#00c4ff", "#0fff00", "#ffc870", "#818c9b", "#ff0000"]
                        }]
                    },
                    options: {
                        responsive: true
                    }
                });

            }


        }

    })

}

/**
 * Get the idUser and call to the ajax&chartjs function
 * @type {HTMLElement}
 */
var usu = document.getElementById('123');
getInfo(usu.value)

