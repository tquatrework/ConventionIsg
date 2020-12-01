<?php
//$pdf->SetAutoPageBreak(1,30);
//-----------Début En-Tête------------
$pdf->Image('ISG_logo.jpg',30,10,-400);
$pdf->SetFont('Arial','B',15);
//$pdf->Cell(40);
$pdf->Cell(0,5,"CONVENTION DE STAGE ETUDIANT",0,1,'C');
$pdf->SetFont('Arial','',10);
//$pdf->Cell(60);
$pdf->Cell(0,5,utf8_decode("Etudiant majeur"),0,1,'C');
$pdf->SetFont('Arial','I',10);
$pdf->Cell(0,5,utf8_decode("(Stage effectué en France)"),0,1,'C');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,5,utf8_decode("Année universitaire ".$annee_universitaire),0,1,'C');
$pdf->Ln();
$pdf->Ln(); // revenir à la ligne


//--------Début etablissement d'enseignement
//$pdf->Cell(10); // marge à gauche
$pdf->Cell(100,5,utf8_decode('CONVENTION DE STAGE ENTRE LES SOUSSIGNES, '),0,1);
$pdf->Cell(100,5,utf8_decode('Ci-après L\'ETABLISSEMENT D\'ENSEIGNEMENT, '),0,1);
$pdf->SetFont('Arial','',10);
$pdf->Cell(100,5,utf8_decode('L\'établissement privé d\'enseignement supérieur : '),0,0);
$pdf->Cell(100,5,utf8_decode($nom_etablissement),0,1);
$pdf->widIf($pdf,"Adresse :",$numero_rue_etablissement,$adresse_etablissement,$code_postal_etablissement." ". $ville_etablissement,3);
$pdf->wid("Téléphone : ", $telephone_etablissement,-4);
$pdf->widIf($pdf,"Représenté par : ",$nom_representant_etablissement,$prenom_representant_etablissement,"",-3);
//$pdf->wid("Fonction du représentant : ", $fonction_representant_etablissement);
//$pdf->wid("Mail : ",$mail_etablissement,3);

//--------Début entreprise------------
//$pdf->Cell(10);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(300,5,utf8_decode('Ci-après L\'ENTREPRISE, '),0,1);
$pdf->SetFont('Arial','',10);
$pdf->wid("La société ou organisme d'accueil : ", $nom_entreprise,-4);
$pdf->widIf($pdf,"Adresse : ",$numero_rue_entreprise,$adresse_entreprise,"",1);
$pdf->widIf($pdf,"Code postal et ville : ",$code_postal_entreprise,$ville_entreprise,"",1);
$pdf->widIf($pdf,"Représentée par : ", $nom_representant_entreprise, $prenom_representant_entreprise,"",-4);
$pdf->wid("Fonction du représentant : ", $fonction_representant_entreprise);
$pdf->wid("Secteur d'activité : ", $secteur_activite_entreprise,-1,false,0,false);
$pdf->wid("Service dans lequel le stage sera effectué : ", $services_entreprise);
$pdf->dblCell(5,"Téléphone :   ",$telephone_entreprise,0,20,0,0,0);
$pdf->dblCell(5,"Mail :   ",$mail_entreprise,0,0,0,0,1);
if($lieu_bis_entreprise != "Non-renseigné"){
    $pdf->wid("Lieu du stage si différent de l'adresse de la société ou de l'organisme d'accueil : ", $lieu_bis_entreprise, -6);
}
$pdf->Ln();

