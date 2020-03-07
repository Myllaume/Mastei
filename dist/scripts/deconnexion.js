var btnDeconnexion = document.querySelector('#btn-deconnexion');
if (btnDeconnexion) {
    btnDeconnexion.addEventListener('click', () => {
        var ajax = new ajaxRequest('GET');
        ajax.filePath('./core/controllers/authentification.php');
        ajax.showError();
        ajax.addArgument({
            'action': 'deconnexion'
        });
        ajax.send((json) => {
            console.log(json);
            
        });
    });
}