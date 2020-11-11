<?php

namespace Pagination;
use \PDO;
class Pagination{

    public $page;
    public $offset;
    public $recherche;
    public $nombre;
    public $statusPrecedent;
    public $statusSuivant;
    public $id;
    public $filtre;

    public function __construct($dbh){
        
        $file = $_GET["controller"];
        if($file == "stagiaire"){
            $request1 = 'SELECT * FROM stagiaire WHERE nom_stagiaire like "%:recherche%" OR prenom_stagiaire like "%:recherche%" || CONCAT(nom_stagiaire," ",prenom_stagiaire) LIKE ":recherche%" || CONCAT(prenom_stagiaire," ",nom_stagiaire) LIKE ":recherche%"';
            $request2 = 'SELECT * FROM stagiaire';
        }elseif($file == "entreprise"){
            $request1 = 'SELECT * FROM entreprise WHERE nom_entreprise LIKE "%:recherche%" ORDER BY nom_entreprise';
            $request2 = 'SELECT * FROM entreprise ORDER BY nom_entreprise';
            $request3 = 'SELECT * FROM entreprise WHERE fk_utilisateur_entreprise = :id ORDER BY nom_entreprise';
        }elseif($file == "tuteur"){
            $request1 = 'SELECT * FROM tuteur INNER JOIN entreprise ON entreprise.id_entreprise = tuteur.fk_entreprise WHERE nom_tuteur LIKE "%:recherche%" || prenom_tuteur LIKE "%:recherche%" || nom_entreprise LIKE "%:recherche%" || CONCAT(nom_tuteur," ",prenom_tuteur) LIKE ":recherche%" || CONCAT(prenom_tuteur," ",nom_tuteur) LIKE ":recherche%"';
            $request2 = 'SELECT * FROM tuteur INNER JOIN entreprise ON entreprise.id_entreprise = tuteur.fk_entreprise';
            $request3 = 'SELECT * FROM tuteur INNER JOIN entreprise ON entreprise.id_entreprise = tuteur.fk_entreprise WHERE fk_utilisateur_tuteur = :id';
        }elseif($file == "stage"){
            $request1 = 'SELECT * FROM stage
            INNER JOIN stagiaire ON stage.fk_utilisateur_stage = stagiaire.id_stagiaire 
            INNER JOIN tuteur ON tuteur.id_tuteur = stage.fk_tuteur_stage
            INNER JOIN entreprise ON tuteur.fk_entreprise = entreprise.id_entreprise
            WHERE nom_stagiaire LIKE CONCAT("%",:recherche,"%") 
            || prenom_stagiaire LIKE CONCAT("%",:recherche,"%") 
            || nom_entreprise LIKE CONCAT("%",:recherche,"%") 
            || CONCAT(nom_stagiaire," ",prenom_stagiaire) LIKE CONCAT(:recherche,"%") 
            || CONCAT(prenom_stagiaire," ",nom_stagiaire) LIKE CONCAT(:recherche,"%") 
            || classe LIKE CONCAT(:recherche,"%") 
            || classe LIKE CONCAT("%",:recherche,"%") 
            || classe LIKE CONCAT("%",:recherche) ';
            $request2 = 'SELECT * FROM stage INNER JOIN stagiaire ON stage.fk_utilisateur_stage = stagiaire.id_stagiaire';
            $request3 = 'SELECT * FROM stage INNER JOIN stagiaire ON stage.fk_utilisateur_stage = stagiaire.id_stagiaire WHERE fk_utilisateur_stage = :id ORDER BY nom_stagiaire' ;
        }elseif($file == "etablissement"){
            $request1 = 'SELECT * FROM etablissement WHERE nom_etablissement lIKE "%:recherche%"';
            $request2 = 'SELECT * FROM etablissement';
        }elseif($file == "referent"){
            $request1 = 'SELECT * FROM referent INNER JOIN etablissement ON etablissement.id_etablissement = referent.fk_enseignement_referent WHERE nom_referent LIKE "%:recherche%" || prenom_referent LIKE "%:recherche%" || nom_etablissement LIKE "%:recherche%" || CONCAT(nom_referent," ",prenom_referent) LIKE ":recherche%" || CONCAT(prenom_referent," ",nom_referent) LIKE ":recherche%"';
            $request2 = 'SELECT * FROM referent INNER JOIN etablissement ON etablissement.id_etablissement = referent.fk_enseignement_referent';
        }

        if(!empty($_GET["filtre"])){

            if($_GET["filtre"] == "enAttente"){
                $statut = "en attente de validation";
                $from = "stage";
            }elseif($_GET["filtre"] == "valide"){
                $statut = "Stage validé";
                $from = "stage";
            }elseif($_GET["filtre"] == "permanente"){
                $from = "entreprise";
                $statut = "permanente";
            }
            $this->filtre = $_GET["filtre"];
            $array = array(":statut"=>$statut);
            $request = 'SELECT * FROM '.$from.' WHERE statut = :statut';
            $recherche = "";
            $this->nombre = count(\tryPrepareAll($dbh,$request,$array,true));
        }
        //------SELECT SANS ID-------------
        elseif($_SESSION["profile"] == "administrateur" && empty($_GET["id"])){

            //-----SELECT AVEC RECHERCHE----------æ
            if(!empty($_POST["recherche"]) || !empty($_GET["recherche"])){
                $request = $request1;
                $recherche = varRecherche();
                $array = array(':recherche'=>$recherche);
                $this->nombre = count(tryPrepareAll($dbh,$request,$array,true));

            //--------SELECT SANS RECHERCHE----------
            }else{
                $request = $request2;
                $recherche = "";
                $this->nombre = count(selectAll($request,$dbh));
            }

        //--------SELECT AVEC ID---------
        }elseif(($_SESSION["profile"] == "administrateur" && !empty($_GET["id"])) || ($_SESSION["profile"] == "etudiant")){
            if(!empty($request3)){
                $request = $request3;
                if(!empty($_GET["id"])){
                    $array = array(":id"=>$_GET["id"]);
                }else{
                    $array = array(":id"=>$_SESSION["id"]);
                }
                $this->nombre = count(tryPrepareAll($dbh,$request,$array,true));
            }
            $recherche = "";
        }
        $this->page = $file;
        $this->offset = isOffset();
        $this->recherche = $recherche;
        if($this->nombre > 5){
            $this->pagin();
        }
    }

