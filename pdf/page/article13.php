<?php
$pdf->page($pdf,265);
$pdf->gras();
$pdf->ligneLn("Article 13 - Fin de stage - Rapport - Evaluation");
$pdf->normal();
$pdf->mLigne("1) Attestation de stage : à l'issue du stage, l'ENTREPRISE délivre une attestation dont le modèle figure en annexe, mentionnant au minimum la durée effective du stage et, le cas échéant, le montant de la gratification perçue.
L'ENTREPRISE remet cette attestation au STAGIAIRE. Le STAGIAIRE devra produire cette attestation à l'appui de sa demande éventuelle d'ouverture de droits au régime général d'assurance vieillesse prévue à l'art.L.351-17 du code de la sécurité sociale.");
$pdf->saut();
$pdf->page($pdf,265);
$pdf->mLigne("2) Qualité du stage : à l'issue du stage, les parties à la présente convention sont invitées à formuler une appréciation sur la qualité du stage. Le STAGIAIRE peut à cet effet utiliser un formulaire en ligne dans la rubrique
«Ressources» du Career Center. Cette appréciation n'est pas prise en compte dans son évaluation ou dans l'obtention du diplôme ou de la certification.");
$pdf->saut();
$pdf->page($pdf,265);
$pdf->mLigne("3) Evaluation de l'activité du STAGIAIRE : à l'issue du stage, l'ENTREPRISE renseigne une fiche d'évaluation de l'activité du STAGIAIRE qu'il retourne à l'ETABLISSEMENT D'ENSEIGNEMENT ou répond à une évaluation via un formulaire en ligne adressée par l'ETABLISSEMENT D'ENSEIGNEMENT.");
$pdf->saut();
$pdf->page($pdf,265);
$pdf->mLigne("4) Modalités d'évaluation pédagogiques : le STAGIAIRE devra fournir un compte-rendu (rapport de stage, présentation, mise à jour profil CV 2.0, etc.) dont les modalités lui seront indiquées lors de son départ en stage.");
$pdf->saut();
if($classe != "Non-renseigné"){
    $pdf->Cell(35,5,utf8_decode("NOMBRE D'ECTS :"));
}

switch($classe){
    case "MCS - 1re année":
    $pdf->ligne("MCS1=1",5);
    break;
    case "MCS - 2e année":
    $pdf->ligne("MCS2=1",5);
    break;
    case "MCS - 3e année":
    $pdf->ligne("MCS3=2",5); 
    break;
    case "MCS - 4e année":
    $pdf->ligne("MCS4=2",5);
    break;
    case "MCS - 5e année":
    $pdf->ligne("MCS5=2",5);
    break;

}
$pdf->Ln();