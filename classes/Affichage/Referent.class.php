<?php
namespace Affichage;
use \PDO;
class Referent extends Affichage{

    public function __construct($dbh){

        $this->requestRecherche = 'SELECT * FROM referent 
                                INNER JOIN etablissement ON etablissement.id_etablissement = referent.fk_enseignement_referent 
                                WHERE nom_referent LIKE CONCAT("%",:recherche,"%") 
                                || prenom_referent LIKE CONCAT("%",:recherche,"%") 
                                || nom_etablissement LIKE CONCAT("%",:recherche,"%") 
                                || CONCAT(nom_referent," ",prenom_referent) LIKE CONCAT(:recherche,"%") 
                                || CONCAT(prenom_referent," ",nom_referent) LIKE CONCAT(:recherche,"%") 
                                ORDER BY nom_referent LIMIT 5 OFFSET :offset';

        $this->requestAll = 'SELECT * FROM referent INNER 
                            JOIN etablissement ON etablissement.id_etablissement = referent.fk_enseignement_referent 
                            ORDER BY nom_referent LIMIT 5 OFFSET :offset';

        $tabResult = $this->select($dbh,"Liste des référents","Aucun référent");

        if(is_array($tabResult) && !empty($tabResult)){
            foreach($tabResult as $tab){
                $this->affiche($tab,"titre","","nom_referent","prenom_referent");
                $this->affiche($tab,"ligne1","iconBriefcase","fonction_referent");
                $this->affiche($tab,"ligne2","iconTelephone","telephone_referent");
                $this->affiche($tab,"ligne3","iconEtablissement","nom_etablissement");
                $this->lien_modification = "index.php?id_referent=".$tab["id_referent"]."&task=show&controller=referent";
                $this->lien_suppression = "index.php?id_referent=".$tab["id_referent"]."&controller=referent&task=supprimer&token=".$_SESSION["token"];
                $this->card();
                $this->reset();
                echo "<br/>";
            }
            $page = new \Pagination\Pagination($dbh);
        }
    }
} 