    function pagin(){
        ?>
        <div class="row col-md-9 justify-content-end" style="padding-right:0px">
            <nav>
                <ul class="pagination">
                    <?php
                        $this->precedent();
                        $this->suivant();
                    ?>
                </ul>
            </nav>
        </div>
        <?php
    }

    public function li($nom,$off,$status=""){
        if(!empty($this->recherche)){
            $recherche = "&recherche=".$this->recherche;
        }else{
            $recherche="";
        }
        if(!empty($_GET["id"])){
            $id = "&id=".$_GET["id"];
        }else{
            $id="";
        }
        if(!empty($_GET["filtre"])){
            $filtre = "&filtre=".$_GET["filtre"];
        }else{
            $filtre="";
        }
        ?>
        <li class="page-item <?=$status?>">
            <a class="page-link" href="/Convention/index.php?controller=<?=$this->page?>&task=liste&offset=<?=$off?><?=$id?><?=$recherche?><?=$filtre?>"><?=$nom?></a>
        </li>
        <?php
    }

    public function precedent(){
        if( $this->offset-5 < 0 ){
            $off = 0;
            $this->statusPrecedent = "disabled";
        }else{
            $off = $this->offset-5;
        }
        $this->li("précédent",$off,$this->statusPrecedent);
    }

    public function suivant(){
        if( ($this->offset+5) >= $this->nombre){
            $off = $this->offset;
            $this->statusSuivant = "disabled"; 
        }else{
            $off = $this->offset+5;
        }
        $this->li("suivant",$off,$this->statusSuivant);
    }

}