let btnModalEdit = document.querySelectorAll('.edit');
btnModalEdit.forEach( item => {
    item.addEventListener('click', function (e){
        document.getElementById('titulo').innerText = e.target.dataset.titulo;
        document.getElementById('idSeM').value = e.target.dataset.idse;
        document.getElementById('tit').value = e.target.dataset.tit;
        document.getElementById('cap').value = e.target.dataset.cap;
        document.getElementById('cap').max = e.target.dataset.caplast;
        document.getElementById('capLast').innerText = e.target.dataset.caplast;
        document.getElementById('rev').value = e.target.dataset.rev;
        document.getElementById('fec_ini').innerText = e.target.dataset.ini;
        document.getElementById('fec_fin').innerText = e.target.dataset.fin === "" ? "No terminada aun." : e.target.dataset.fin;

        let sts = e.target.dataset.sts;
        let fav = e.target.dataset.fav;
        if (sts === "Para_Ver"){
            sts = "Para Ver";
        }
        let favD = document.getElementById('favD');
        let favA = document.getElementById('favA');
        if (parseInt(fav) === 1){
            favD.hidden = false;
            favA.hidden = true;
        } else {
            favA.hidden = false;
            favD.hidden = true;
        }
        document.getElementById('modalSelectStatus').value = sts;
        new bootstrap.Modal(document.getElementById('modalListaEditarSerie')).show();
    });
});
