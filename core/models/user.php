<?php

class User {
    private $id;
    private $pseudo;
    private $courriel;
    private $password;
    private $access_lvl;

    function __construct() {
        $this->id = intval($this->id);
        $this->pseudo = strval($this->pseudo);
        $this->courriel = strval($this->courriel);
        $this->password = strval($this->password);
        $this->access_lvl = intval($this->access_lvl);
    }

    function set_id($var) {
        if (!is_integer($var)) {
            throw new Exception("L'id utilisateur doit être un nombre entier");
        }
        
        $this->id = intval($var);
    }

    function get_id() {
        return $this->id;
    }

    function set_pseudo($var) {
        if (!is_string($var)) {
            throw new Exception("Le pseudo utilisateur doit être une chaine de caractère");
        }

        if (strlen($var) > 50) {
            throw new Exception("Le pseudo utilisateur ne doit pas excéder 50 caractères");
        }
        
        $this->pseudo = strval($var);
    }

    function get_pseudo() {
        return $this->pseudo;
    }

    function set_courriel($var) {
        if (strlen($var) > 200) {
            throw new Exception("L'adresse courriel utilisateur ne doit pas excéder 200 caractères");
        }

        if (!filter_var($var, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("L'adresse courriel utilisateur entrée est invalidée par PHP");
        }
        
        $this->courriel = strval($var);
    }

    function get_courriel() {
        return $this->courriel;
    }

    function set_password($var) {
        // if (strlen($var) < 12 && strlen($var) >= 255) {
        //     throw new Exception('La longueure du mot de passe utilisateur est insuffisante.');
        // }

        // if (!preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W)#', $var)) {
        //     throw new Exception("Le mot de passe utilisateur n'a pas une diversité de caractère suffisante");
        // }
        
        $this->password = strval($var);
    }

    function get_password() {
        return $this->password;
    }

    function set_access_lvl($var) {
        if (!is_integer($var)) {
            throw new Exception("Le niveau d'accès utilisateur doit être un nombre entier");
        }

        if ($var > 0 && $var <= 3) {
            throw new Exception("Le niveau d'accès utilisateur ne peut être null ou supérieur à 3");
        }
        
        $this->access_lvl = intval($var);
    }

    function get_access_lvl() {
        return $this->access_lvl;
    }

    function verif_password($compared_password) {
        if ($compared_password !== $this->password) {
            throw new Exception('Les deux mots de passe utilisateur ne sont pas identiques.');
        }
    }

    function select_bdd($bdd) {
        $request = $bdd->prepare('SELECT * FROM Users WHERE pseudo = :pseudo');
        $is_valid_request = $request->bindValue(':pseudo', $this->pseudo, PDO::PARAM_STR);
        $is_valid_request &= $request->execute();

        if (!$is_valid_request) {
            throw new Exception('Erreur bdd : SELECT Users');
        }

        $user_informations = $request->fetch(PDO::FETCH_ASSOC);
        if (empty($user_informations)) {
            throw new Exception('Aucun utilisateur trouvé dans la base de données.');
        }

        $this->set_id(user_informations['id']);
        $this->set_pseudo(user_informations['pseudo']);
        $this->set_courriel(user_informations['courriel']);
        $this->set_password(user_informations['password']);
        $this->set_access_lvl(user_informations['access_lvl']);
    }
}