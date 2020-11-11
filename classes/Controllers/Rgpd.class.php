<?php

namespace Controllers;
use Database;

class Rgpd extends Controller
{

    public $page = "Rgpd";

    public function valider(){
        $this->model->accepte();
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    
    public function fermer(){
        $this->model->refuse();
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}
