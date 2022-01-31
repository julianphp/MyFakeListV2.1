window.addEventListener('load', function () {

    let addCap = document.querySelectorAll('.fa-plus-circle');

    addCap.forEach(item => {
        item.addEventListener('click', function (e) {
            sendRequest('/lista/cap', {
                'usu': e.target.dataset.usu,
                'ser': e.target.dataset.se
            }).then(data => {
                if (!data.error) {
                    document.getElementById('cap' + e.target.dataset.se).innerText = data.cap;
                } else {
                    alert(lang[language].error_generic);
                }
            });
        })
    });
}, false);
