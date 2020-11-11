<?php
class PDF extends FPDF
{
// Chargement des données
function LoadData($file)
{
    // Lecture des lignes du fichier
    $lines = file($file);
    $data = array();
    foreach($lines as $line)
        $data[] = explode(';',trim($line));
    return $data;
}

// Tableau simple
function BasicTable($header, $data)
{
    // En-tête
    foreach($header as $col)
        $this->Cell(40,7,$col,1);
    $this->Ln();
    // Données
    foreach($data as $row)
    {
        foreach($row as $col)
            $this->Cell(40,6,$col,1);
        $this->Ln();
    }
}

// Tableau amélioré
function ImprovedTable($header, $data)
{
    // Largeurs des colonnes
    $w = array(40, 35, 45, 40);
    // En-tête
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],7,$header[$i],1,0,'C');
    $this->Ln();
    // Données
    foreach($data as $row)
    {
        $this->Cell($w[0],6,$row[0],'LR');
        $this->Cell($w[1],6,$row[1],'LR');
        $this->Cell($w[2],6,number_format($row[2],0,',',' '),'LR',0,'R');
        $this->Cell($w[3],6,number_format($row[3],0,',',' '),'LR',0,'R');
        $this->Ln();
    }
    // Trait de terminaison
    $this->Cell(array_sum($w),0,'','T');
}

// Tableau coloré
function FancyTable($header, $data)
{
    // Couleurs, épaisseur du trait et police grasse
    $this->SetFillColor(255,0,0);
    $this->SetTextColor(255);
    $this->SetDrawColor(128,0,0);
    $this->SetLineWidth(.3);
    $this->SetFont('','B');
    // En-tête
    $w = array(40, 35, 45, 40);
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
    $this->Ln();
    // Restauration des couleurs et de la police
    $this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    $this->SetFont('');
    // Données
    $fill = false;
    foreach($data as $row)
    {
        $this->Cell($w[0],6,$row[0],'LR',0,'L',$fill);
        $this->Cell($w[1],6,$row[1],'LR',0,'L',$fill);
        $this->Cell($w[2],6,number_format($row[2],0,',',' '),'LR',0,'R',$fill);
        $this->Cell($w[3],6,number_format($row[3],0,',',' '),'LR',0,'R',$fill);
        $this->Ln();
        $fill = !$fill;
    }
    // Trait de terminaison
    $this->Cell(array_sum($w),0,'','T');
}
}

