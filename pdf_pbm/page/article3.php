<?php
//$pdf->SetAutoPageBreak(1,30);
//--------Debut article 3-------------
$pdf->page($pdf,265);
$pdf->gras();
$pdf->SetFont('Arial',"B",10);
$pdf->Cell(5,5,utf8_decode("Article 3 - Modalités du stage "),0,1);
$pdf->SetFont('Arial',"",10);

$pdf->MultiCell(180,5,utf8_decode("Durant son stage, le stagiaire demeure sous son statut d'étudiant. Il reste sous l'autorité et la responsabilité de L'ÉTABLISSEMENTD'ENSEIGNEMENT. Il n'est pas pris en compte pour l'appréciation de l'effectif de l'ENTREPRISE D'ACCUEIL. "),0);

if($temps_complet == "Non_renseigné"){

    $pdf->SetTextColor(255,0,0);
    $pdf->MultiCell(180,5,utf8_decode("La durée hebdomadaire de présence du stagiaire dans l'organisme d'accueil est ".$temps_complet));
    //$pdf->Cell(5,5,utf8_decode($temps_complet),0,1);
    $pdf->SetTextColor(0,0,0);

}else{

    //$pdf->SetTextColor(0,0,255);
    $pdf->MultiCell(180,5,utf8_decode("La durée hebdomadaire de présence du stagiaire dans l'organisme d'accueil sera sur la base de 35 heures, sur la base d'un ".$temps_complet));
    //$pdf->wid(utf8_decode("La durée hebdomadaire de présence du stagiaire dans l'organisme d'accueil sera sur la base de 35 heures, sur la base d'un "),$temps_complet);
    //$pdf->Cell(5,5,utf8_decode($temps_complet),0,1);
    $pdf->SetTextColor(0,0,0);

}



//$pdf->Cell(5,5,utf8_decode("Si temps partiel, indiquer les jours de présence :"),0,1);

$pdf->mLigne("A défaut de la remise d'un règlement intérieur précisant des horaires spécifiques à l'entreprise ou issu d'un accord de branche, l'étudiant effectuera son stage du lundi au vendredi, 35 heures hebdomadaires, avec une pause déjeuner d'une heure.");

if($temps_complet == "temps partiel."){

    $pdf->mLigne("Nombre d'heures à temps partiel : $heure_partiel");

}
$pdf->ln();


$arrayJour= array("lundi","mardi","mercredi","jeudi","vendredi","samedi");
foreach($arrayJour as $value){
    if($$value == "Non-renseigné"){
        $$value = "";
    }
}
$pdf->wid("Jours de présence :","$lundi $mardi $mercredi $jeudi $vendredi $samedi",5,true);
$pdf->ln();


$pdf->SetFont('Arial','I',10);
$pdf->Multicell(0,5,utf8_decode("Attention : les stagiaires en 4e ou 5e année peuvent être amenés à suivre des séminaires, dans le cadre de leur cursus (cf calendrier joint).))"),0);
$pdf->ln();

$pdf->normal();
$pdf->MultiCell(0,5,utf8_decode("Si le stagiaire doit être présent dans l'organisme d'accueil la nuit, le dimanche ou un jour férié, préciser les cas particuliers : "));
$pdf->page($pdf,265);
$pdf->MultiCell(0,5,utf8_decode($cas_particulier),1);
$pdf->ln();


/* $pdf->ligneLn("NB : pour les STAGIAIRES de 4e et de 5e année, se référer aussi aussi au programme des séminaires.");

$pdf->saut();

if($cas_particulier_booleen == "on"){

    $pdf->gras();

    $pdf->ligne("Cas particuliers :",30);

    $pdf->normal(Si le stagiaire doit �tre pr�sent dans l�organisme d�accueil la nuit, le dimanche ou un jour f�ri�, pr�ciser les cas particuliers :);

    $pdf->Mligne("$cas_particulier");

}

$pdf->saut(5);*/