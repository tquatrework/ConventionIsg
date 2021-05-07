<?php
namespace Affichage;

class Affichage
{

    public $dbh;
    public $titre;
    public $lien_modification;
    public $lien_suppression;
    public $ligne1;
    public $ligne2;
    public $ligne3;
    public $iconAdresse = '<i class="far fa-address-card"></i>';
    public $iconTelephone = '<i class="fas fa-phone"></i>';
    public $iconClasse = '<i class="fas fa-graduation-cap"></i>';
    public $iconBriefcase = '<i class="fas fa-briefcase"></i>';
    public $iconEntreprise = '<i class="fas fa-building"></i>';
    public $iconDate = '<i class="far fa-calendar-alt"></i>';
    public $iconUser = '<i class="fas fa-user-alt"></i>';
    public $iconEtablissement = '<i class="fas fa-school"></i> ';
    public $requestId;
    public $requestRecherche;
    public $requestAll;
    public $requestFiltreAttente;
    public $requestFiltreValide;
    public $table;

    public function card()
    {
        ?>
        <div class="col-md-9" style="padding-left:0px">
            <div class="card">

                <div class="card-header d-flex justify-content-between">
                    <?php
                    $this->headerTitre();
                    $this->headerLien();
                    ?>
                </div>

                <div class="card-body">
                    <?php
                    $this->body();
                    ?>
                </div>

            </div>
        </div>
        <?php
}

    public function headerTitre()
    {
        ?>
        <div>
            <h5><?=$this->titre;?></h5>
        </div>
        <?php
}

    public function headerLien()
    {
        ?>
        <div>
            <a href="<?=$this->lien_modification?>" class="btn btn-primary btn-sm">Modification</a>
            <a href="<?=$this->lien_suppression?>" class="btn btn-info btn-sm">Suppression</a>
        </div>
        <?php
    }

    public function body()
    {

        if (!empty($this->ligne_validation)) {
            ?>
            <p class="card-text">Etat : <?=$this->ligne_validation;?></p>
            <?php
}

        if (!empty($this->ligne1)) {
            ?>
            <p class="card-text"><?=$this->ligne1;?></p>
            <?php
}
        if (!empty($this->ligne2)) {
            ?>
            <p class="card-text"><?=$this->ligne2;?></p>
            <?php
}
        if (!empty($this->ligne3)) {
            ?>
            <p class="card-text"><?=$this->ligne3;?></p>
            <?php
}
    }

    public function titre($nom)
    {
        ?>
        <div class="row col-md-9 justify-content-between" style="padding-right:0">
            <h3 class="col-md-8" style='padding-left:0'><?=$nom?></h3>
            <?php if (!empty($_GET["controller"])): ?> 

                <?php if (!isset($_GET["id"]) && $_SESSION["profile"] == "administrateur" && strtolower(substr($_GET["controller"],0,5)) == 'stage'): ?>
                    <div class="d-flex col-md-3 justify-content-end" style="padding:0">
                        <div class="dropdown">
                            <button type="button" class="btn btn-outline-info dropdown-toogle mr-1" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Filtre</button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="index.php?task=liste&controller=stage&filtre=enAttente">En attente de validation</a>
                                <a class="dropdown-item" href="index.php?task=liste&controller=stage&filtre=valide">Stage validé</a>
                                <a class="dropdown-item" href="index.php?task=liste&controller=stage">Tout les stages</a>
                            </div>
                        </div>
                        <div class="dropdown show">
                            <a href="excel/excel.php" class="btn btn-outline-dark">Excel</a>
                        </div>
                    </div>

                <?php elseif (($_SESSION["profile"] == "etudiant" && $_GET["controller"] != "entreprise")  || ($_SESSION["profile"] == "administrateur" && ($_GET["controller"] == "etablissement" || $_GET["controller"] == "referent"))): ?>
                    <div class="d-flex col-md-3 justify-content-end" style="padding:0">
                        <a class="btn btn-outline-primary" href="/Convention/index.php?controller=<?=$_GET["controller"]?>&task=show">Ajouter</a>
                    </div>

                <?php elseif ( $_GET["controller"] == "entreprise" ): ?>
                    <?php if ($_SESSION["profile"] == "administrateur"): ?>
                        <div class="d-flex col-md-3 justify-content-end" style="padding:0">
                    <?php elseif ($_SESSION["profile"] == "etudiant"): ?>
                        <div class="d-flex col-md-3 justify-content-between" style="padding:0">
                    <?php endif; ?>  
                    <?php if($_SESSION["profile"] != "etudiant"): ?>
                        <div class="dropdown">
                            <button type="button" class="btn btn-outline-info dropdown-toogle mr-1" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Filtre</button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <?php if ($_SESSION["profile"] == "etudiant"): ?>
                                    <a class="dropdown-item" href="index.php?task=liste&controller=entreprise">Mes entreprises</a>
                                    <a class="dropdown-item" href="index.php?task=liste&controller=entreprise&filtre=permanente">Entreprises permanentes</a>
                                <?php elseif ($_SESSION["profile"] == "administrateur"): ?>    
                                    <a class="dropdown-item" href="index.php?task=liste&controller=entreprise&filtre=permanente">Permanente</a>
                                    <a class="dropdown-item" href="index.php?task=liste&controller=entreprise">Toutes les entreprises</a>
                                <?php endif ; ?>    
                            </div>
                        </div>
                    <?php   endif;?> 
                    <?php //if( $_SESSION["profile"] == "etudiant"): ?>
                            <!--<div class="dropdown show">
                                <a class="btn btn-outline-primary" href="/Convention/index.php?controller=<?=$_GET["controller"]?>&task=show">Ajouter</a>
                            </div>-->
                    <?php //endif; ?>
                </div>
                <?php endif; ?>

            <?php endif; ?>
        </div>
        <br/>
        <?php
    }

