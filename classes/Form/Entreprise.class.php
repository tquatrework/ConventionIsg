<?php
namespace Form;
use \PDO;
class Entreprise extends Form{

    public function __construct($dbh){

        $bool = $this->logique($dbh);

        //Affichage
        if($bool == 1){
            ?>
            
            <!-- Titre -->
            <h3><?=$this->titre_form?> entreprise</h3>
            <!-- Formulaire -->
            <form action="" method="post" class="needs-validation" novalidate>
                <?php
                $this->nomEntreprise();
                $this->adresse();
                $this->secteurActivite(8);
                ?>
                <hr/>
                <h6>Représentant</h6>
                <?php
                $this->representant();
                if($_SESSION["profile"] == "administrateur"){
                    $this->button();
                }elseif($_SESSION["profile"] == "etudiant"){
                    if($this->tab["statut"] == "permanente"){
                        ?>
                            <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" class="btn btn-secondary">Retour</a>
                        <?php
                    }else{
                        $this->button();
                    }
                }
                ?>
            </form>
            <?php     
        }
    }

    public function secteurActivite($col = 4){
        ?>
        <div class="form-row">
            <div class="form-group col-md-<?=$col?>">
                <label for="secteur_activite_entreprise">Secteur d'activité</label>
                <select class="form-control" required style="background-color:#e8f0ff" name="secteur_activite_entreprise" id="secteur_activite_entreprise">
                    <option value="<?=$this->tab["secteur_activite_entreprise"]?>"><?=$this->tab["secteur_activite_entreprise"];?></option>
                    <option value="Assurance, Banques et Organisme Financiers, Locations et Leasing">Assurance, Banques et Organisme Financiers, Locations et Leasing</option>
                    <option value="Autres Activité d'Etudes, de conseil et d'Assistance, R&D">Autres Activité d'Etudes, de conseil et d'Assistance, R&D</option>
                    <option value="Bâtiment, Génie Civil et Agricole">Bâtiment, Génie Civil et Agricole</option>
                    <option value="Cabinet d'Expertise Comptable, d'Audit, d'Analyse Financière">Cabinet d'Expertise Comptable, d'Audit, d'Analyse Financière</option>
                    <option value="Commerce, Distribution">Commerce, Distribution</option>
                    <option value="Communication, Publicité, Régie Publicitaire, Relations Publiques">Communication, Publicité, Régie Publicitaire, Relations Publiques</option>
                    <option value="Construction Automobile, de Matériels, de Transport Terrestre, Construction Navale, Aéronautique et Armement">Construction Automobile, de Matériels, de Transport Terrestre, Construction Navale, Aéronautique et Armement</option>
                    <option value="Edition, Imprimerie, Média, Presse">Edition, Imprimerie, Média, Presse</option>
                    <option value="Industrie Agro-alimentaire, Boissons, Vins et Spiritueux">Industrie Agro-alimentaire, Boissons, Vins et Spiritueux</option>
                    <option value="Industrie Mécanique, Electrique, Electronique">Industrie Mécanique, Electrique, Electronique</option>
                    <option value="Industrie textile, Habillement, Cuir, Chaussures, Orfèvrerie, Horlogerie">Industrie textile, Habillement, Cuir, Chaussures, Orfèvrerie, Horlogerie</option>
                    <option value="Industrie Diverses">Industrie Diverses</option>
                    <option value="Parachimie et Industrie Pharmaceutique, Cosmétiques">Parachimie et Industrie Pharmaceutique, Cosmétiques</option>
                    <option value="Promoteurs et Professions Immobilières">Promoteurs et Professions Immobilières</option>
                    <option value="Services divers et collectifs, NTIC">Services divers et collectifs, NTIC</option>
                    <option value="Tourisme et Loisirs, Hôtellerie, Restauration">Tourisme et Loisirs, Hôtellerie, Restauration</option>
                    <option value="Transports, Electricité, Postes et Télécommunications">Transports, Electricité, Postes et Télécommunications</option>
                    <option value="Autres">Autres</option>
                </select>
            </div>
        </div>
        <?php
    }

    public function service(){
        ?>
        <div class="form-row">
            <?php
            $this->formGroup("Service dans lequel le stage sera effectué",$this->tab["services_entreprise"],"services_entreprise","text",5);
            ?>
        </div>
        <?php
    }

    public function nomEntreprise(){
        ?>
        <div class="form-row">
            <?php
            $this->formGroup("La société ou organisme d'accueil",$this->tab["nom_entreprise"],"nom_entreprise","text");
            ?>
        </div>
        <?php
    }

    public function fermeture(){
        if($this->tab["fermeture_entreprise"] == "on"){
            $checkedOui = "checked";
            $checkedNon = "";
            $hidden = "";
        }elseif($this->tab["fermeture_entreprise"] == "off"){
            $checkedOui = "";
            $checkedNon = "checked";
            $hidden = "hidden";
        }else{
            $checkedOui = "";
            $checkedNon = "";
            $hidden = "hidden";
        }
        ?>
        <div class="form-row">
            <?php
                $this->boutonRadio("oui","on","fermeture_entreprise","fermeture_oui",$checkedOui);
                $this->boutonRadio("non","off","fermeture_entreprise","fermeture_non",$checkedNon);
            ?>
        </div>
        <div class="form-row">
            <?php
            $this->formGroup("Date début fermeture",$this->tab["date_debut_fermeture_entreprise"],"date_debut_fermeture_entreprise","text",4,$hidden,"date_debut_fermeture_entreprise");
            $this->formGroup("Date fin fermeture",$this->tab["date_fin_fermeture_entreprise"],"date_fin_fermeture_entreprise","text",4,$hidden,"date_fin_fermeture_entreprise");
            ?>
        </div>
        <?php
    }

    public function lieuDifferent(){
        if($this->tab["lieu_bis_bool"] == "on"){
            $checkedOui = "checked";
            $checkedNon = "";
            $hidden = "";
        }elseif($this->tab["lieu_bis_bool"] == "off"){
            $checkedOui = "";
            $checkedNon = "checked";
            $hidden = "hidden";
        }else{
            $checkedOui = "";
            $checkedNon = ""     ;
            $hidden = "hidden";
        }
        ?>
        <div class="form-row">
            <?php
            $this->boutonRadio("oui","on","lieu_bis_bool","lieu_bis_oui",$checkedOui);
            $this->boutonRadio("non","off","lieu_bis_bool","lieu_bis_non",$checkedNon);
            ?>
        </div>
        <div class="form-row">
            <div class="form-group col-md-8">
                <label <?=$hidden?> id="label_lieu_bis_entreprise">Lieu du stage</label>
                <input  <?=$hidden?> class="form-control" style="background-color:#e8f0ff" type="text" name="lieu_bis_entreprise" id="input_lieu_bis_entreprise" value="<?=$this->tab["lieu_bis_entreprise"];?>">
            </div>
        </div>
        <?php
    }
}

