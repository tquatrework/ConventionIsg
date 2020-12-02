<?php
// ------------Configuration de la page-----------
$pdf = new PDF_MC_Table();
$pdf->AliasNbPages();
$pdf->SetTopMargin(15);// marge haut
$pdf->AddPage();
$pdf->SetLeftMargin(15);// marge gauche
$pdf->SetAutoPageBreak(1,20);
// ----------Fin Configuration de la page