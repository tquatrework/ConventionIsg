<?php

$pdf->gras();
$pdf->page($pdf,265);
$pdf->ligneLn("Article 12 - Fin de stage - Rapport - Evaluation");
$pdf->normal();
$pdf->mLigne("1) Attestation de stage : à l'issue du stage, l'organisme d'accueil délivre une attestation dont le modèle figureen annexe, mentionnant au minimum la durée effective du stage et, le cas échéant, le montant de la gratification perçue. Le stagiaire devra produire cette attestation à l'appui de sa demande éventuelle d'ouverture de droits au régime général d'assurance vieillesse prévue à l'art. L.351-17 du code de la sécurité sociale ;");
$pdf->ln();
$pdf->mLigne("2) Qualité du stage : à l'issue du stage, les parties à la présente convention sont invitées à formuler uneappréciation sur la qualité du stage.");
$pdf->ln();
$pdf->mLigne("Le stagiaire transmet au service compétent de l'établissement d'enseignement un document dans lequel il évalue la qualité de l'accueil dont il a bénéficié au sein de l'organisme d'accueil. Ce document n'est pas pris en compte dans son évaluation ou dans l'obtention du diplôme ou de la certification.");
$pdf->ln();
$pdf->mLigne("3) Evaluation de l'activité du stagiaire : à l'issue du stage, l'organisme d'accueil renseigne une fiched'évaluation de l'activité du stagiaire qu'il retourne à l'enseignant référent (ou préciser si fiche annexe ou modalités d'évaluation préalablement définis en accord avec l'enseignant référent).");
$pdf->ln();
$pdf->mLigne("4) Modalités d'évaluation pédagogiques : le stagiaire devra (préciser la nature du travail à fournir –rapport,etc.- éventuellement en joignant une annexe.");
$pdf->ln();
$pdf->mLigne("5) Le tuteur de l'organisme d'accueil ou tout membre de l'organisme d'accueil appelé à se rendre dansl'établissement d'enseignement dans le cadre de la préparation, du déroulement et de la validation du stage ne peut prétendre à une quelconque prise en charge ou indemnisation de la part de l'établissement d'enseignement.");
$pdf->ln();
//$pdf->saut();

// $pdf->article("Article 12 - Propriété intellectuelle","Conformément au code de la propriété intellectuelle, dans le cas où les activités du STAGIAIRE donnent lieu à la création d'une oeuvre protégée par le droit d'auteur ou la propriété industrielle (y compris un logiciel), si l'ENTREPRISE souhaite l'utiliser et que le STAGIAIRE en est d'accord, un contrat devra être signé entre le STAGIAIRE (auteur) et l'ENTREPRISE.
// Le contrat devra alors notamment préciser l'étendue des droits cédés, l'éventuelle exclusivité, la destination, les
// supports utilisés et la durée de la cession, ainsi que, le cas échéant, le montant de la rémunération due au
// STAGIAIRE au titre de la cession. Cette clause s'applique quel que soit le statut de l'ENTREPRISE.");