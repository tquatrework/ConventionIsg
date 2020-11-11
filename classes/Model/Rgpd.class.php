<?php

namespace Model;

use Database;
use PDO;
use Utils;

class Rgpd extends Model{

    public $table = "rgpd";

    public function statusRgpd(){
        $request = 'SELECT rgpd FROM utilisateur WHERE id = :id';
        $array = array(':id'=>$_SESSION["id"]);
        $rgpd = Utils::tryBindFetch($request,$array);
        return $rgpd;
    }

    public function accepte(){
        $request = "UPDATE utilisateur SET rgpd = 'accepte' WHERE id = :id" ;
        $array = array(':id'=>$_SESSION["id"]);
        \Utils::tryBind($request,$array);
    }

    public function refuse(){
        $request = "UPDATE utilisateur SET rgpd = 'refuse' WHERE id = :id" ;
        $array = array(':id'=>$_SESSION["id"]);
        \Utils::tryBind($request,$array);
    }

}