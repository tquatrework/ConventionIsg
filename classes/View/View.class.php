<?php

namespace View;

class View{

    public $tabResult;
    public $table;
    public $titre;
    public $lien_modification;
    public $lien_suppression;
    public $ligne1;
    public $ligne2;
    public $ligne3;
    public $array = [];

    public function card(){
        ?>
        <div class="col-md-10" style="padding-left:0px">
            <div class="card">

                <div class="card-header d-flex justify-content-between">
                    <div>
                        <h5><?=$this->titreCard($this->tabResult)?></h5>
                    </div>
                    <div>
                        <a href="<?=$this->href("show")?>" class="btn btn-primary btn-sm">Modification</a>
                        <a href="<?=$this->href("delete")?>" class="btn btn-info btn-sm">Suppression</a>
                    </div>
                </div>
                <div class="card-body">
                    <?php
                    $this->bodyCard();
                    ?>
                </div>
            </div>
        </div>
        <br/>
        <?php
    }

    public function titreCard(){

        if($this->table == "stage"){
            $titre_card = "Du ".$this->tabResult['date_debut']." au ".$this->tabResult['date_fin'];
        }elseif($this->table == "entreprise" || $this->table == "etablissement"){
            $titre_card = $this->tabResult["nom_".$this->table];
        }else{
            $titre_card = $this->tabResult["nom_".$this->table]." ".$this->tabResult["prenom_".$this->table];
        }
        return $titre_card;

    }

    public function bodyCard(){
        $this->ligneAdresse();
        $this->ligne("telephone_","fas fa-phone");
        $this->ligne("secteur_activite_","fas fa-briefcase");
    }

    public function ligneAdresse(){
        if(!empty($this->tabResult["numero_rue_".$this->table]) || !empty($this->tabResult["adresse_".$this->table]) || !empty($this->tabResult["code_postal_".$this->table]) || !empty($this->tabResult["ville_".$this->table])){
            ?>
            <p class="card-text">
                <i class="far fa-address-card"></i>
                <?=$this->tabResult["numero_rue_".$this->table]." ".$this->tabResult["adresse_".$this->table]." ".$this->tabResult["code_postal_".$this->table]." ".$this->tabResult["ville_".$this->table]?>
            </p>
            <?php
        }
    }

    public function ligne($champ,$icon){
        if(!empty($this->tabResult[$champ.$this->table])){
            ?>
            <p class="card-text">
            <i class="<?=$icon?>"></i><?=$this->tabResult[$champ.$this->table]?>
            </p>
            <?php
        }
    }

    public function href($task){
        echo "index.php?controller={$this->table}&task={$task}&id_{$this->table}={$this->tabResult["id_".$this->table]}";
    }

}