class PDF_MC_Table extends FPDF
{
var $widths;
var $aligns;

function SetWidths($w)
{
    //Tableau des largeurs de colonnes
    $this->widths=$w;
}

function SetAligns($a)
{
    //Tableau des alignements de colonnes
    $this->aligns=$a;
}

function Row($data)
{
    //Calcule la hauteur de la ligne
    $nb=0;
    for($i=0;$i<count($data);$i++)
        $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
    $h=5*$nb;
    //Effectue un saut de page si nécessaire
    $this->CheckPageBreak($h);
    //Dessine les cellules
    for($i=0;$i<count($data);$i++)
    {
        $w=$this->widths[$i];
        $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
        //Sauve la position courante
        $x=$this->GetX();
        $y=$this->GetY();
        //Dessine le cadre
        $this->Rect($x,$y,$w,$h);
        //Imprime le texte
        $this->MultiCell($w,5,$data[$i],0,$a);
        //Repositionne à droite
        $this->SetXY($x+$w,$y);
    }
    //Va à la ligne
    $this->Ln($h);
}

function CheckPageBreak($h)
{
    //Si la hauteur h provoque un débordement, saut de page manuel
    if($this->GetY()+$h>$this->PageBreakTrigger)
        $this->AddPage($this->CurOrientation);
}

function NbLines($w,$txt)
{
    //Calcule le nombre de lignes qu'occupe un MultiCell de largeur w
    $cw=&$this->CurrentFont['cw'];
    if($w==0)
        $w=$this->w-$this->rMargin-$this->x;
    $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
    $s=str_replace("\r",'',$txt);
    $nb=strlen($s);
    if($nb>0 and $s[$nb-1]=="\n")
        $nb--;
    $sep=-1;
    $i=0;
    $j=0;
    $l=0;
    $nl=1;
    while($i<$nb)
    {
        $c=$s[$i];
        if($c=="\n")
        {
            $i++;
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
            continue;
        }
        if($c==' ')
            $sep=$i;
        $l+=$cw[$c];
        if($l>$wmax)
        {
            if($sep==-1)
            {
                if($i==$j)
                    $i++;
            }
            else
                $i=$sep+1;
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
        }
        else
            $i++;
    }
    return $nl;
}

function ligneLn($text,$taille = 5){
    $this->Cell($taille,5,utf8_decode($text),0,1);
}

function ligne($text,$taille = 5){
    $this->Cell($taille,5,utf8_decode($text));
}

function mLigne($text,$taille = 180){
    $this->MultiCell($taille,5,utf8_decode($text));
} 

function check(){
    $this->Cell(4,4,"",1);
}

function checked(){
    $this->Cell(4,4,"X",1);
}

function gras(){
    $this->SetFont('Arial',"B",10);
}

function normal(){
    $this->SetFont('Arial',"",10);
}

function position($x=5){
    $position = $this->GetX()+$x;
    $this->SetX($position);
}

function saut($taille= 3){
    $this->Cell(1,$taille,"",0,1);
}

function article($titre,$texte){
    $this->gras();
    $this->ligneLn($titre);
    $this->normal();
    $this->mLigne($texte);
    $this->saut();
}

function wid($label,$input,$decalage = 0,$gras = false,$lnInput = 0,$inputMcell = true){
    $labelWidth = $this->GetStringWidth($label);
    if($gras == true){
        $this->SetFont("Arial","b",10);
    }
    $this->Cell($labelWidth+$decalage,5,utf8_decode($label),0,$lnInput);
    if($gras == true){
        $this->SetFont("Arial","",10);
    }
    $this->SetTextColor(0,0,255);
    if($inputMcell = true){
        if($input == "Non-renseigné"){
            $this->SetTextColor(255,0,0);
            $this->mLigne($input);
            $this->SetTextColor(0,0,0);
        }else{
            $this->mLigne($input,150);
        }
    }else{
        if($input == "Non_renseigné"){
            $this->SetTextColor(255,0,0);
            $this->Cell(100,5,utf8_decode($input),0,1);
            $this->SetTextColor(0,0,0);
        }else{
            $this->Cell(100,5,utf8_decode($input),0,1);
        }
    }
    $this->SetTextColor(0,0,0);

}

    function widIf($pdf,$label,$item1,$item2,$item3 = "",$decalage = 0){
        if($item1 == "Non-renseigné" && $item2 == "Non-renseigné"){
            $pdf->wid($label,"Non-renseigné",3);
        }elseif($item1 == "Non-renseigné" && $item2 != "Non-renseigné"){
            $item1 = "";
            $pdf->wid($label,"$item1 $item2 $item3",$decalage);
        }elseif($item1 != "Non-renseigné" && $item2 == "Non-renseigné"){
            $item2 = "";
            $pdf->wid($label,"$item1 $item2 $item3",$decalage);
        }else{
            $pdf->wid($label,"$item1 $item2 $item3",$decalage);
        }
    }

    function ici($pdf){
        return $pdf->Cell(100,5,$pdf->GetY(),0,1);
    }

    function page($pdf,$nombre){
        if($pdf->GetY() > $nombre){
            $pdf->AddPage();
        }
    }

    function pageIf($pdf,$nombre){
        if($pdf->PageNo() == $nombre){
            $pdf->AddPage();
        }
    }

    function Footer()
{
    // Positionnement à 1,5 cm du bas
    $this->SetY(-15);
    // Police Arial italique 8
    $this->SetFont('Arial','I',8);
    // Numéro de page
    $this->Cell(150,10,'Convention de stage - ISEG',0,0);
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'R');
}

}

