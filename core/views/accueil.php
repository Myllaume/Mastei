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