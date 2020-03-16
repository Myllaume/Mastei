<?php include_once 'include/header.html'; ?>

<main class="main-content">
            
    <h2>Inscription</h2>

    <div class="d-flex justify-content-center">
        <form id="form-inscription" class="col-8">                
            <input id="input-inscription-pseudo" type="text" name="pseudo" placeholder="Pseudo">
            <input id="input-inscription-courriel" type="text" name="courriel" placeholder="Adresse courriel">
            <input id="input-inscription-password" type="password" name="password" placeholder="Mot de passe">
            <input id="input-inscription-password-confirm" type="password" name="confirm_password" placeholder="Confirmation">
    
            <button id="form-submit-inscription" type="submit">Inscription</button>
            <a href="./">Retour à l'accueil</a>
        </form>
    </div>

</main>

<script src="./assets/main.js"></script>