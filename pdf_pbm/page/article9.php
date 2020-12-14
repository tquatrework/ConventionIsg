<?php

//$pdf->page($pdf,260);
$pdf->ligneLn("Article 9 - Congés - Interruption du stage");
$pdf->normal();
$pdf->mLigne("En cas de manquement particulièrement grave à la discipline, l'ENTREPRISE D'ACCUEIL se réserve le droit de mettre fin au stage tout en respectant les dispositions fixées à l'article 9 de la présente convention.");

$pdf->mLigne("Pour les stages dont la durée est supérieure à deux mois et dans la limite de la durée maximale de six mois, des congés ou autorisations d'absence sont possibles.");
$pdf->mLigne("NOMBRE DE JOURS DE CONGES AUTORISES /ou modalités des congés / autorisations d'absence durant le stage :");
$pdf->multiCell(0,5,utf8_decode($modalite_conge),1);
/*
if($modalite_conge_booleen == "oui"){
    
    if($modalite_conge != "Non-renseigné"){
        $pdf->mLigne("Pour les stages dont la durée est supérieure à deux mois et dans la limite de la durée maximale de six mois, des congés ou autorisations d'absence sont possibles.");
        $pdf->saut();
        $pdf->ligneLn("Nombre de jours de congés autorisés / modalités des congés / autorisations d'absence durant le stage :");
        //     $pdf->SetTextColor(255,0,0);
        //     $pdf->mLigne("$modalite_conge");
        //     $pdf->SetTextColor(0,0,0);
        // }else{
        $pdf->SetTextColor(0,0,255);
        $pdf->mLigne("$modalite_conge");
        $pdf->SetTextColor(0,0,0);
    }
}*/

$pdf->mLigne("En cas de fermeture de l'ENTREPRISE D'ACCUEIL, les dates de fermeture sont :");
if($date_debut_fermeture_entreprise != "Non-renseigné" && $fermeture_entreprise != "off" && $date_fin_fermeture_entreprise != "Non-renseigné"){
    $pdf->wid("Date début fermeture :",$date_debut_fermeture_entreprise);
    $pdf->wid("Date fin fermeture :", $date_fin_fermeture_entreprise,3);
}
$pdf->saut();
$pdf->page($pdf,265);

$pdf->saut();
$pdf->mLigne("Pour toute autre interruption temporaire du stage (maladie, absence injustifiée...), l'ENTREPRISE d'ACCUEIL avertit L'ÉTABLISSEMENTD'ENSEIGNEMENT par courrier.");
$pdf->mLigne("Toute interruption du stage est signalée aux autres parties à la convention et à l'enseignant référent. Une modalité de validation est mise en place le cas échéant par L'ÉTABLISSEMENTD'ENSEIGNEMENT. En cas d'accord des parties, un report de la fin du stage est possible afin de permettre la réalisation de la durée totale du stage prévue initialement. Ce report fera l'objet d'un avenant à la convention de stage.");
$pdf->mLigne("Un avenant à la convention pourra être établi en cas de prolongation du stage sur demande conjointe de l'ENTREPRISE d'ACCUEIL et du STAGIAIRE, dans le respect de la durée maximale fixée par la loi (6 mois).");
$pdf->Ln();
$pdf->mLigne("En cas de volonté d'une des trois parties (ENTREPRISE D'ACCUEIL, STAGIAIRE, ÉTABLISSEMENTD'ENSEIGNEMENT) d'arrêter le stage, celle‐ci doit immédiatement en informer les deux autres parties par écrit. Les raisons invoquées seront examinées en étroite concertation. La décision définitive d'arrêt du stage ne sera prise qu'à l'issue de cette phase de concertation.");
$pdf->Ln();