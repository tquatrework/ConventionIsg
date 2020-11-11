<?php

class Utils{


    public static function tryFetch($request,$all = 0){

        try {
            $sth = Database::pdo()->prepare($request);
            $result = $sth->execute();
            if($all){
                $tabResult = $sth->fetchAll(PDO::FETCH_ASSOC);
            }else{
                $tabResult = $sth->fetch(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        return $tabResult;
    }

    public static function offset()
    {
        if (isset($_GET["offset"]) && $_GET["offset"] > 0) {
            $offset = $_GET["offset"];
        } else {
            $offset = 0;
        }

        if (!empty($_POST["recherche"])) {
            $offset = 0;
        }
        return $offset;
    }

    public static function offsetLien(){
        if(!empty($_GET["offset"])){
            return $offset = "&offset=".$_GET["offset"];
        }
        return $offset = "";
    }

    public static function idStagiaire(){
        if(isset($_SESSION["profile"])){
            if ($_SESSION["profile"] == "etudiant") {
                $id_stagiaire = $_SESSION["id"];
            } elseif(!empty($_GET["id"])) {
                $id_stagiaire= $_GET["id"];
            }
        }
        if(!empty($id_stagiaire)){
            return $id_stagiaire;
        }
    }

    public static function recherche(){
        if (!empty($_POST["recherche"])) {
            $recherche = $_POST["recherche"];
        } elseif (!empty($_GET["recherche"])) {
            $recherche = $_GET["recherche"];
        } else {
            $recherche = "";
        }
        return $recherche;
    }

    public static function tryBind($request,$array,$return = 0){

        try {   
            $sth = Database::pdo()->prepare($request);
            $result = $sth->execute($array);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        if($return){
            return $result;
        }
    }

    public static function tryPrepare($request,$return = 0){

        try {
            $sth = Database::pdo()->prepare($request);
            $result = $sth->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        if($return){
            return $result;
        }
    }

    public static function tryBindFetch($request,$array,$all = 0,$return = 1){

        try {
            $sth = \DATABASE::pdo()->prepare($request);
            $result = $sth->execute($array);
            if($all){
                $result = $sth->fetchAll(PDO::FETCH_ASSOC);
            }else{
                $result = $sth->fetch(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        if($return){
            return $result;
        }

    }

    public static function sanitizeEmail($identifiant){
        $sanitize = filter_var($identifiant,FILTER_SANITIZE_EMAIL);
        return $sanitize;
    }

    public static function sanitizeHashPassword($password){
        $sanitize = filter_var($password,FILTER_SANITIZE_STRING);
        $hash = password_hash($sanitize,PASSWORD_BCRYPT);
        return $hash;
    }

    public static function sanitizePassword($password){
        $sanitize = filter_var($password,FILTER_SANITIZE_STRING);
        return $sanitize;
    }

    public static function validateEmail($mail){
        return filter_var($mail,FILTER_VALIDATE_EMAIL);
    }

    public static function sanitizeValidateEmail($mail){
        $sanitize = filter_var($mail,FILTER_SANITIZE_EMAIL);
        return filter_var($sanitize,FILTER_VALIDATE_EMAIL);
    }


}