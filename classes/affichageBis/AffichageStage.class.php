<?php
namespace Affichage;
use \PDO;
class AffichageStage extends Affichage{

    public $lien_pdf;
    
    public function __construct($dbh){
 
        $this->requestId = 'SELECT * FROM stage 
                            INNER JOIN stagiaire ON stage.fk_utilisateur_stage = stagiaire.id_stagiaire 
                            WHERE fk_utilisateur_stage = :id 
                            ORDER BY nom_stagiaire LIMIT 5 OFFSET :offset';

        $this->requestRecherche = 'SELECT * FROM stage 
                                INNER JOIN stagiaire ON stage.fk_utilisateur_stage = stagiaire.id_stagiaire 
                                INNER JOIN tuteur ON tuteur.id_tuteur = stage.fk_tuteur_stage
                                INNER JOIN entreprise ON tuteur.fk_entreprise = entreprise.id_entreprise
                                WHERE nom_stagiaire LIKE CONCAT("%",:recherche,"%") 
                                || prenom_stagiaire LIKE CONCAT("%",:recherche,"%") 
                                || nom_entreprise LIKE CONCAT("%",:recherche,"%") 
                                || CONCAT(nom_stagiaire," ",prenom_stagiaire) LIKE CONCAT(:recherche,"%") 
                                || CONCAT(prenom_stagiaire," ",nom_stagiaire) LIKE CONCAT(:recherche,"%") 
                                ORDER BY nom_stagiaire LIMIT 5 OFFSET :offset';

        $this->requestAll = 'SELECT * FROM stage 
                            INNER JOIN stagiaire ON stage.fk_utilisateur_stage = stagiaire.id_stagiaire 
                            ORDER BY nom_stagiaire LIMIT 5 OFFSET :offset';

        $tabResult = $this->select($dbh,"Liste des stages","Aucun stage");

        if(is_array($tabResult) && !empty($tabResult)){
            foreach($tabResult as $tab){
                $requestNomEntreprise = 'SELECT nom_entreprise from tuteur
                                        INNER JOIN entreprise ON tuteur.fk_entreprise = entreprise.id_entreprise
                                        WHERE id_tuteur = '.$tab["fk_tuteur_stage"].'';
                $resultNomEntreprise = select($requestNomEntreprise,$dbh,"");

                $this->affiche($tab,"titre","","nom_stagiaire","prenom_stagiaire");
                if(!empty($tab["date_debut"]) && !empty($tab["date_fin"])){
                    $this->ligne1 = $this->iconDate." Du ".$tab["date_debut"]." au ".$tab["date_fin"];
                }
                if(!empty($resultNomEntreprise["nom_entreprise"])){
                    $this->ligne2 = $this->iconEntreprise." ".$resultNomEntreprise["nom_entreprise"];
                }
                if(isset($_GET["id"])){
                    $this->lien_modification = "/Convention/index.php?id_stage=".$tab['id_stage']."&id=".$_GET["id"]."&task=show&controller=stage";
                }else{
                    $this->lien_modification = "/Convention/index.php?id_stage=".$tab['id_stage']."&task=show&controller=stage";
                }
                $this->lien_suppression = "/Convention/index.php?id_stage=".$tab['id_stage']."&controller=stage&task=supprimer";
                $this->lien_pdf = "pdf/pdf.php?id_stage=".$tab["id_stage"];
                $this->card(); 
                $this->reset();
                echo "<br/>";
            }
            $page = new \Pagination\Pagination($dbh);
        }
    } 

    //SURCHAGE 
    public function headerLien(){
        ?>
        <div>
            <a href="<?=$this->lien_pdf?>" class="btn btn-outline-primary btn-sm">PDF</a>
            <a href="<?=$this->lien_modification?>" class="btn btn-primary btn-sm">Modification</a>
            <a href="<?=$this->lien_suppression?>" class="btn btn-info btn-sm">Suppression</a>
        </div>
        <?php
    }

}


 