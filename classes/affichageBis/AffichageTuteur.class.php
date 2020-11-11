<?php
namespace Affichage;
use \PDO;
class AffichageTuteur extends Affichage{

    public $table = "tuteur";

    public function __construct($dbh){

        $this->requestId = 'SELECT * FROM tuteur 
                            INNER JOIN entreprise 
                            ON entreprise.id_entreprise = tuteur.fk_entreprise 
                            WHERE fk_utilisateur_tuteur = :id 
                            ORDER BY nom_tuteur LIMIT 5 OFFSET :offset';

        $this->requestRecherche = 'SELECT * FROM tuteur
                                 INNER JOIN entreprise ON entreprise.id_entreprise = tuteur.fk_entreprise 
                                 WHERE nom_tuteur LIKE CONCAT("%",:recherche,"%") || prenom_tuteur LIKE CONCAT("%",:recherche,"%") || nom_entreprise LIKE CONCAT("%",:recherche,"%") || CONCAT(nom_tuteur," ",prenom_tuteur) LIKE CONCAT(:recherche,"%") || CONCAT(prenom_tuteur," ",nom_tuteur) LIKE CONCAT(:recherche,"%") ORDER BY nom_tuteur LIMIT 5 OFFSET :offset';

        $this->requestAll = 'SELECT * FROM tuteur 
                            INNER JOIN entreprise 
                            ON entreprise.id_entreprise = tuteur.fk_entreprise 
                            ORDER BY nom_tuteur LIMIT 5 OFFSET :offset'; 

        $tabResult = $this->select($dbh,"Liste des tuteurs","Aucun tuteur");


        if(is_array($tabResult) && !empty($tabResult)){

            foreach($tabResult as $tab){ 

                $this->affiche($tab,"titre","","nom_tuteur","prenom_tuteur");
                $this->affiche($tab,"ligne1","iconBriefcase","fonction_tuteur");
                $this->affiche($tab,"ligne2","iconTelephone","telephone_tuteur");
                $this->affiche($tab,"ligne3","iconEntreprise","nom_entreprise");
                if(isset($_GET["id"])){
                    $this->lien_modification = "index.php?id_tuteur=".$tab["id_tuteur"]."&id=".$_GET["id"]."&task=show&controller=tuteur";
                }else{
                    $this->lien_modification = "index.php?id_tuteur=".$tab["id_tuteur"]."&task=show&controller=tuteur";
                }
                $this->lien_suppression = "index.php?id_tuteur=".$tab["id_tuteur"]."&controller=tuteur&task=supprimer";
                $this->card();
                $this->reset();
                echo "<br/>";
            }
            $page = new \Pagination\Pagination($dbh);

        }

    }

} 