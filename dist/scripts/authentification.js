var formConnexion = {
    this: document.querySelector('#form-connexion'),

    btn: {
        connexion: document.querySelector('#form-submit-connexion'),
        inscription: document.querySelector('#form-submit-inscription')
    },

    input: {
        pseudo: document.querySelector('#input-connexion-pseudo'),
        password: document.querySelector('#input-connexion-password')
    },

    connecter: function (event) {
        event.preventDefault();

        $.post('./core/controllers/authentification.php?action=connexion',
            {
                pseudo: formConnexion.input.pseudo.value,
                password: formConnexion.input.password.value
            },
            function( json ) {
                if (json.isOk) {
                    userbar.this.classList.add('user-bar--active');
                    formConnexion.this.classList.remove('form-connexion--visible');
                    userbar.pseudo.textContent = json.data.pseudo;
                    userbar.nbSecret = json.data.nbSecret;
                    userbar.nbMessage = json.data.nbMessage;

                    navSwitch.innerHTML = json.data.html;
                }
            }, 'json'
        );
    }
}

var userbar = {
    this: document.querySelector('#user-bar'),
    pseudo: document.querySelector('#user-pseudo'),
    nbSecret: document.querySelector('#user-nb-secret'),
    nbMessage: document.querySelector('#user-nb-message')
};

var navSwitch = document.querySelector('#nav-switch')

if (formConnexion.this) {
    
    formConnexion.this.parentNode.addEventListener('click', (e) => {
        formConnexion.this.classList.add('form-connexion--visible');
        formConnexion.input.pseudo.focus();
    });
    
    formConnexion.btn.connexion.addEventListener('click', formConnexion.connecter);
}

var btnDeconnexion = document.querySelector('#btn-deconnexion');

if (btnDeconnexion) {

    btnDeconnexion.addEventListener('click', () => {
        $.get( "./core/controllers/authentification.php", { action: "deconnexion" },
        function( json ) {
            if (json.isOk) {
                userbar.this.classList.remove('user-bar--active');
                navSwitch.innerHTML = 'Jouer';

                formConnexion.this = document.createElement('form');
                formConnexion.this.classList.add('form-connexion');
                navSwitch.appendChild(formConnexion.this);

                formConnexion.input.pseudo = document.createElement('input');
                formConnexion.input.pseudo.setAttribute('type', 'text');
                formConnexion.input.pseudo.setAttribute('name', 'pseudo');
                formConnexion.input.pseudo.setAttribute('placeholder', 'Pseudo');
                formConnexion.this.appendChild(formConnexion.input.pseudo);
                
                formConnexion.input.password = document.createElement('input');
                formConnexion.input.password.setAttribute('type', 'password');
                formConnexion.input.password.setAttribute('name', 'password');
                formConnexion.input.password.setAttribute('placeholder', 'Mot de passe');
                formConnexion.this.appendChild(formConnexion.input.password);

                formConnexion.btn.connexion = document.createElement('button');
                formConnexion.btn.connexion.setAttribute('type', 'submit');
                formConnexion.btn.connexion.textContent = 'Connexion';
                formConnexion.this.appendChild(formConnexion.btn.connexion);

                formConnexion.btn.connexion.addEventListener('click', formConnexion.connecter);

                formConnexion.btn.inscription = document.createElement('button');
                formConnexion.btn.inscription.setAttribute('type', 'submit');
                formConnexion.btn.inscription.textContent = 'Inscription';
                formConnexion.this.appendChild(formConnexion.btn.inscription);
            }
        }, 'json' )
    });

}