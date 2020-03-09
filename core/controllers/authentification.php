<?php
ini_set('display_errors','on');
error_reporting(E_ALL);
session_start();

if (!isset($_GET) || empty($_GET['action'])) {
    exit;
}

include_once '../bdd.php';
$bdd = connexionBdd();

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
        if (isset($_POST) && !empty($_POST['pseudo']) && !empty($_POST['password'])) {

            require_once '../models/user.php';
            $class_user = new User;

            try {
                $class_user->set_pseudo($_POST['pseudo']);
                $class_user->select_bdd($bdd);
                $class_user->verif_password($_POST['password']);

                $_SESSION['id'] = $class_user->get_id();
                $_SESSION['pseudo'] = $class_user->get_pseudo();
                $_SESSION['access_lvl'] = $class_user->get_access_lvl();
                $_SESSION['message'] = 3;
                $_SESSION['stats_secret'] = 3;

                $is_ok = true;
                $consol_msg = 'Connexion réussie.';
                $data = ['pseudo' => $_SESSION['pseudo'], 'nbSecret' => $_SESSION['stats_secret'],
                    'nbMessage' => $_SESSION['message'], 'html' => $html_jeux];

            } catch (Exception $error) {
                $consol_msg = $error->getMessage();
            }

        } else {
            $consol_msg = 'Il manque des informations.';
        }
        break;

    case 'deconnexion':
            $is_ok = true;
            $consol_msg = 'Deconnexion réussie.';

            $_SESSION = array();
            session_destroy();
        break;
}

echo json_encode(array('isOk' => $is_ok, 'consolMsg' => $consol_msg, 'data' => $data));