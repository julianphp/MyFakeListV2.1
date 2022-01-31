window.addEventListener('load', function () {
    let btnFav = document.querySelectorAll('.btnfav');
    btnFav.forEach(item => {
        item.addEventListener('click', function (e){
            document.getElementById('btnLoading').hidden = false;
            sendRequest('/serie/favoritos',{
                'usu': document.getElementById('idUsuM').value,
                'ser': document.getElementById('idSeM').value,
                'ope': e.target.dataset.opefav
            }).then( data => {
                setTimeout(function () {
                    document.getElementById('btnLoading').hidden = true;
                    if (data.error){
                        alert(lang[language].error_generic);
                    } else {
                        e.target.hidden = true;
                        document.getElementById(e.target.id === 'favA' ? 'favD' : 'favA').hidden = false;
                    }
                },1000)

            })
        });
    });
});
