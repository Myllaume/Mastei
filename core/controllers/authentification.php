<?php
session_start();

if (!isset($_GET) || empty($_GET['action'])) {
    exit;
}

$html_jeux = 'Jeux
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
</ul>';

// stockage de l'argument d'action
$action = $_GET['action'];

$is_ok = false;
$consol_msg = 'Aucun traitement.';
$data = [];

switch ($action) {
    case 'connexion':
        if (isset($_POST) && !empty($_POST['courriel']) && !empty($_POST['password'])) {
            $_SESSION['id'] = 8;
            $_SESSION['pseudo'] = 'Myllaume';
            $_SESSION['access_lvl'] = 3;
            $_SESSION['message'] = 3;
            $_SESSION['stats_secret'] = 3;

            $is_ok = true;
            $consol_msg = 'Connexion réussie.';
            $data = ['pseudo' => $_SESSION['pseudo'], 'nbSecret' => $_SESSION['stats_secret'],
                'nbMessage' => $_SESSION['message'], 'html' => $html_jeux];
        } else {
            $consol_msg = 'Il manque des informations.';
        }
        break;

    case 'deconnexion':
            $is_ok = true;
            $consol_msg = 'Deconnexion réussie.';
            $data = ['html' => $html_form];

            $_SESSION = array();
            session_destroy();
        break;
}

echo json_encode(array('isOk' => $is_ok, 'consolMsg' => $consol_msg, 'data' => $data));