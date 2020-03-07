<?php include_once 'include/header.html'; ?>

<main class="main-home">
            
    <section class="d-flex flex-column justify-content-center align-content-center my-5">

        <form id="form" class="col-6">
            <input id="input-courriel" type="email" name="courriel" placeholder="Adresse mail">
            <input id="input-password" type="password" name="password" placeholder="Mot de passe">
            <button id="form-submit" type="submit">Connexion</button>

            <div id="form-feedback"></div>
        </form>

        <button id="form-reverse" class="my-3 col-6 || btn">Inscription</button>

    </section>

</main>

<script src="./assets/main.js"></script>

<script>
    var form = {
        this: document.querySelector('#form'),
        btnReverse: document.querySelector('#form-reverse'),
        btnSubmit: document.querySelector('#form-submit'),
        feedback: document.querySelector('#form-feedback'),

        input : {
            courriel : document.querySelector('#input-courriel'),
            password : document.querySelector('#input-password')
        }
    }

    // auto-focus formulaire
    form.input.courriel.focus();

    form.this.addEventListener('submit', (e) => {
        e.preventDefault();

        var ajax = new ajaxRequest('POST');
        ajax.filePath('./core/controllers/authentification.php');
        ajax.addForm(form.this, form.btnSubmit);
        ajax.showError();
        ajax.addArgument({
            'action': 'connexion'
        });
        ajax.send((json) => {
            if (json.isOk) {
                document.location.href="/"; 
            } else {
                feedback.textContent = json.consolMsg;
            }
        });
    });

    let isReverse = false;

    form.btnReverse.addEventListener('click', () => {

        if (!isReverse) {
            form.input.pseudo = document.createElement('input');
            form.input.pseudo.setAttribute('type', 'text');
            form.input.pseudo.setAttribute('placeholder', 'Pseudo');
            form.this.insertBefore(form.input.pseudo, form.input.courriel);

            form.btnReverse.textContent = 'Connexion';
            form.btnSubmit.textContent = 'Inscription';
            isReverse = true;
        } else {
            form.input.pseudo.remove();
            form.btnReverse.textContent = 'Inscription';
            form.btnSubmit.textContent = 'Connexion';
            isReverse = false;
        }
    });

</script>