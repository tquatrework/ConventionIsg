<?php
//$pdf->SetAutoPageBreak(1,30);
//--------Debut article 1-------------
$pdf->pageIf($pdf,1);
$pdf->SetAutoPageBreak(1,15);
$pdf->article("Article 1 - Objet de la convention","La présente convention règle les rapports de l'ENTREPRISE D'ACCUEIL avec l'ETABLISSEMENT D'ENSEIGNEMENT et le STAGIAIRE.");