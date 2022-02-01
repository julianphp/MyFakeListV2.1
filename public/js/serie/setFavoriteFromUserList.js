const setFavorite = document.getElementById('fav');
if (setFavorite){
    setFavorite.addEventListener('click', function (e){
        sendRequest('/serie/favoritos',{
            'usu': e.target.dataset.usu,
            'ser': e.target.dataset.ser,
            'ope': e.target.dataset.ope
        }).then(data => {
            if(data.error){
                alert(langGeneric[language].error_generic);
            } else {
                location.reload();
            }
        })
    });
}
