<?php include_once 'include/header.html'; ?>

<main class="main-content">
            
    <h2>Inscription</h2>

    <div class="d-flex justify-content-center">
        <form class="col-8">
            <fieldset>
                <legend>Identifiants</legend>
                
                <input id="input-inscription-pseudo" type="text" name="pseudo" placeholder="Pseudo">
                <input id="input-inscription-courriel" type="text" name="courriel" placeholder="Adresse courriel">
            </fieldset>
            
            <fieldset>
                <legend>Mot de passe</legend>

                <input id="input-inscription-password" type="password" name="password" placeholder="Mot de passe">
                <input id="input-inscription-password-confirm" type="password" name="password" placeholder="Confirmation">
            </fieldset>
    
            <button id="form-submit-inscription" type="submit">Inscription</button>
        </form>
    </div>

</main>

<script src="./assets/main.js"></script>