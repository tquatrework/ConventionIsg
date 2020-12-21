<?php
namespace Model;

use Database;
use PDO;
use Utils;

class Model
{
    public $dbh;
    public $table;
    public $offset;
    public $id_stagiaire;
    public $fk_utilisateur_label_insert;
    public $recherche;

    public function __construct()
    {
        $this->dbh = Database::pdo();
        $this->id_stagiaire = Utils::idStagiaire();
        $this->offset = Utils::offset();
        $this->recherche = Utils::recherche();

        //Label utilisateur pour insertion
        if($this->table != "etablissement" && $this->table != "referent" && $this->table != "stagiaire"){
            $this->fk_utilisateur_label_insert = "fk_utilisateur_".$this->table;
        }
    }

    public function updateStatut($statut){
        $request = "UPDATE {$this->table} SET statut = :statut WHERE id_".$this->table." = :id" ;
        Utils::tryBind($request,array(":id"=>$_GET["id_".$this->table],":statut"=>$statut));
        $offset = Utils::offsetLien();
        if(!empty($_GET["filtre"])){
            $filtre = "&filtre=".$_GET["filtre"];
        }else{
            $filtre = "";
        }
        redirect("index.php?controller=".$this->table."&task=liste".$offset.$filtre);
    }

    public function supprimer()
    {
        $request = "DELETE FROM {$this->table} WHERE id_{$this->table} = :id";
        Utils::tryBind($request,":id",$_GET["id_".$this->table]);
        echo "<div class='alert alert-danger col-md-auto d-inline-block'>" . ucfirst($this->table) . " supprimé(e)";
    }

    public function champExist($table,$champ){
        $request = 'SELECT count(*) FROM '.$table.' WHERE  '.$champ.' = '.$champ.' ';
        try{
            $sth = $this->dbh->prepare($request);
            $result = $sth->execute();
        }
        catch(Exception $e) {
            $result = 0;
        }
        return $result;
    }

    public function insert(){

        $keyString = "(";
        $valueString = "(";
        $compteur = 0;

        foreach($_POST as $key=>$value){
            $tabResult = $this->champExist($this->table,$key);
            if($tabResult > 0){
                if($compteur == 0){
                    $keyString .= "$key";
                    $valueString .= "\"$value\"";
                }else{
                    $keyString .= ",$key";
                    $valueString .= ",\"$value\"";
                }
                $compteur ++;
            }
        }

        if($this->table != "etablissement" && $this->table != "referent" && $this->table != "stagiaire"){
            $keyString .= ",".$this->fk_utilisateur_label_insert.")";
            $valueString .= ",".$this->id_stagiaire.")";
        }else{
            $keyString .= ")";
            $valueString .= ")";
        }
        
        $request = 'INSERT INTO '.$this->table.' '.$keyString.' VALUES '.$valueString.'';
        Utils::tryPrepare($request);

        echo "<div class='alert alert-success col-md-auto d-inline-block'>".ucfirst($this->table)." ajouté</div>";
    }

    public function FindAllById()
    {
        $request = "SELECT * FROM {$this->table} WHERE fk_utilisateur_{$this->table} = :id ORDER BY nom_{$this->table} LIMIT 5 :offset ";
        return Utils::tryBindFetch($request,array(":id"=>$this->id_stagiaire,":offset"=>$this->offset),1);
    }

    public function FindAllByResearch()
    {
        $request = "SELECT * FROM {$this->table} WHERE nom_{$this->table} LIKE CONCAT(\"%\",:recherche,\"%\") ORDER BY nom_{$this->table} LIMIT 5 OFFSET :offset";
        return Utils::tryBindFetch($request,array(":recherche"=>$this->recherche,":offset"=>$this->offset));
    }

    function findAll() {
        $request = "SELECT * FROM {$this->table} ORDER BY nom_{$this->table} LIMIT 5 ";
        return Utils::tryFetch($request,1);
    }

    public function sendMail($email,$sujet,$message){
        $to = $email;
        $subject = $sujet;
        $msg = $message;
        $msg = wordwrap($msg, 70);
        $headers[] = "MIME-Version: 1.0";
        $headers[] = "Content-type: text/html; charset=utf8";
        $headers[] = "From : convention@ionisbx.fr";
        mail($to, $subject, $msg, implode("\r\n", $headers));
    }

}
