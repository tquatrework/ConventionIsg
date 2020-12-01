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
        $this->model->sendMail($recipients,"Stage en attente de validation","Bonjour, vous avez un stage en attente de validation ");
        redirect("index.php?controller=stage&task=liste");
    }

    public function confirmation(){
        //$this->model->updateStatut("Stage validé");
	$this->model->updateStatut("Stage valide");
        redirect("index.php?controller=stage&task=liste");
    }
}