    public function select($dbh, $titre, $erreur)
    {
        $this->titre($titre);
        $offset = isOffset();

        //------RECHERCHE PAR FILTRE----------
        if(isset($_GET["filtre"])){
            if($_GET["filtre"] == "enAttente"){
                $request = $this->requestFiltreAttente;
            }elseif($_GET["filtre"] == "valide"){
                $request = $this->requestFiltreValide;
            }elseif($_GET["filtre"] == "permanente"){
                $request = $this->requestFiltrePermanente;
            }
            $array = array(':offset' => $offset);
            //----RECHERCHE PAR ID-----------
        }elseif(isset($_GET["id"]) || ($_SESSION["profile"] == "etudiant")) {

            //------PARTIE ADMIN----------
            if (isset($_GET["id"]) && $_SESSION["profile"] != "etudiant") {
                $array = array(':id' => $_GET["id"], ':offset' => $offset);
                $request = $this->requestId;

                //------PARTIE ETUDIANTE--------
            } else {
                
                //-----SELECT AVEC LA BARRE DE RECHERCHE-------

                if ((!empty($_POST["recherche"])) || (!empty($_GET["recherche"]))) {
                    $recherche = varRecherche();
                    if(isset($_GET["id"]) ){
                        $array = array(':id' => $_SESSION["id"], ':recherche' => $recherche, ':offset' => $offset);
                        $request = $this->requestRechercheEntrepriseEtudiant;
                    }
                    else
                    {
                        $array = array(':recherche' => $recherche, ':offset' => $offset);
                        $request = $this->requestRecherche;
                    }
                    //----SELECT ALL-------
                }
                elseif($_GET["controller"] == "entreprise"){
                    $array = array(':id' => $_SESSION["id"], ':offset' => $offset);
                    //$array = array(':id_utilisateur' => $_SESSION["id"], ':offset' => $offset);
                    //$array = array(':offset' => $offset);
                    //$request = $this->requestEtudiant;
                    $request = $this->requestId;
                }else{
                    $array = array(':id' => $_SESSION["id"], ':offset' => $offset);
                    $request = $this->requestId;                }
            }
        } else {

            //-----SELECT AVEC LA BARRE DE RECHERCHE--------
            if ((!empty($_POST["recherche"])) || (!empty($_GET["recherche"]))) {
                $recherche = varRecherche();
                $array = array(':recherche' => $recherche, ':offset' => $offset);
                $request = $this->requestRecherche;

                //----SELECT ALL-------
            } else {
                $request = $this->requestAll;
                $array = array(':offset' => $offset);
            }
        }
        $tabResult = requestRecherche($dbh, $request, $erreur, $array);

        return $tabResult;
    }

    public function reset()
    {
        $this->titre = "";
        $this->ligne_validation = "";
        $this->ligne1 = "";
        $this->ligne2 = "";
        $this->ligne3 = "";
        $this->lien_suppression = "";
        $this->lien_modification = "";
    }

    public function affiche($tab, $ligne, $icon, $tab1 = "", $tab2 = "", $tab3 = "", $tab4 = "")
    {
        $tableau = array($tab1, $tab2, $tab3, $tab4);
        $string = "";
        $bool = 0;
        foreach ($tableau as $value) {
            if (!empty($tab[$value])) {
                $string .= $tab[$value] . " ";
                $bool++;
            }
        }
        if ($bool > 0) {
            if (!empty($icon)) {
                $this->$ligne = $this->$icon . " " . $string;
            } else {
                $this->$ligne = $string;
            }
        }
    }
}