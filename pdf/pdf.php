<?php
session_start();
require('fpdf.php');
require('class.php');
require("../classes/autoload.php");
$dbh = Database::pdo();
define('EURO',chr(128)); 

//---------DEBUT SELECT STAGE----------
$request = 'SELECT * FROM stage 
            INNER JOIN tuteur ON stage.fk_tuteur_stage = tuteur.id_tuteur
            INNER JOIN entreprise ON tuteur.fk_entreprise = entreprise.id_entreprise
            INNER JOIN utilisateur ON utilisateur.id = stage.fk_utilisateur_stage
            INNER JOIN stagiaire ON stagiaire.id_stagiaire = utilisateur.id
            INNER JOIN referent ON stage.fk_referent_stage = referent.id_referent
            INNER JOIN etablissement ON etablissement.id_etablissement = referent.fk_enseignement_referent
            WHERE id_stage = '.$_GET["id_stage"].'
            ';

$tabResult = Utils::tryFetch($request);
foreach  ($tabResult as $key=>$value) {
    $$key = $tabResult[$key];
    if($tabResult[$key] == "" || !isset($tabResult[$key])){
        $$key = "Non-renseigné";
    }
}

if($temps_complet == "complet"){
    $temps_complet = "temps complet.";
}
if($temps_complet == "partiel"){
    $temps_complet = "temps partiel.";
}

//cell(largeur,hauteur,text,bordure,saut de ligne,alignement,fond,lien)
require_once("page/configPage.php");
require_once("page/premiere_page.php");
$pdf->saut();
require_once("page/article1.php");
require_once("page/article2.php");
require_once("page/article3.php");
$pdf->gras();
require_once("page/article4.php");
$pdf->gras();
require_once("page/article5.php");
$pdf->gras();
require_once("page/article6.php");
$pdf->gras();
require_once("page/article7.php");
$pdf->gras();
require_once("page/article8.php");
$pdf->gras();
/*
require_once("page/article9.php");
$pdf->saut();
require_once("page/article10.php");
$pdf->saut();
require_once("page/article11.php");
$pdf->saut();
require_once("page/article12.php");
require_once("page/article13.php");
$pdf->saut();
require_once("page/article14.php");
$pdf->saut();
require_once("page/signature.php");
*/
$pdf->Output();
?>