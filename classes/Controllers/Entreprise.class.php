<?php

namespace Controllers;

class Entreprise extends Controller
{
    public $page = "Entreprise";

    public function permanente(){
        $this->model->updateStatut("permanente");
    }

    public function nonPermanente(){
        $this->model->updateStatut("");
    }
    
}
