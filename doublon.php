<?php
require("modele.php");
require("classes/autoload.php");
$dbh = Database::pdo();
$nom = $_GET["nom"];
$rue = $_GET["rue"];
$voie = $_GET["voie"];
$postal = $_GET["postal"];
$ville = $_GET["ville"];

$request = 'SELECT * FROM entreprise WHERE nom_entreprise = :nom';
$array = array(':nom'=>$nom);
$result = \Utils::tryBindFetch($request,$array);


if($result){

    if((strtoupper($result["nom_entreprise"]) == strtoupper($nom)) && (strtoupper($result["numero_rue_entreprise"]) == strtoupper($rue) )&& (strtoupper($result["adresse_entreprise"]) == strtoupper($voie)) && (strtoupper($result["code_postal_entreprise"]) == strtoupper($postal)) && (strtoupper($result["ville_entreprise"]) == strtoupper($ville))){
        echo "Une entreprise avec le même nom et adresse existe déjà";
    }elseif(strtoupper($result["nom_entreprise"]) == strtoupper($nom)){
        echo "Une entreprise avec le même nom existe dèjà";
    }else{
        echo "pas";
    }

}else{
    echo 0;
}

   