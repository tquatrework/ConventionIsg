<?php

namespace View;

class Stage extends View{

    public $table = "stage";

    public function bodyCard(){
        $this->ligne("fonction_tuteur","fas fa-briefcase");
        $this->ligne("telephone_tuteur","fas fa-phone");
        $this->ligne("nom_entreprise","fas fa-building");
    }

}