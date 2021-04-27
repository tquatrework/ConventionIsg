<?php
namespace Affichage;
use \PDO;
class Stage_pbm extends Affichage{

    public $lien_pdf;
    public $lien_validation;
    public $lien_confirmation;
    public $lien_devalidation;
    public $tab;
    
    public function __construct($dbh){
 
        $this->requestId = 'SELECT * FROM stage
                            INNER JOIN stagiaire ON stage.fk_utilisateur_stage = stagiaire.id_stagiaire 
                            WHERE fk_utilisateur_stage = :id
                            && type_stage="PBM"
                            ORDER BY nom_stagiaire LIMIT 5 OFFSET :offset';

        $this->requestRecherche = 'SELECT * FROM stage
                                INNER JOIN stagiaire ON stage.fk_utilisateur_stage = stagiaire.id_stagiaire 
                                INNER JOIN tuteur ON tuteur.id_tuteur = stage.fk_tuteur_stage
                                INNER JOIN entreprise ON tuteur.fk_entreprise = entreprise.id_entreprise
                                WHERE (nom_stagiaire LIKE CONCAT("%",:recherche,"%") 
                                || prenom_stagiaire LIKE CONCAT("%",:recherche,"%") 
                                || nom_entreprise LIKE CONCAT("%",:recherche,"%") 
                                || CONCAT(nom_stagiaire," ",prenom_stagiaire) LIKE CONCAT(:recherche,"%") 
                                || CONCAT(prenom_stagiaire," ",nom_stagiaire) LIKE CONCAT(:recherche,"%") 
                                || classe LIKE CONCAT(:recherche,"%") 
                                || classe LIKE CONCAT("%",:recherche,"%") 
                                || classe LIKE CONCAT("%",:recherche)) 
                                && type_stage="PBM" 
                                ORDER BY nom_stagiaire LIMIT 5 OFFSET :offset';

        $this->requestAll = 'SELECT * FROM stage
                            INNER JOIN stagiaire ON stage.fk_utilisateur_stage = stagiaire.id_stagiaire
                            WHERE type_stage="PBM" 
                            ORDER BY nom_stagiaire LIMIT 5 OFFSET :offset';

        $this->requestFiltreAttente = 'SELECT * FROM stage
                                INNER JOIN stagiaire ON stage.fk_utilisateur_stage = stagiaire.id_stagiaire 
                                WHERE statut = "en attente de validation"
                                ORDER BY nom_stagiaire LIMIT 5 OFFSET :offset';

        $this->requestFiltreValide = 'SELECT * FROM stage
                                INNER JOIN stagiaire ON stage.fk_utilisateur_stage = stagiaire.id_stagiaire 
                                WHERE statut = "Stage validé"
                                && type_stage="PBM" 
                                ORDER BY nom_stagiaire LIMIT 5 OFFSET :offset';

        $tabResult = $this->select($dbh,"Liste des stages","Aucun stage");

        
        if(is_array($tabResult) && !empty($tabResult)){
            foreach($tabResult as $tab){
                $this->tab = $tab;
                $requestNomEntreprise = 'SELECT nom_entreprise FROM tuteur
                                        INNER JOIN entreprise ON tuteur.fk_entreprise = entreprise.id_entreprise
                                        WHERE id_tuteur = '.$tab["fk_tuteur_stage"].'';
                $resultNomEntreprise = select($requestNomEntreprise,$dbh,"");

                $this->affiche($tab,"titre","","nom_stagiaire","prenom_stagiaire");
                if(!empty($tab["statut"])){
                    $this->ligne_validation = $tab["statut"];
                }
                if(!empty($tab["date_debut"]) && !empty($tab["date_fin"])){
                    $this->ligne1 = $this->iconDate." Du ".$tab["date_debut"]." au ".$tab["date_fin"];
                }
                if(!empty($tab["classe"])){
                    $this->ligne3 = $this->iconClasse." ".$tab["classe"];
                }
                if(!empty($resultNomEntreprise["nom_entreprise"])){
                    $this->ligne2 = $this->iconEntreprise." ".$resultNomEntreprise["nom_entreprise"];
                }
                // TOUT CHANGER AVEC id_stage_pbm ???
                if(isset($_GET["id"])){
                    $this->lien_modification = "/Convention/index.php?id_stage=".$tab['id_stage']."&id=".$_GET["id"]."&task=show&controller=stage_pbm";
                }else{
                    $this->lien_modification = "/Convention/index.php?id_stage=".$tab['id_stage']."&task=show&controller=stage_pbm";
                }
                $this->lien_suppression = "/Convention/index.php?id_stage=".$tab['id_stage']."&controller=stage_pbm&task=supprimer&token=".$_SESSION["token"];
                $this->lien_validation = "/Convention/index.php?id_stage=".$tab["id_stage"]."&controller=stage_pbm&task=validation";
                $this->lien_confirmation = "/Convention/index.php?id_stage=".$tab["id_stage"]."&controller=stage_pbm&task=confirmation";
                $this->lien_devalidation = "/Convention/index.php?id_stage=".$tab["id_stage"]."&controller=stage_pbm&task=devalidationStage";                
                $this->lien_pdf = "pdf_pbm/pdf.php?id_stage=".$tab["id_stage"];
                $this->card(); 
                $this->reset();
                echo "<br/>";
            }
            $page = new \Pagination\Pagination($dbh);
        }
    } 

    //SURCHAGE DES LIENS
    public function headerLien(){
        ?>
        <div>
            <?php
            if(empty($this->tab["statut"]) && $_SESSION["profile"] == "etudiant"){
                ?>
                <a href="<?=$this->lien_validation?>" class="btn btn-outline-danger btn-sm">Envoyer</a>
                <?php
            }elseif($this->tab["statut"] == "en attente de validation" && $_SESSION["profile"] == "administrateur"){
                ?>
                <a href="<?=$this->lien_confirmation?>" class="btn btn-outline-danger btn-sm">Valider</a>
                <?php
            }elseif(($this->tab["statut"] == "Stage valide" || $this->tab["statut"] == "Stage validé") && $_SESSION["profile"] != "etudiant"){
                ?>
                <a href="<?=$this->lien_devalidation?>" class="btn btn-outline-danger btn-sm">Dévalider</a>
                <?php
            }
            ?>
            <a href="<?=$this->lien_pdf?>" class="btn btn-outline-primary btn-sm">PDF</a>
            <?php if($this->tab["statut"] == "Stage valide" || $this->tab["statut"] == "Stage validé"){
                ?>
                <a href="<?=$this->lien_modification?>" class="btn btn-primary btn-sm">Consulter</a>
                <?php
            }else{
                ?>
            <a href="<?=$this->lien_modification?>" class="btn btn-primary btn-sm">Modification</a>
            <?php
            }    
            ?>
            <?php if($this->tab["statut"] != "Stage valide" && $this->tab["statut"] != "Stage validé"){
            ?>
            <a href="<?=$this->lien_suppression?>" class="btn btn-info btn-sm">Suppression</a>
            <?php
            }
            ?>
        </div>
        <?php
    }

}


 