<?php

namespace Model;

use Database;
use PDO;
use Utils;

class Stage extends Model
{
    public $table = "stage";

    function findAll() {
        $request = "SELECT * FROM {$this->table} ORDER BY date_debut DESC LIMIT 5 ";
        return Utils::tryFetch($request,1);
    }

    public function updateStatut($statut){
        $request = "UPDATE {$this->table} SET statut = :statut WHERE id_stage = :id" ;
        Utils::tryBind($request,array(":id"=>$_GET["id_stage"],":statut"=>$statut));
        redirect("index.php?controller=stage&task=liste");
    }

    public function selectEnAttente(){
        $request = 'SELECT * FROM stage WHERE statut = "en attente de validation"';
        return Utils::tryFetch($request,1);
    }
}
