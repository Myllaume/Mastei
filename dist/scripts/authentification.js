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
        formConnexion.input.courriel.focus();
    });
    
    formConnexion.this.addEventListener('submit', (e) => {
        e.preventDefault();

        $.post( "./core/controllers/authentification.php?action=connexion",
            {
                courriel: formConnexion.input.courriel.value,
                password: formConnexion.input.password.value
            },
            function( data ) {
                if (data.isOk) {$
                    userbar.this.classList.add('user-bar--active');
                    formConnexion.this.classList.remove('form-connexion--visible');
                    userbar.pseudo.textContent = 'Myllaume';
                }
            }, 'json');
    });
}

var btnDeconnexion = document.querySelector('#btn-deconnexion');

if (btnDeconnexion) {

    btnDeconnexion.addEventListener('click', () => {
        $.get( "./core/controllers/authentification.php", { action: "deconnexion" },
        function( data ) {
            if (data.isOk) {
                userbar.this.classList.remove('user-bar--active');
            }
        }, 'json' )
    });

}