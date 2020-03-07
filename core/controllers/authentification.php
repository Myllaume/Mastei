<?php
session_start();

if (!isset($_GET) || empty($_GET['action'])) {
    exit;
}

// stockage de l'argument d'action
$action = $_GET['action'];

$is_ok = false;
$consol_msg = 'Aucun traitement.';
$data = [];

switch ($action) {
    case 'connexion':
        if (isset($_POST) && !empty($_POST['courriel']) && !empty($_POST['password'])) {
            $_SESSION['id'] = 8;
            $_SESSION['access_lvl'] = 3;

            $is_ok = true;
            $consol_msg = 'Connexion réussie.';
            $data = ['id' => $_SESSION['id'], 'access_lvl' => $_SESSION['access_lvl']];
        } else {
            $consol_msg = 'Il manque des informations.';
        }
        break;

    case 'deconnexion':
            $_SESSION = array();
            session_destroy();
        break;
}

echo json_encode(array('isOk' => $is_ok, 'consolMsg' => $consol_msg, 'data' => $data));