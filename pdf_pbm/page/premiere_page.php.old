<?php
//-----------Début En-Tête------------
$pdf->Image('ISG_logo.jpg',30,10,-200);
$pdf->SetFont('Arial','B',15);
$pdf->Cell(40);
$pdf->Cell(120,5,"CONVENTION DE STAGE ETUDIANT",0,1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(60);
$pdf->Cell(60,5,utf8_decode("Etudiant majeur"));
$pdf->Cell(60,5,utf8_decode("(Stage effectué en France)"));
$pdf->Cell(80,5,utf8_decode("Année universitaire ".$annee_universitaire));
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(10); // marge à gauche
$pdf->Cell(100,10,'CONVENTION DE STAGE ENTRE LES SOUSSIGNES :',0);
$pdf->SetFont('Arial','',10);
$pdf->Ln(); // revenir à la ligne

//--------Début etablissement d'enseignement
$pdf->Cell(10); // marge à gauche
$pdf->Cell(100,10,utf8_decode('Ci-après L\'ETABLISSEMENT D\'ENSEIGNEMENT, '),0,1);
$pdf->wid('L\'établissement privé d\'enseignement supérieur : ',$nom_etablissement,-7);
$pdf->widIf($pdf,"Adresse :",$numero_rue_etablissement,$adresse_etablissement,"",3);
$pdf->widIf($pdf,"Code postal et ville : ",$code_postal_etablissement, $ville_etablissement,"",3);
$pdf->wid("Tél : ",$telephone_etablissement);
$pdf->widIf($pdf,"Représenté par : ",$nom_representant_etablissement,$prenom_representant_etablissement,"",-3);
//$pdf->wid("Fonction du représentant : ", $fonction_representant_etablissement);
//$pdf->wid("Mail : ",$mail_etablissement,3);

//--------Début entreprise------------
$pdf->Cell(10);
$pdf->Cell(300,10,utf8_decode('Ci-après L\'ENTREPRISE, '),0,1);
$pdf->wid("La société ou organisme d'accueil : ", $nom_entreprise,-4);
$pdf->widIf($pdf,"Adresse : ",$numero_rue_entreprise,$adresse_entreprise,"",1);
$pdf->widIf($pdf,"Code postal et ville : ",$code_postal_entreprise,$ville_entreprise,"",1);
$pdf->widIf($pdf,"Représentée par : ", $nom_representant_entreprise, $prenom_representant_entreprise,"",-4);
$pdf->wid("Fonction du représentant : ", $fonction_representant_entreprise);
$pdf->wid("Téléphone : ", $telephone_entreprise,-4);
$pdf->wid("Mail : ", $mail_entreprise,1);
$pdf->wid("Secteur d'activité : ", $secteur_activite_entreprise,-1,false,0,false);
// $pdf->Cell(40,5,"Secteur d'activité : ",1,0,);
// $pdf->MultiCell(0,5,$secteur_activite_entreprise,1);
$pdf->wid("Service dans lequel le stage sera effectué : ", $services_entreprise);
if($lieu_bis_entreprise != "Non-renseigné"){
    $pdf->wid("Lieu du stage si différent de l'adresse de la société ou de l'organisme d'accueil : ", $lieu_bis_entreprise, -6);
}


//--------Début stagiaire------------
$pdf->Cell(10);
$pdf->Cell(100,10,utf8_decode('Ci-après LE STAGIAIRE, '),0,1);
$pdf->widIf($pdf,"M(me) ",$nom_stagiaire,$prenom_stagiaire,"");

$pdf->wid("Né(e) le : ",$date_naissance_stagiaire,-1);
$pdf->wid("Nationalité : ",$nationalite,-2);
$pdf->widIf($pdf,"Adresse : ",$numero_rue_stagiaire,$adresse_stagiaire,"",1);
$pdf->widIf($pdf,"Code postal et ville : ",$code_postal_stagiaire,$ville_stagiaire,"",1);
$pdf->wid("Téléphone : ", $telephone_stagiaire,-4);
$pdf->wid("Mail : ", $identifiant,1);
$pdf->wid("Classe : ", $classe,1);

$pdf->Ln();
if($date_debut == "Non-renseigné" || $date_fin == "Non-renseigné"){
    $pdf->wid("Dates : ","Non-renseigné",2,true);
}else{
    $pdf->wid("Dates : ","du $date_debut au $date_fin",2,true);
}

$pdf->wid("Et correspondant à ","$duree_totale de présence effective dans l'organisme d'accueil.",2,true);


//---------Début tableau encadrement----------
$pdf->SetWidths(array(90,90));// Configuration du tableau
$pdf->Row(array("Encadrement du stagiaire par l'ETABLISSEMENT D'ENSEIGNEMENT","Encadrement du stagiaire par l'ENTREPRISE"));
$pdf->SetFont('Arial','',10);
$pdf->Row(array(utf8_decode("Nom/prénom référent : $nom_referent $prenom_referent\n "),utf8_decode("Nom/prénom tuteur de stage : $nom_tuteur $prenom_tuteur")));
$pdf->Row(array(utf8_decode("Fonction ou discipline : $fonction_referent\n "),utf8_decode("Fonction : $fonction_tuteur")));
$pdf->Row(array(utf8_decode("Tél : $telephone_referent\n "),utf8_decode("Tél : $telephone_tuteur")));
$pdf->Row(array(utf8_decode("Mail : $mail_referent\n "),utf8_decode("Mail : $mail_tuteur")));
$pdf->SetFont('Arial',"B",10);
$pdf->Ln();

//-------sécurité sociale---------
$pdf->page($pdf,265);
$pdf->wid("Numéro de sécurité sociale du STAGIAIRE : ",$numero_securite_social,-7,true);
$pdf->SetFont('Arial',"B",10);
$pdf->Cell(100,5,utf8_decode("Adresse postale de la caisse d'assurance maladie à contacter en cas d'accident  "),0,1);
$pdf->SetFont('Arial',"",10);
$pdf->widIf($pdf,"Adresse : ",$numero_rue_assurance,$adresse_caisse_assurance);
$pdf->widIf($pdf,"Code postal et ville : ",$code_postal_assurance,$ville_assurance);

