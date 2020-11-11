<?php

class Database
{

    public static function pdo()
    {

        # $devHost = "http:ionisbxfbzconv.mysql.db";
        $user = "nxtrabqconv";
        $pass = "ConventionIsg2020";
        $host = "nxtrabqconv.mysql.db";
        try {
            $dbh = new PDO('mysql:host=' . $host . ';dbname=nxtrabqconv', $user, $pass);
            $dbh->exec("SET CHARACTER SET utf8");
        } catch (PDOException $e) {
            die("Erreur");
        }

        return $dbh;

    }

    public static function deconnexion()
    {
        if (isset($_GET["controller"])) {
            if ($_GET["controller"] == "deconnexion") {
                $_SESSION = array();
                session_destroy();
                redirect("index.php?controller=authentification&task=authentification");
            }
        }
    }
    
    public static function redirection()
    {
        
        if(empty($_SESSION["utilisateur"]) && $_GET["controller"] != "authentification"){
            redirect("index.php?controller=authentification&task=authentification");
        }

        if(empty($_GET["controller"])){
            redirect("index.php?controller=authentification&task=authentification");
        }
        
    }
}


