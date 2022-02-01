const addToUserList = document.getElementById('btnAddToUserList');
if (addToUserList){
    addToUserList.addEventListener('click', function (e){
        sendRequest('/serie/addSeriesToUserList',{
            'usu': e.target.dataset.usu,
            'ser': e.target.dataset.ser
        }).then( data => {
            if (data.error){
                alert(langGeneric[language].error_generic);
            }
            location.reload();
        });
    });

}
