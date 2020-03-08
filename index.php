<?php
session_start();
ini_set('display_errors','on');
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Masteï, univers narratif</title>
    <link rel="stylesheet" href="./assets/main.css">
</head>

<body>

<script src="./libs/jquery.js"></script>
    
    <div class="wrapper">

        <?php include_once './core/controllers/rooter.php'; ?>

    </div>

</body>

</html>