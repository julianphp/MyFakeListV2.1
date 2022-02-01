window.addEventListener('load', function () {
    let editCommentUser = document.querySelectorAll('.spanCommentUser');
    editCommentUser.forEach(item => {
        item.addEventListener('click', function (e){
            let textarea = document.getElementById('textareaCommentUser-' + e.target.dataset.idrow);
            textarea.value = e.target.innerText;
            textarea.hidden = false;
            e.target.style.display = 'none';
        });
    });

    let setCommentUser = document.querySelectorAll('.textareaCommentUser');
    setCommentUser.forEach( item => {
        item.addEventListener('focusout', function (e){
            let id = e.target.dataset.idrow;
            let text = e.target.value;

            sendRequest('/lista/review',{
                'usu': e.target.dataset.usu,
                'ser': e.target.dataset.ser,
                'text': e.target.value,
            }).then( data => {
                if( data.error){
                    if(data.msg){
                        let textmsg = '';
                        for( let x in data.msg){
                            textmsg += data.msg[x];
                        }
                        alert(textmsg);
                    } else {
                        alert(langGeneric[language].error_generic);
                    }
                } else {
                    let spanCommentUser = document.getElementById('spanCommentUser-' + id)
                    spanCommentUser.innerText = text;
                    document.getElementById('textareaCommentUser-' + id).hidden = true;
                    spanCommentUser.style.display = 'block';
                }
            });
        });
    });
}, false);