//--------Début stagiaire------------
//$pdf->Cell(10);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(100,10,utf8_decode('Ci-après LE STAGIAIRE, '),0,1);
$pdf->SetFont('Arial','',10);
$pdf->widIf($pdf,"M(me) ",$nom_stagiaire,$prenom_stagiaire,"");
$pdf->wid("Né(e) le : ",$date_naissance_stagiaire,-1);
$pdf->wid("Nationalité : ",$nationalite,-2);
$pdf->Cell(60,5,utf8_decode("Demeurant : "),0,1);
$pdf->widIf($pdf,"Adresse : ",$numero_rue_stagiaire,$adresse_stagiaire,"",1);
$pdf->widIf($pdf,"Code postal et ville : ",$code_postal_stagiaire,$ville_stagiaire,"",1);
$pdf->dblCell(5,"Téléphone :   ",$telephone_stagiaire,0,20,0,0,0);
$pdf->dblCell(5,"Mail :   ",$identifiant,0,0,0,0,1);
$pdf->Ln();
$pdf->wid("Intitulé du cursus suivi dans l'établissement : ", $classe,1);
$pdf->Ln();

$pdf->Ln();
$pdf->SetFont('Arial','B',10);
$pdf->Cell(100,5,utf8_decode('DUREE ET DEROULE DU STAGE, '),0,1);
$pdf->Ln();
if($date_debut == "Non-renseigné" || $date_fin == "Non-renseigné"){
    $pdf->wid("Dates : ","Non-renseigné",2,true);
}else{
    $pdf->wid("Dates : ","du $date_debut au $date_fin",2,true);
}

// AJOUTER ICI UN BLOC IF POUR LA DUREE EN SEMAINE-MOIS
$pdf->wid("Et correspondant à ","$duree_totale heures de présence effective dans l'organisme d'accueil.",2,true);
// AJOUTER ICI LA REPARTITION SI DISCONTINUE
// AJOUTER ICI LE COMMENTAIRE



//---------Début tableau encadrement----------
$pdf->SetWidths(array(90,90));// Configuration du tableau
$pdf->Row(array("ENCADREMENT DU STAGIAIRE PAR L'ETABLISSEMENT ","ENCADREMENT DU STAGIAIRE PAR L'ORGANISME D'ACCUEIL"));
$pdf->SetFont('Arial','',10);
$pdf->Row(array(utf8_decode("Nom et prénom de l'enseignant référent : $nom_referent $prenom_referent\n "),utf8_decode("Nom et prénom tuteur de stage : $nom_tuteur $prenom_tuteur")));
$pdf->Row(array(utf8_decode("Fonction (ou discipline) : $fonction_referent\n "),utf8_decode("Fonction : $fonction_tuteur")));
$pdf->Row(array(utf8_decode("Tél : $telephone_referent\nMail : $mail_referent\n  "),utf8_decode("Tél : $telephone_tuteur\nMail : $mail_tuteur")));
//$pdf->Row(array(utf8_decode("Mail : $mail_referent\n "),utf8_decode("Mail : $mail_tuteur")));
$pdf->Ln();


//-------sécurité sociale---------
$pdf->page($pdf,250);
//$pdf->AddPage()
$pdf->SetFont('Arial',"B",10);
//$pdf->Cell(0,5,utf8_decode("Numéro de sécurité sociale du STAGIAIRE"),0,1);
$pdf->MultiCell(0,5,utf8_decode("Numéro de sécurité sociale du STAGIAIRE + nom et adresse postale de la caisse d’assurance maladie à contacter en cas d’accident (lieu de domicile du STAGIAIRE sauf exception) :\n"),0);
$pdf->SetFont('Arial',"",10);
$pdf->MultiCell(0,5, utf8_decode($numero_securite_social."\nAssurance maladie ".$numero_rue_assurance." ".$adresse_caisse_assurance."\n".$code_postal_assurance." ".$ville_assurance."\n"),1,'L');


/*
$pdf->wid("Numéro de sécurité sociale du STAGIAIRE : ",$numero_securite_social,-7,true);
$pdf->SetFont('Arial',"B",10);
$pdf->Cell(100,5,utf8_decode("Adresse postale de la caisse d'assurance maladie à contacter en cas d'accident  "),0,1);
$pdf->SetFont('Arial',"",10);
$pdf->widIf($pdf,"Adresse : ",$numero_rue_assurance,$adresse_caisse_assurance);
$pdf->widIf($pdf,"Code postal et ville : ",$code_postal_assurance,$ville_assurance);
*/


