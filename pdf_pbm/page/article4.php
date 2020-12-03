<?php
//$pdf->SetAutoPageBreak(1,30);
//--------Debut article 4-------------

//$pdf->page($pdf,255);
$pdf->ligneLn("Article 4 - Accueil et encadrement du STAGIAIRE");
$pdf->normal();
$pdf->mLigne("Le STAGIAIRE est suivi par l'enseignant référent désigné dans la présente convention ainsi que par le service de L'ÉTABLISSEMENT D'ENSEIGNEMENT en charge des stages.");
//$pdf->page($pdf,255);
$pdf->mLigne("Le tuteur de stage désigné par l'ENTREPRISE D'ACCUEIL dans la présente convention est chargé d'assurer le suivi du STAGIAIRE et d'optimiser les conditions de réalisation du stage conformément aux stipulations pédagogiques définies.");
//$pdf->page($pdf,255);
$pdf->mLigne("Le STAGIAIRE est autorisé à revenir dans son ETABLISSEMENT D'ENSEIGNEMENT pendant la durée du stage pour y suivre des cours demandés explicitement par le programme, ou pour participer à des réunions ; les dates sont portées à la connaissance de l'ENTREPRISE D'ACCUEIL par L'ÉTABLISSEMENT D'ENSEIGNEMENT. L'ENTREPRISE s'engage à libérer le stagiaire pour qu'il puisse y assister.");
//$pdf->page($pdf,255);
$pdf->mLigne("Toute difficulté survenue dans la réalisation et le déroulement du stage, qu'elle soit constatée par le STAGIAIRE ou par le tuteur de stage, doit être portée à la connaissance de l'enseignant‐référent et de L'ÉTABLISSEMENT D'ENSEIGNEMENT afin d'être résolue au plus vite.");

$pdf->saut();
//$pdf->page($pdf,255);
$pdf->mLigne("MODALITÉS D'ENCADREMENT (pour les stages obligatoires)");
//$pdf->page($pdf,255);
$pdf->mLigne("* Par l'enseignant référent : mails, rendez-vous téléphoniques, rendez-vous physiques.");
//$pdf->page($pdf,255);
$pdf->mLigne("* Par le tuteur en ENTREPRISE D'ACCUEIL : points réguliers sur l'avancement des missions.");
$pdf->Ln();
/*$pdf->wid("Dans le cas présent il s'agit d'un stage ",$obligatoire,-2);


if($obligatoire == "obligatoire"){
    $pdf->page($pdf,265);
    $pdf->ligneLn("MODALITES D'ENCADREMENT :");
    $pdf->ligneLn("- Par l'enseignant référent : mails, rendez-vous téléphoniques, rendez-vous physiques, enquête en ligne.");
    $pdf->ligneLn("- Par le tuteur en entreprise : points réguliers sur l'avancement des missions");
    $pdf->saut(3);
}*/