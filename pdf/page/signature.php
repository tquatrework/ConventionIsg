<?php

// ChangeCampus
$pdf->Cell(90,5,utf8_decode("Fait à : Bordeaux"));
$today = getdate();
$sdate= "le : ".$today["mday"]."/".$today["mon"]."/".$today["year"];
$pdf->Cell(90,5,utf8_decode($sdate));
$pdf->saut();
$pdf->saut();
$pdf->SetWidths(array(100,85));
$pdf->Row(array(utf8_decode("POUR L'ETABLISSEMENT D'ENSEIGNEMENT\nSignature du représentant et cachet de l'établissement\n\n\n\n\n"),utf8_decode("POUR L'ENTREPRISE\nSignature du représentant et cachet de l'entreprise")));
$pdf->Row(array(utf8_decode("STAGIAIRE\nNom et signature\n\n\n\n\n"),utf8_decode("Tuteur de l'ENTREPRISE\nNom et signature")));
$pdf->SetWidths(array(100));

$pdf->Row(array(utf8_decode("Enseignant Référent ETABLISSEMENT D'ENSEIGNEMENT\nNom et signature\n\n\n\n\n")));
