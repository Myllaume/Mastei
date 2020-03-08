<nav class="nav">

    <section id="user-bar" class="user-bar <?php if (verif_access(1)) { echo 'user-bar--active'; } ?>">
        <div class="d-flex align-content-center col-4 p-1">
            <div class="user-bar__photo-profil"></div>
            <span id="user-pseudo" class="user-bar__pseudo"><?= $_SESSION['pseudo'] ?></span>
        </div>

        <div class="col-4 p-1">
            <ul class="user-bar__stats-list">
                <li>Secrets : 22</li>
                <li>Messages : 12</li>
            </ul>
        </div>
        
        <div class="col-4 p-1">
            <button id="btn-deconnexion" class="btn">Déconnexion</button>
            <button class="btn-operateur">Mode opérateur</button>
        </div>
    </section>

    <ul class="nav__main-list">

        <?php if (verif_access(1)): ?>
        <li class="nav__link nav__link--main">Jeux
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
            </ul>
        </li>

        <?php else: ?>
        <li class="nav__link nav__link--main">Connexion
            <form id="form-connexion" class="form-connexion">
                <input id="input-connexion-courriel" type="email" name="courriel" placeholder="Adresse mail">
                <input id="input-connexion-password" type="password" name="password" placeholder="Mot de passe">

                <button id="form-submit" type="submit">Connexion</button>
                <button id="form-submit" type="submit">Inscription</button>
            </form>
        </li>
        <?php endif; ?>
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