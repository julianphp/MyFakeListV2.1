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

            var ctxP = document.getElementById("pieChart").getContext('2d');
            var myPieChart = new Chart(ctxP, {

                type: 'pie',
                data: {
                    labels: ["Total", "Viendo", "Completado", "Para Ver", "Dropeado"],
                    datasets: [{
                        data: [datos.all, datos.viendo, datos.completed, datos.paraver, datos.drop],
                        backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360"],
                        hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774"]
                    }]
                },
                options: {
                    responsive: true
                }
            });

        }

    })

}

//pie
var usu = document.getElementById('123');
getInfo(usu.value)

