<?php
namespace Affichage;
use \PDO;
class AffichageEntreprise extends Affichage{
 
    public function __construct($dbh){

        //----------SELECT SI GET-------------
        $this->requestId = 'SELECT * FROM entreprise WHERE fk_utilisateur_entreprise = :id ORDER BY nom_entreprise LIMIT 5 OFFSET :offset';
        $this->requestRecherche = 'SELECT * FROM entreprise WHERE nom_entreprise LIKE CONCAT("%",:recherche,"%") ORDER BY nom_entreprise LIMIT 5 OFFSET :offset';
        $this->requestAll = 'SELECT * FROM entreprise ORDER BY nom_entreprise LIMIT 5 OFFSET :offset';
        $tabResult = $this->select($dbh,"Liste des entreprises","Aucune entreprise");

        //---------AFFICHAGE---------------- 
        if(is_array($tabResult) && !empty($tabResult)){  
            foreach($tabResult as $tab){
                $this->affiche($tab,"titre","","nom_entreprise");
                $this->affiche($tab,"ligne1","iconAdresse","numero_rue_entreprise","adresse_entreprise","code_postal_entreprise","ville_entreprise");
                $this->affiche($tab,"ligne2","iconTelephone","telephone_entreprise");
                $this->affiche($tab,"ligne3","iconBriefcase",'secteur_activite_entreprise');
                $this->lien_suppression = "index.php?id_entreprise=".$tab['id_entreprise']."&controller=entreprise&task=supprimer";
                if(isset($_GET["id"])){
                    $this->lien_modification = "index.php?id_entreprise=".$tab['id_entreprise']."&id=".$_GET["id"]."&controller=entreprise&task=show";
                }else{
                    $this->lien_modification = "index.php?id_entreprise=".$tab['id_entreprise']."&task=show&controller=entreprise";
                }
                $this->card();
                $this->reset();
                echo "<br/>"; 
            } 
            $page = new \Pagination\Pagination($dbh);
        }
    }
 
    
}


