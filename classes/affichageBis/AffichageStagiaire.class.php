<?php
namespace Affichage;
use \PDO;
class AffichageStagiaire extends Affichage{

    public function __construct($dbh){
        $this->titre("Liste des stagiaires");
        $offset = isOffset();
        if((!empty($_POST["recherche"])) || (!empty($_GET["recherche"]))){
            $recherche = varRecherche();
            $request = 'SELECT * FROM stagiaire WHERE nom_stagiaire like "%'.$recherche.'%" OR prenom_stagiaire like "%'.$recherche.'%" || CONCAT(nom_stagiaire," ",prenom_stagiaire) LIKE "'.$recherche.'%" || CONCAT(prenom_stagiaire," ",nom_stagiaire) LIKE "'.$recherche.'%" ORDER BY nom_stagiaire LIMIT 5 OFFSET '.$offset.'';
        }else{
            $request = 'SELECT * FROM stagiaire ORDER BY nom_stagiaire LIMIT 5 OFFSET '.$offset.'';
        }
        $tabResult = requestRecherche($dbh,$request,"Aucun stagiaire");

        if(is_array($tabResult) && !empty($tabResult)){
            foreach($tabResult as $tab){
                $this->affiche($tab,"titre","","nom_stagiaire","prenom_stagiaire");
                $this->affiche($tab,"ligne1","iconAdresse","numero_rue_stagiaire","adresse_stagiaire","code_postal_stagiaire","ville_stagiaire");
                $this->affiche($tab,"ligne2","iconTelephone","telephone_stagiaire");
                $this->affiche($tab,"ligne3","iconClasse","classe");
                $this->lien_modification = "index.php?id=".$tab['id_stagiaire']."&task=show&controller=stagiaire";
                $this->lien_suppression = "index.php?id_stagiaire=".$tab['id_stagiaire']."&controler=stagiaire&task=supprimer";
                $this->card();
                $this->reset();
                echo "<br/>";
            }
            $page = new \Pagination\Pagination($dbh);
        }
    }
} 