var formConnexion = {
    this: document.querySelector('#form-connexion'),
    btnSubmit: document.querySelector('#form-connexion-submit'),

    input : {
        courriel : document.querySelector('#input-connexion-courriel'),
        password : document.querySelector('#input-connexion-password')
    }
}

var userbar = {
    this: document.querySelector('#user-bar'),
    pseudo: document.querySelector('#user-pseudo')
};

if (formConnexion.this) {
    
    formConnexion.this.parentNode.addEventListener('click', (e) => {
        formConnexion.this.classList.add('form-connexion--visible');
    });
    
    // auto-focus formulaire
    // form.input.courriel.focus();
    
    formConnexion.this.addEventListener('submit', (e) => {
        e.preventDefault();

        $.post( "./core/controllers/authentification.php?action=connexion",
            {
                courriel: formConnexion.input.courriel.value,
                password: formConnexion.input.password.value
            })
            .done(function( data ) {
                console.log(data);
            });
    
        // var ajax = new ajaxRequest('POST');
        // ajax.filePath('./core/controllers/authentification.php');
        // ajax.addForm(formConnexion.this, formConnexion.btnSubmit);
        // ajax.showError();
        // ajax.addArgument({
        //     'action': 'connexion'
        // });
        // ajax.send((json) => {
        //     if (json.isOk) {
        //         userbar.this.classList.add('user-bar--active');
        //         userbar.pseudo.textContent = 'Myllaume' ;
        //     }
        // });
    });
}

var btnDeconnexion = document.querySelector('#btn-deconnexion');
if (btnDeconnexion) {
    console.log(userbar.this);
    btnDeconnexion.addEventListener('click', () => {

        

        // $.get( "./core/controllers/authentification.php",
        // { action: "deconnexion" });

        $.get( "./core/controllers/authentification.php", { action: "deconnexion" } )
            .done(function( data ) {
                if (data.isOk) {
                    userbar.this.classList.remove('user-bar--active');
                }
            });
    });
}