<?php

if (!isset($_GET) || empty($_GET['view'])) {
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
    if (empty($_SESSION['access_lvl'])) {
        return false;
    }

    if ($_SESSION['access_lvl'] < $access_required) {
        return false;
    }

    return true;
}