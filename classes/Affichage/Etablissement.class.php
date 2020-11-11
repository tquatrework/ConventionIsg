<?php
namespace Affichage;
use \PDO;
class Etablissement extends Affichage{
 
    public function __construct($dbh){

        $this->requestRecherche = 'SELECT * FROM etablissement WHERE nom_etablissement lIKE CONCAT("%",:recherche,"%") ORDER BY nom_etablissement LIMIT 5 OFFSET :offset';
        $this->requestAll = 'SELECT * FROM etablissement ORDER BY nom_etablissement LIMIT 5 OFFSET :offset';
        $tabResult = $this->select($dbh,"Etablissements d'enseignement","Aucun établissement");

        if(is_array($tabResult) && !empty($tabResult)){
            foreach($tabResult as $tab){
                $this->affiche($tab,"titre","","nom_etablissement");
                $this->affiche($tab,"ligne1","iconAdresse",'numero_rue_etablissement',"adresse_etablissement","code_postal_etablissement","ville_etablissement");
                $this->affiche($tab,"ligne2","iconUser","representant_etablissement");
                $this->affiche($tab,"ligne3","iconTelephone","telephone_etablissement");
                $this->lien_modification = "index.php?id_etablissement=".$tab["id_etablissement"]."&task=show&controller=etablissement";
                $this->lien_suppression = "index.php?id_etablissement=".$tab["id_etablissement"]."&controller=etablissement&task=supprimer&token=".$_SESSION["token"];
                $this->card();
                $this->reset();
                echo "<br/>";
            }
            $page = new \Pagination\Pagination($dbh);
        }
    }
} 