<?php

$pdf->gras();
$pdf->page($pdf,265);
$pdf->ligneLn("Article 13 - Fin de stage - Rapport - Evaluation");
$pdf->normal();
$pdf->mLigne("1)Attestation de stage : à l'issue du stage, l'ENTREPRISE D'ACCUEIL délivre une attestation dont le modèle figure enannexe, mentionnant au minimum la durée effective du stage et, le cas échéant, le montant de la gratification perçue. L'ENTREPRISE D'ACCUEIL remet cette attestation au STAGIAIRE. Le STAGIAIRE devra produire cette attestation à l'appui de sa demande éventuelle d'ouverture de droits au régime général d'assurance vieillesse prévue à l'art.L.351-17 du code de la sécurité sociale.");
$pdf->ln();
$pdf->mLigne("2)Qualité du stage : à l'issue du stage, les parties à la présente convention sont invitées à formuler une appréciationsur la qualité du stage. Le STAGIAIRE peut, à cet effet, utiliser un formulaire en ligne dans la rubrique « Ressources » du Career Center. Cette appréciation n'est pas prise en compte dans son évaluation ou dans l'obtention du diplôme ou de la certification.");
$pdf->ln();
$pdf->mLigne("3)Evaluation de l'activité du STAGIAIRE : à l'issue du stage, l'ENTREPRISE D'ACCUEIL renseigne une grille d'évaluationde l'activité du STAGIAIRE qu'il retourne à L'ÉTABLISSEMENTD'ENSEIGNEMENT ou répond à une évaluation via un formulaire en ligne adressé par L'ÉTABLISSEMENTD'ENSEIGNEMENT (annexe 1).");
$pdf->ln();
$pdf->mLigne("4)Modalités d'évaluation pédagogiques : le STAGIAIRE devra fournir un rapport de stage, (compte-rendu,présentation, mise à jour profil CV 2.0, etc.) dont les modalités lui seront indiquées lors de son départ en stage.");
$pdf->ln();

$nb_ects=2;
/*switch($classe){
    case "ISG PBM - 1ere annee":
    break;

    case "ISG PBM - 2eme annee":

    break;

    case "ISG PBM - 3eme annee":

    break;

    default:
        $nb_ects="Aucune classe sélectionnée"
}
*/

$pdf->wid("NOMBRE D'ECTS (cocher l'année concernée) :", $nb_ects);
$pdf->Ln();
$pdf->mLigne("5)Le tuteur de l'ENTREPRISE D'ACCUEIL ou tout membre de l'ENTREPRISE D'ACCUEIL appelé à se rendre dansL'ÉTABLISSEMENT D'ENSEIGNEMENT dans le cadre de la préparation, du déroulement et de la validation du stage, ne peut prétendre à une quelconque prise en charge ou indemnisation de la part de L'ÉTABLISSEMENT D'ENSEIGNEMENT.");
$pdf->Ln();
//$pdf->saut();

// $pdf->article("Article 12 - Propriété intellectuelle","Conformément au code de la propriété intellectuelle, dans le cas où les activités du STAGIAIRE donnent lieu à la création d'une oeuvre protégée par le droit d'auteur ou la propriété industrielle (y compris un logiciel), si l'ENTREPRISE souhaite l'utiliser et que le STAGIAIRE en est d'accord, un contrat devra être signé entre le STAGIAIRE (auteur) et l'ENTREPRISE.
// Le contrat devra alors notamment préciser l'étendue des droits cédés, l'éventuelle exclusivité, la destination, les
// supports utilisés et la durée de la cession, ainsi que, le cas échéant, le montant de la rémunération due au
// STAGIAIRE au titre de la cession. Cette clause s'applique quel que soit le statut de l'ENTREPRISE.");