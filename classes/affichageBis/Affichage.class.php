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
            <h3><?=$nom?></h3>
            <?php
            if (!empty($_GET["controller"])) {
                ?>
                <div>
                    <?php
                    if (!isset($_GET["id"]) && $_SESSION["profile"] == "administrateur" && $_GET["controller"] == 'stage') {
                        ?>
                        <a class="btn btn-outline-dark" href="excel/excel.php">Excel</a>
                        <?php
                    }

                    if (($_SESSION["profile"] == "etudiant") || ($_SESSION["profile"] == "administrateur" && ($_GET["controller"] == "etablissement" || $_GET["controller"] == "referent"))) {
                        ?>
                        <a class="btn btn-outline-primary" href="/Convention/index.php?controller=<?=$_GET["controller"]?>&task=show">Ajouter</a>
                        <?php
                    }        
                    ?>
                </div>
                <?php
            }
            ?>
        </div>
        <br/>
        <?php
    }

    public function select($dbh, $titre, $erreur)
    {
        $this->titre($titre);
        $offset = isOffset();

        //----RECHERCHE PAR ID-----------
        if (isset($_GET["id"]) || ($_SESSION["profile"] == "etudiant")) {

            //------PARTIE ADMIN----------
            if (isset($_GET["id"])) {
                $array = array(':id' => $_GET["id"], ':offset' => $offset);

                //------PARTIE ETUDIANTE--------
            } else {
                $array = array(':id' => $_SESSION["id"], ':offset' => $offset);
            }
            $request = $this->requestId;
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