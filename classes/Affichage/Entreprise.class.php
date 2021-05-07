<?php
namespace Affichage;
use \PDO;
class Entreprise extends Affichage{
 
    public $requestFiltrePermanente;
    public $lien_permanente;
    public $lien_non_permanente;

    public function __construct($dbh){

        //----------SELECT SI GET-------------
        $this->requestId = 'SELECT * FROM entreprise WHERE fk_utilisateur_entreprise = :id ORDER BY nom_entreprise LIMIT 5 OFFSET :offset';
        $this->requestRecherche = 'SELECT * FROM entreprise WHERE nom_entreprise LIKE CONCAT("%",:recherche,"%") ORDER BY nom_entreprise LIMIT 5 OFFSET :offset';
        $this->requestAll = 'SELECT * FROM entreprise ORDER BY nom_entreprise LIMIT 5 OFFSET :offset';
        $this->requestFiltrePermanente = 'SELECT * FROM entreprise WHERE statut_entreprise = "permanente" LIMIT 5 OFFSET :offset';
        //$this->requestRechercheEntrepriseEtudiant= 'SELECT * FROM entreprise WHERE fk_utilisateur_entreprise = :id AND nom_entreprise LIKE CONCAT("%",:recherche,"%") ORDER BY nom_entreprise LIMIT 5 OFFSET :offset';
        $this->requestRechercheEntrepriseEtudiant= 'SELECT * FROM entreprise WHERE (statut_entreprise = "permanente" OR fk_utilisateur_entreprise = :id) AND nom_entreprise LIKE CONCAT("%",:recherche,"%") ORDER BY nom_entreprise LIMIT 5 OFFSET :offset';
        $tabResult = $this->select($dbh,"Liste des entreprises","Aucune entreprise");

        //---------AFFICHAGE---------------- 
        if(is_array($tabResult) && !empty($tabResult)){
            foreach($tabResult as $tab){
                $this->tab = $tab;
                $this->affiche($tab,"titre","","nom_entreprise");
                $this->affiche($tab,"ligne1","iconAdresse","numero_rue_entreprise","adresse_entreprise","code_postal_entreprise","ville_entreprise");
                $this->affiche($tab,"ligne2","iconTelephone","telephone_entreprise");
                $this->affiche($tab,"ligne3","iconBriefcase",'secteur_activite_entreprise');
                $this->lien_suppression = "index.php?id_entreprise=".$tab['id_entreprise']."&controller=entreprise&task=supprimer&token=".$_SESSION["token"];
                if(isset($_GET["id"])){
                    $this->lien_modification = "index.php?id_entreprise=".$tab['id_entreprise']."&id=".$_GET["id"]."&controller=entreprise&task=show";
                }else{
                    $this->lien_modification = "index.php?id_entreprise=".$tab['id_entreprise']."&task=show&controller=entreprise";
                }
                $offset = \Utils::offsetLien();
                if(!empty($_GET["filtre"])){
                    if($_GET["filtre"] == "permanente"){
                        $filtre = "&filtre=".$_GET["filtre"];
                    }else{
                        $filtre = "";
                    }
                }else{
                    $filtre = "";
                }
                $this->lien_permanente = "index.php?id_entreprise=".$tab["id_entreprise"]."&task=permanente&controller=entreprise$offset$filtre";
                $this->lien_non_permanente = "index.php?id_entreprise=".$tab["id_entreprise"]."&task=nonPermanente&controller=entreprise$offset$filtre";
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
            <?php if ($_SESSION["profile"] == "administrateur"): ?>
                <?php if(empty($this->tab["statut"])): ?>
                    <a href="<?=$this->lien_permanente?>" class="btn btn-outline-danger btn-sm">Permanente</a>
                <?php elseif ($this->tab["statut"] == "permanente"): ?>
                    <a href="<?=$this->lien_non_permanente?>" class="btn btn-danger btn-sm">Permanente</a>
                <?php endif; ?>    
            <?php endif; ?>
            <?php if (($this->tab["statut"] == "permanente" && $_SESSION["profile"] == "etudiant")): ?>
                <a href="<?=$this->lien_modification?>" class="btn btn-primary btn-sm">Consulter</a>
            <?php else: ?>
                <a href="<?=$this->lien_modification?>" class="btn btn-primary btn-sm">Modification</a>
                <a href="<?=$this->lien_suppression?>" class="btn btn-info btn-sm">Suppression</a>
            <?php endif; ?>    
        </div>
        <?php
    }
}


