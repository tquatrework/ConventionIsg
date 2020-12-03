<?php
namespace Navigation;
use \PDO;
class Navigation{
    
    protected $linkStagiaire;
    protected $linkEntreprise;
    protected $linkStage;
    protected $linkTuteur;
    protected $linkEtablissement;
    protected $linkReferent;
    protected $administration;
    protected $entreprise = "/entreprise.php";
    protected $stage = "/stage.php";
    protected $tuteur = "/tuteur.php"; 
    protected $etablissement = "/liste_etablissement.php";
    protected $referent = "/liste_referent.php";
    protected $page;

    public function __construct($file = ""){
       
        //-------ADMINISTRATEUR-------------
        if($_SESSION["profile"] == "administrateur"){
 
            //Si ID existe, alors l'onglet stagiaire reste actif
            if(!empty($_GET["id"])){
                $this->linkStagiaire = "active";
                
            //Sinon on active les onglets dependant de la page                
            }else{
                if($_GET["controller"] == "stagiaire"){
                    $this->linkStagiaire = "active";
                }elseif($_GET["controller"] == "entreprise"){
                    $this->linkEntreprise = "active";
                }elseif($_GET["controller"] == "tuteur" ){
                    $this->linkTuteur ="active";
                }elseif($_GET["controller"] == "stage" || $_GET["controller"] == "stage_pbm"){
                    $this->linkStage = "active";
                }elseif($_GET["controller"] == "etablissement"){
                    $this->linkEtablissement ="active";
                }elseif($_GET["controller"] == "referent"){
                    $this->linkReferent = "active";
                }
            }

            $this->nav();
            if(empty($_GET["id"])){
                rechercher();
            }
        }
    }
    
    public function nav(){
        ?>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link <?=$this->linkStagiaire?>" href="/Convention/index.php?task=liste&controller=stagiaire">Stagiaire</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?=$this->linkEntreprise?>" href="/Convention/index.php?task=liste&controller=entreprise">Entreprise</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?=$this->linkTuteur?>" href="/Convention/index.php?task=liste&controller=tuteur">Tuteur</a>
            </li>
            <li class="nav-item">
                <div> <!-- class="dropdown show"> -->
                    <a class="btn dropdown-toggle nav-link <?=$this->linkStage?>" data-toggle="dropdown" href="#" role="button">Stage <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/Convention/index.php?task=liste&controller=Stage">Stage MscMba</a></li>
                        <li><a href="/Convention/index.php?task=liste&controller=Stage_pbm">Stage Pbm</a></li>
                    </ul>
                <!-- <a class="nav-link <?=$this->linkStage?>" href="/Convention/index.php?controller=stage&task=liste&id=<?=$this->id?>">Stage</a> -->
                </div>
            </li>
            </li>
            <li class="nav-item">
                <a class="nav-link <?=$this->linkEtablissement?>" href="/Convention/index.php?task=liste&controller=etablissement">Etablissement</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?=$this->linkReferent?>" href="/Convention/index.php?task=liste&controller=referent">Référent</a>
            </li>
        </ul>
        <br/>

<?php
    }

}