<?php
$pdf->page($pdf,265);
$pdf->gras();
$pdf->Cell(5,5,utf8_decode("Article 3 - Modalités du stage "),0,1);
$pdf->SetFont('Arial',"",10);
$pdf->MultiCell(180,5,utf8_decode("Durant son stage, le stagiaire demeure sous son statut d'étudiant. Il reste sous l'autorité et la responsabilité de
l'ETABLISSEMENT D'ENSEIGNEMENT. Il n'est pas pris en compte pour l'appréciation de l'effectif de l'entreprise. La durée hebdomadaire de présence du stagiaire dans l'organisme d'accueil sera sur la base de 35 heures, à "));
if($temps_complet == "Non_renseigné"){
    $pdf->SetTextColor(255,0,0);
    $pdf->Cell(5,5,utf8_decode($temps_complet),0,1);
    $pdf->SetTextColor(0,0,0);
}else{
    $pdf->SetTextColor(0,0,255);
    $pdf->Cell(5,5,utf8_decode($temps_complet),0,1);
    $pdf->SetTextColor(0,0,0);
}

$pdf->page($pdf,265);
$pdf->mLigne("A défaut de la remise d'un règlement intérieur précisant des horaires spécifiques à l'entreprise ou issu d'un accord de branche, l'étudiant effectuera son stage du lundi au vendredi, 35 heures hebdomadaires, avec une pause déjeuner d'une heure.");
if($temps_complet == "temps partiel."){
    $pdf->mLigne("Nombre d'heures à temps partiel : $heure_partiel");
}

$arrayJour= array("lundi","mardi","mercredi","jeudi","vendredi","samedi");
foreach($arrayJour as $value){
    if($$value == "Non-renseigné"){
        $$value = "";
    }
}

$pdf->wid("Jours de présence : ","$lundi $mardi $mercredi $jeudi $vendredi $samedi",0,true);

$pdf->page($pdf,265);
$pdf->Ln();
$pdf->normal();
$pdf->ligneLn("NB : pour les STAGIAIRES de 4e et de 5e année, se référer aussi aussi au programme des séminaires.");
$pdf->saut();
if($cas_particulier_booleen == "on"){
    $pdf->gras();
    $pdf->ligne("Cas particuliers :",30);
    $pdf->normal();
    $pdf->Mligne("$cas_particulier");
}
$pdf->saut(5);