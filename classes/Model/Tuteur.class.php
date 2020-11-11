<?php

namespace Model;

use Database;
use PDO;
use Utils;

class Tuteur extends Model{

    public $table = "tuteur";

    function findAll() {
        $request = "SELECT * FROM {$this->table}
                INNER JOIN entreprise ON entreprise.id_entreprise = tuteur.fk_entreprise    
                ORDER BY nom_{$this->table} LIMIT 5 ";
        return Utils::tryFetch($request,1);
    }

}