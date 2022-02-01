const selectStatus = document.getElementById('selectStatus');
if (selectStatus){
    selectStatus.addEventListener('change', function (e){
        console.log('hola que tla',document.getElementById('idUser').value, e.target.value, e.target.dataset.ser);
        sendRequest('/serie/modStatus',{
            'usu': document.getElementById('idUser').value,
            'ser': e.target.dataset.ser,
            'sts': e.target.value === 'Para Ver' ? 'Para_Ver' : e.target.value,
        }).then( data => {
            if (data.error){
                alert(langGeneric[language].error_generic);
            }

        });
    });
}
