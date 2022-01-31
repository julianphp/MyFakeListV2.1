window.addEventListener('load', function () {
    let chooseScore = document.querySelectorAll('.spanScoreUser');
    chooseScore.forEach(item => {
        item.addEventListener('click', function (e) {
            e.target.hidden = true;
            document.getElementById('selectScoreUser-' + e.target.dataset.idsc).hidden = false;
        });
    });

    let uploadScore = document.querySelectorAll('.selectScoreUser');
    uploadScore.forEach(item => {
        item.addEventListener('change', function (e){
            sendRequest('/lista/score',{
                'usu': e.target.dataset.usu,
                'ser': e.target.dataset.ser,
                'sc': e.target.value
            }).then(data => {
                if (data.error){
                    alert(lang[language].error_generic)
                } else {
                    document.getElementById('selectScoreUser-' + e.target.dataset.idscore).hidden = true;
                    document.getElementById('spanIdScoreUser-' + e.target.dataset.idscore).hidden = false;
                }
            });
        });
    });

}, false);
