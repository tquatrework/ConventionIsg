<?php

namespace View;

class Tuteur extends View{

    public $table = "tuteur";

    public function bodyCard(){
        $this->ligne("fonction_tuteur","fas fa-briefcase");
        $this->ligne("telephone_tuteur","fas fa-phone");
        $this->ligne("nom_entreprise","fas fa-building");
    }

    public function ligne($champ,$icon){
        if(!empty($this->tabResult[$champ])){
            ?>
            <p class="card-text">
            <i class="<?=$icon?>"></i><?=$this->tabResult[$champ]?>
            </p>
            <?php
        }
    }

}