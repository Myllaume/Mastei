<nav id="nav" class="nav">

    <section id="user-bar" class="user-bar <?php if (verif_access(1)) { echo 'user-bar--active'; } ?>">
        <div class="d-flex align-content-center col-4 p-1">
            <div class="user-bar__photo-profil"></div>
            <span id="user-pseudo" class="user-bar__pseudo"><?= $_SESSION['pseudo'] ?></span>
        </div>

        <div class="col-4 p-1">
            <ul class="user-bar__stats-list">
                <li id="user-nb-secret">Secrets : 22</li>
                <li id="user-nb-message">Messages : 12</li>
            </ul>
        </div>
        
        <div class="col-4 p-1 d-flex flex-column">
            <button id="btn-deconnexion" class="btn btn--noir">Déconnexion</button>
            <a id="btn-operateur" class="btn btn--noir" href="#">Mode opérateur</a>
        </div>
    </section>

    <ul class="nav__main-list">
        <li id="nav-switch" class="nav__link nav__link--main"><?php if (verif_access(1)) {
            echo '<div id="nav-deploy">Jeux</div>
<ul class="nav__sub-list">
    <li class="nav__link nav__link--sub">
        <a class="nav__link--game" href="#">
            <div class="nav__game-icon"></div>
            <span class="nav__game-name">Uglakas</span>
        </a>
    </li>
    <li class="nav__link nav__link--sub">
        <a class="nav__link--game" href="#">
            <div class="nav__game-icon"></div>
            <span class="nav__game-name">Ekabert</span>
        </a>
    </li>
    <li class="nav__link nav__link--sub">
        <a class="nav__link--game" href="#">
            <div class="nav__game-icon"></div>
            <span class="nav__game-name">Éppipe</span>
        </a>
    </li>
</ul>';}
else {
    echo '<div id="nav-deploy">Jouer</div>
<form id="form-connexion" class="form-connexion">
    <input id="input-connexion-pseudo" type="text" name="pseudo" placeholder="Pseudo">
    <input id="input-connexion-password" type="password" name="password" placeholder="Mot de passe">

    <button id="form-submit-connexion" type="submit">Connexion</button>
    <a href="?view=inscription">Inscription</a>
</form>
    ';} ?>
            
        </li>
        <li class="nav__link nav__link--main">Univers
            <ul class="nav__sub-list">
                <li class="nav__link nav__link--sub">
                    <a href="#">Carte du monde</a>
                </li>
                <li class="nav__link nav__link--sub">
                    <a href="#">Scénarios</a>
                </li>
            </ul>
        </li>
        <li class="nav__link nav__link--main">Communauté
            <ul class="nav__sub-list">
                <li class="nav__link nav__link--sub">
                    <a href="#">Forum</a>
                </li>
                <li class="nav__link nav__link--sub">
                    <a href="#">Support</a>
                </li>
            </ul>
        </li>
    </ul>
</nav>