<?php

//--------Debut article 2-------------
$pdf->article("Article 2 - Objectif du stage","Le stage correspond à une période temporaire de mise en situation en milieu professionnel au cours de laquelle l'étudiant(e) acquiert des compétences professionnelles et met en oeuvre les acquis de sa formation en vue de l'obtention d'un diplôme ou d'une certification et de favoriser son insertion professionnelle. Le stagiaire se voit confier une ou des missions conformes au projet pédagogique défini par son établissement d'enseignement et approuvées par l'organisme d'accueil.
Le programme est établi par l'établissement d'enseignement et l'organisme d'accueil en fonction du programme général de la formation dispensée.");
$pdf->ln();
$pdf->Cell(60,5,utf8_decode("Intitulé du poste : "),0,1);
$pdf->Cell(0,5,utf8_decode($intitule_poste),1,1);
$pdf->ln();
$pdf->Cell(60,5,utf8_decode("Activités confiées : "),0,1);
$pdf->MultiCell(0,5,utf8_decode($activites_missions),1);
$pdf->ln();

/* 
switch($classe){
//---------Début première année--------
    case "ISEG - 1re année":
    $pdf->article("1ère année - Stage de découverte de l'entreprise - VHP 480*","Découverte de l'entreprise, de son secteur, de son organisation, de son écosyst�me et de sa sph�re relationnelle (exemples : vente conseil ; relation client ; prospection ; gestion du stock ; organisation d'un événement ; social media etc.). Découverte d'une association dans le cadre d'un engagement aupr�s des grandes causes humanitaires, sociétales et environnementales. 
* Volume Horaire Pédagogique.");
    break; 

//-------Début deuxième année---------
    case "ISEG - 2e année":
    $pdf->article("2ème année - Stage d'application et de compréhension des métiers marketing/communication - VHP 480","Validation de la bonne compréhension des enjeux des fonctions marketing / communication au sein d'une entreprise et participation à la mise en place de plans d'actions marketing communication (exemples : participation à la gestion d'un site marchand et des réseaux sociaux ; assistant manager ; création de supports de vente ; prospection et suivi client ; réalisation de veille concurrentielle ; participation à la réalisation de supports de communication etc.). 
Découverte d'une association dans le cadre d'un engagement auprès des grandes causes humanitaires, sociétales et environnementales.");
    break;

//-------Début troisième année---------
    case "ISEG - 3e année":
    $pdf->article("3ème année - Stage opérationnel et d'orientation - VHP 480","Implication de l'étudiant dans le cadre d'une fonction marketing / communication en agence, entreprise, média ou société d'études afin de conforter son choix d'expertise de la 4e année. Consolidation de la dimension opérationnelle de l'étudiant (exemples : assistant chef de projet marketing, assistant communication et e-marketing ; assistant chargé de communication ; gestion opérationnelle de projets digitaux ; community management ; rédaction de contenu éditorial ; assistant chef de produit ; assistant développement commercial). 
Stages auprès d'associations représentant de grandes causes humanitaires, sociétales ou environnementales.");
    break;

//-------Début quatrième année---------
    case "ISEG - 4e année":
    $pdf->article("4ème année - Mission professionnelle fonctionnelle - VHP 567h","Investissement dans une ou plusieurs fonctions liées à l'expertise métier choisie en second cycle et mise en oeuvre de compétences opérationnelles : participer à la mise en place de stratégies marketing et communication ; conception de plans d'actions et mise en oeuvre. Evaluer des résultats et établir un bilan. Exemples : assistant chef de projet événementiel ; assistant marketing web et CRM ; concepteur-rédacteur ; assistant chef de projet web ; assistant chef de produit ; pôle commercial et opérationnel ; assistant chef de publicité ; chargé de promotion. 
Stages auprès d'associations représentant de grandes causes humanitaires, sociétales ou environnementales.");
    break;

//-------Début cinquième année---------
    case "ISEG - 5e année":
    $pdf->article("5ème année - Intégration Professionnelle - VHP 471","Intégration de l'étudiant dans le cadre d'une fonction marketing / communication en agence, entreprise, média ou société d'études (exemples : chef de projet marketing, communication et web marketing ; chef de produit ; chargé de communication ; gestion opérationnelle de projets digitaux ; community management ; rédaction de contenu éditorial ; lancement et développement de marque ; développement commercial). Stages auprès d'associations représentant de grandes causes humanitaires, sociétales ou environnementales.");
        break;

    default:
    $pdf->SetTextColor(255,0,0);
    $pdf->ligneLn("Aucune classe sélectionnée");
    $pdf->SetTextColor(0,0,0);
    $pdf->saut();
    }

//-----ACTIVITEES MISSION----------
$pdf->Cell(5,5,utf8_decode("L'ENTREPRISE proposera ainsi au STAGIAIRE la réalisation des activités comme suit :"),0,1);
$pdf->saut();
$pdf->wid("Activités / missions confiées : ",$activites_missions,0,true,1,true);

//--------COMPETENCES----------
$pdf->saut();
$pdf->wid("Compétences à acquérir ou à développer : ",$competences_developper,0,true,1,true);
$pdf->saut();
*/