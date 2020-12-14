<?php

namespace Controllers;
use Database;

class Stage extends Controller
{
    public $page = "Stage";

    public function validation(){
        $this->model->updateStatut("en attente de validation");
	// ChangeCampus
	$recipients = "camille.pierrot@isg.fr, thierry.quatre@isg.fr";
    $NomPrenomEtudiant = $this->model->recupNomPrenom();
    $this->model->sendMail($recipients,"Stage en attente de validation","Bonjour, vous avez un stage en attente de validation.<br/><br/>
    Nom de l'étudiant : ".$NomPrenomEtudiant[0]['nom_stagiaire']."<br/>
    Prénom de l'étudiant : ".$NomPrenomEtudiant[0]['prenom_stagiaire']);
    $this->model->updateStatut("en attente de validation");
    redirect("index.php?controller=stage&task=liste");
    }

public function confirmation(){
    $etudiantEmail = $this->model->recupIdentifiant();
    $this->model->updateStatut("Stage valide");
    $this->model->sendMail($etudiantEmail["identifiant"],"Validation de stage","Bonjour, votre stage a été validé");
    redirect("index.php?controller=stage&task=liste");
    }
}
