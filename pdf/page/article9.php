<?php

//$pdf->page($pdf,260);
$pdf->ligneLn("Article 9 - Congés, interruption ou prolongation du stage");
$pdf->normal();
$pdf->mLigne("En France (sauf en cas de règles particulières applicables dans certaines collectivités d’outre-mer françaises ou dans les organismes de droit public), 
en cas de grossesse, de paternité ou d’adoption, le stagiaire bénéficie de congés et d’autorisations d’absence d’une durée équivalente à celle prévues pour les salariés 
aux articles L.1225-16 à L.1225-28, L.1225-35, L.1225-37, L.1225-46 du code du travail.");

$pdf->mLigne("Pour les stages dont la durée est supérieure à deux mois et dans la limite de la durée maximale de six mois, des congés ou autorisations d'absence sont possibles.");
$pdf->mLigne("NOMBRE DE JOURS DE CONGES AUTORISES / ou modalités des congés et autorisations d’absence durant le stage :");
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

$pdf->saut();
if($date_debut_fermeture_entreprise != "Non-renseigné" && $fermeture_entreprise != "off" && $date_fin_fermeture_entreprise != "Non-renseigné"){
    $pdf->wid("Date début fermeture :",$date_debut_fermeture_entreprise);
    $pdf->wid("Date fin fermeture :", $date_fin_fermeture_entreprise,3);
}
$pdf->saut();
$pdf->page($pdf,265);
$pdf->mLigne("Pour toute autre interruption temporaire du stage (maladie, absence injustifiée) l'ENTREPRISE avertit
L'ETABLISSEMENT D'ENSEIGNEMENT par courrier.
Toute interruption du stage, est signalée aux autres parties à la convention et à l'enseignant référent. Une modalité de validation est mise en place le cas échéant par l'ETABLISSEMENT D'ENSEIGNEMENT. En cas d'accord des parties à la convention, un report de la fin du stage est possible afin de permettre la réalisation de la durée totale du stage prévue initialement. Ce report fera l'objet d'un avenant à la convention de stage.
Un avenant à la convention pourra être établi en cas de prolongation du stage sur demande conjointe de l'ENTREPRISE et du STAGIAIRE, dans le respect de la durée maximale du stage fixée par la loi (6 mois).");
$pdf->saut();
if($pdf->GetY() > 270){
    $pdf->addPage();
}
$pdf->mLigne("En cas de volonté d'une des trois parties (ENTREPRISE, STAGIAIRE, l'ETABLISSEMENT D'ENSEIGNEMENT) d'arrêter le stage, celle-ci doit immédiatement en informer les deux autres parties par écrit. Les raisons invoquées seront examinées en étroite concertation. La décision définitive d'arrêt du stage ne sera prise qu'à l'issue de cette phase de concertation.");