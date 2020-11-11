<?php

$pdf->page($pdf,265);
$pdf->ligneLn("Article 6 - Régime de protection social");
$pdf->normal();
$pdf->ligneLn("Pendant la durée du stage, le STAGIAIRE reste affilié à son régime de Sécurité sociale antérieur.");
$pdf->ligneLn("Les stages effectués à l’étranger sont signalés préalablement au départ du stagiaire à la Sécurité sociale lorsque celle-ci le demande.");
$pdf->ligneLn("Pour les stages à l’étranger, les dispositions suivantes sont applicables sous réserve de conformité avec la législation du pays d’accueil et de celle régissant le type d’organisme d’accueil.");
$pdf->ligneLn("En cas de déplacement à l'étranger, I'ENTREPRISE devra en informer l'ETABLISSEMENT par écrit au moins 15 jours avant la date prévue pour le départ pour qu'il puisse le signaler à la sécurité sociale' A défaut' l'ENTREPRISE s'engage à cotiser pour la protection du STAGIAIRE'");
$pdf->saut();
$pdf->gras();


$pdf->page($pdf,265);
$pdf->ligneLn("6.1 Gratification d'un montant maximum de 15% du plafond horaire de la sécurité sociale");
$pdf->normal();
$pdf->mLigne("La gratification n'est pas soumise à cotisation sociale.
Le STAGIAIRE bénéficie de la législation sur les accidents de travail au titre du régime étudiant de l'article L.412-8 2° du code de la sécurité sociale.
En cas d'accident survenant au STAGIAIRE soit au cours d'activités dans l'ENTREPRISE, soit au cours du trajet, soit sur les lieux rendus utiles pour les besoins du stage, l'ENTREPRISE envoie la déclaration à la Caisse Primaire d'Assurance Maladie ou à la caisse compétente (voir adresse en page 1) en mentionnant l'ETABLISSEMENT D'ENSEIGNEMENT comme employeur, avec copie à l'ETABLISSEMENT D'ENSEIGNEMENT.");
$pdf->saut();
$pdf->gras();

$pdf->page($pdf,270);
$pdf->ligneLn("6.2 Gratification supérieure à 15% du plafond horaire de la sécurité sociale :");
$pdf->normal();
$pdf->mLigne("Les cotisations sociales sont calculées sur le différentiel entre le montant de la gratification et 15 % du plafond horaire de la Sécurité Sociale. Le STAGIAIRE bénéficie de la couverture légale en application des dispositions des articles L.411-1 et suivants du code de la Sécurité Sociale. En cas d'accident survenant au STAGIAIRE soit au cours des activités dans l'ENTREPRISE, soit au cours du trajet, soit sur des lieux rendus utiles pour les besoins de son stage, l'organisme d'accueil effectue toutes les démarches nécessaires auprès de la Caisse Primaire d'Assurance Maladie et informe l'établissement dans les meilleurs délais.");
$pdf->gras();
$pdf->saut();

// $pdf->mLigne("$conditions_remboursement");

if($conditions_remboursement != "Non-renseigné"){
    $pdf->page($pdf,270);
    $pdf->ligneLn("6.3 Remboursement de frais");
    $pdf->normal();
    $pdf->mLigne("Les frais engagés par le stagiaire à la demander de l'ENTREPRISE, dans le cadre de la réalisation du stage seront remboursés dans les conditions suivantes :");
//     $pdf->SetTextColor(255,0,0);
//     $pdf->mLigne("$conditions_remboursement");
//     $pdf->SetTextColor(0,0,0);
// }else{
    $pdf->SetTextColor(0,0,255);
    $pdf->mLigne("$conditions_remboursement");
    $pdf->SetTextColor(0,0,0);
}
$pdf->saut();