<?php

if (!verif_access(1)) {
    header("Location: /");
    exit;
}

if (!isset($_GET) || empty($_GET['view']) || verif_access(1)) {
    $view = 'menu';
} else {
    $view = $_GET['view'];
}

switch ($view) {
    case 'accueil':
        include_once 'core/views/accueil.php';
        break;
    
    case 'menu':
        include_once 'core/views/menu.php';
        break;
}

function verif_access($access_required) {
    if (empty($_SESSION['access'])) {
        return false;
    }

    if ($_SESSION['access'] < $access_required) {
        return false;
    }

    return true;
}