/**
 * Éléments et fonctions du formulaire
 * ---
 * - this : élément formulaire
 * - btn : boutons de fonctionnement du formulaire
 * - input : inputs du formulaire
 * - open : foncton d'ouverture du formulaire
 * - send : fonction de requête pour la connexion
 */

var formConnexion = {
    this: document.querySelector('#form-connexion'),

    btn: {
        open: document.querySelector('#nav-deploy'),
        connexion: document.querySelector('#form-submit-connexion')
    },

    input: {
        pseudo: document.querySelector('#input-connexion-pseudo'),
        password: document.querySelector('#input-connexion-password')
    },

    open: function() {
        formConnexion.this.classList.toggle('form-connexion--visible');
    },

    gen: function() {
        // vidage du contenant du formulaire
        navigation.switcher.innerHTML = '';

        // génération des éléments du formulaire
        formConnexion.btn.open = document.createElement('div');
        formConnexion.btn.open.textContent = 'Jouer';
        navigation.switcher.appendChild(formConnexion.btn.open);

        formConnexion.this = document.createElement('form');
        formConnexion.this.classList.add('form-connexion');
        navigation.switcher.appendChild(formConnexion.this);

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

        formConnexion.btn.inscription = document.createElement('button');
        formConnexion.btn.inscription.setAttribute('type', 'submit');
        formConnexion.btn.inscription.textContent = 'Inscription';
        formConnexion.this.appendChild(formConnexion.btn.inscription);

        // écouteurs d'évènement
        formConnexion.btn.open.addEventListener('click', formConnexion.open);

        formConnexion.btn.connexion.addEventListener('click', formConnexion.send);
    },

    send: function(event) {
        event.preventDefault();

        $.post('./core/controllers/authentification.php?action=connexion',
            {
                pseudo: formConnexion.input.pseudo.value,
                password: formConnexion.input.password.value
            },
            function( json ) {
                if (json.isOk) {
                    console.log(json);
                    
                    userbar.this.classList.add('user-bar--active');
                    formConnexion.this.classList.remove('form-connexion--visible');
                    userbar.pseudo.textContent = json.data.pseudo;
                    userbar.nbSecret = json.data.nbSecret;
                    userbar.nbMessage = json.data.nbMessage;

                    if (json.data.accessLvl >= 3) {
                        userbar.addBtnOpe();
                    }

                    // remplacement du formulaire par la liste des jeux
                    navigation.switcher.innerHTML = json.data.html;
                } else {
                    var notifConnexion = new Terminal;
                    notifConnexion.addMessage('Erreur : ' + json.consolMsg);
                    notifConnexion.addTime(4);
                }
            }, 'json'
        ).fail(function (data) {
            console.error(data);
        });
    }
};

/**
 * Éléments de la barre utilisateur
 * ---
 * - this : élément barre utilisateur
 * - pseudo : élément texte pseudo
 * - nbSecret : élément texte nombre de secret
 * - nbMessage : élément nombre de message
 * - close : fonction de fermeture de la userbar
 */

var userbar = {
    this: document.querySelector('#user-bar'),
    pseudo: document.querySelector('#user-pseudo'),
    nbSecret: document.querySelector('#user-nb-secret'),
    nbMessage: document.querySelector('#user-nb-message'),
    contenerBtns: document.querySelector('#user-btn-contener'),

    btn: {
        ope: document.createElement('a')
    },

    addBtnOpe: function() {
        userbar.btn.ope.classList.add('btn', 'btn--noir');
        userbar.btn.ope.textContent = 'Mode opérateur';
        userbar.btn.ope.setAttribute('href', '#');
        userbar.contenerBtns.appendChild(userbar.btn.ope);
    },

    close: function() {
        userbar.this.classList.remove('user-bar--active');
    }
};

/**
 * Éléments de la navigation
 * ---
 * - switcher : élément contenant alternativement la liste des jeux
 * et le formulaire de connexion
 * - btnDeconnexion : élément bouton de déconnexion
 */

var navigation = {
    this: document.querySelector('#nav'),
    switcher: document.querySelector('#nav-switch'),
    btnDeconnexion: document.querySelector('#btn-deconnexion')
};

/**
 * Écouteurs d'évènement
 * ---
 * écouteurs d'évènements appliqués aux éléments en place
 * lors de la génération de la page
 */


if (formConnexion.this) {
    // si le formulaire est inséré dans la page :

    formConnexion.btn.open.addEventListener('click', formConnexion.open);

    formConnexion.this.addEventListener('submit', formConnexion.send);
}

if (navigation.this) {
    navigation.btnDeconnexion.addEventListener('click', () => {
        $.get( "./core/controllers/authentification.php", { action: "deconnexion" },
        function( json ) {
            if (json.isOk) {
                userbar.close();
                formConnexion.gen(); // re-génération du formulaire
            }
        }, 'json' )
    });
}

var formInscription = {
    this: document.querySelector('#form-inscription'),
    btnSubmit: document.querySelector('#form-submit-inscription'),

    input: {
        pseudo: document.querySelector('#input-inscription-pseudo'),
        courriel: document.querySelector('#input-inscription-courriel'),
        password: document.querySelector('#input-inscription-password'),
        passwordConfirm: document.querySelector('#input-inscription-password-confirm')
    },

    send: function(event) {
        event.preventDefault();

        $.post('./core/controllers/authentification.php?action=inscription',
            {
                pseudo: formInscription.input.pseudo.value,
                courriel: formInscription.input.courriel.value,
                password: formInscription.input.password.value,
                confirm_password: formInscription.input.passwordConfirm.value
            },
            function( json ) {
                var notifConnexion = new Terminal;
                if (json.isOk) {
                    notifConnexion.addMessage(json.consolMsg);
                } else {
                    notifConnexion.addMessage('Erreur : ' + json.consolMsg);
                }
                notifConnexion.addTime(4);
            }, 'json'
        ).fail(function (data) {
            console.error(data);
        });
    }
}

if (formInscription.this) {
    formInscription.this.addEventListener('submit', formInscription.send);
}