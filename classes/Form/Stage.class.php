<?php
namespace Form;
use \PDO;
class Stage extends Form{
   
    public function __construct($dbh){
	
        //Initialisation
        //$this->page = "stagiaire";
        //$this->idPage = "id_stagiaire";
        //$this->tab = $this->fetchStagiaire($dbh);

        //Update ou Insert
        //$this->id();
        //$this->logic($dbh,",id_stagiaire",",".$this->id);

        $this->page = $_GET["controller"];
        $this->id();
        if(isset($_GET["id_".$this->page])){
            if(isset($_POST["envoi_".$this->page])){

                if(empty($_POST["fk_tuteur_stage"]) || empty($_POST["fk_referent_stage"])){
                    echo "<div class='alert alert-danger col-md-auto d-inline-block'>Veillez remplir les champs Référent et/ou Tuteur</div>";
                }else{
                    $this->update($dbh);
                }
            }
            
            $bool = 1;
            $this->titre_form = "Modification";
            $this->tab = $this->fetchTable($dbh);
            
        }else{
            
            if(isset($_POST["envoi_".$this->page])){
                
                if(empty($_POST["fk_tuteur_stage"]) || empty($_POST["fk_referent_stage"])){
                    echo "<div class='alert alert-danger col-md-auto d-inline-block'>Veillez remplir les champs Référent et/ou Tuteur</div>";
                }else{
                    $this->insert($dbh,",fk_utilisateur_".$this->page,",".$this->id);
                }
                $bool = 0;
            }else{
                $bool = 1;
                $this->titre_form = "Ajout";
            }

        }


        if($bool == 1){
            ?>
            <h3><?=$this->titre_form?> stage</h3>
            <form action="" method="post"  novalidate>
                <div class="form-row">
                    <?php
                    $this->anneeUniversitaire();
                    ?>
                </div>
                <div class="form-row">
                    <?php
                    $this->etablissement($dbh);
                    $this->referent($dbh);
                    ?>
                </div>
                <div class="form-row">
                    <?php
                    $this->entreprise($dbh);
                    $this->tuteur($dbh);
                    ?>
                </div>
                    <?php
                    $this->dateDebutFin();
                    $this->dureeSemaineMois();
                    $this->dureeTotale();
                    $this->dureeDiscontinue();
                    #$this->repartitionSiDiscontinue();
                    $this->commentaireDuree();
                    ?>
                </div>

                <br/>
                <div class="form-row col-md-8 justify-content-between" style="padding-left:0;padding-right:0">
                    <?php
                    $this->obligatoireOptionnel();
                    $this->completPartiel();
                    ?>
                </div>
                <?php
                echo "<br/>";
                $this->heurePartiel();
                echo "<br/>";
                $this->jourPresence();
                echo "<br/>";
                $this->casParticulier();
                $this->service();
                $this->lieuDifferent();
                $this->fermeture();
                $this->teletravail();
                $this->gratification();
                $this->conditionRemboursement(); 
                $this->droitAvantage();
                $this->modaliteConge();
                ?>
                <hr/>
                <h4>Objectifs du stage</h4>
                <?php
                $this->activiteMission();
                $this->competence();
                echo "<br/>";
                $this->button();
                ?>
            </form>
            <?php
        }
    }
    
    public function fermeture(){
        $tab = $this->ifCheck($this->tab["fermeture_entreprise"],"on","off");
        $checkedOui = $tab[0];
        $checkedNon = $tab[1];
        $hidden = $tab[2];
        ?>
        <div class="form-row">
            <label class="col-md-8">
                L'entreprise ferme t-elle pendant le stage ?
            </label>

            <div class="btn-group btn-group-toggle col-md-8" data-toggle="buttons" style="vertical-align:top">
                <?php
                    $this->checkbox("oui","on",$checkedOui,"fermeture_entreprise","fermeture_oui","radio");
                    $this->checkbox("non","off",$checkedNon,"fermeture_entreprise","fermeture_non","radio");
                ?>
            </div>
        </div>

        <br/>

        <div class="form-row">
            <?php
            $this->formGroup("Date début fermeture",$this->tab["date_debut_fermeture_entreprise"],"date_debut_fermeture_entreprise","text",4,$hidden,"date_debut_fermeture_entreprise");
            $this->formGroup("Date fin fermeture",$this->tab["date_fin_fermeture_entreprise"],"date_fin_fermeture_entreprise","text",4,$hidden,"date_fin_fermeture_entreprise");
            ?>
        </div>
        <?php
    }

    public function lieuDifferent(){
        $tab = $this->ifCheck($this->tab["lieu_bis_bool"],"on","off");
        $checkedOui = $tab[0];
        $checkedNon = $tab[1];
        $hidden = $tab[2];
        ?>

        <div class="form-row">
            <label class="col-md-8">
                Lieu du stage différent de l'adresse de la société ou de l'organisme d'accueil ?
            </label>

            <div class="btn-group btn-group-toggle col-md-8" data-toggle="buttons" style="vertical-align:top">
                <?php
                $this->checkbox("oui","on",$checkedOui,"lieu_bis_bool","lieu_bis_oui","radio");
                $this->checkbox("non","off",$checkedNon,"lieu_bis_bool","lieu_bis_non","radio");
                ?>
            </div>
        </div>

        <br/>

        <div class="form-row">
            <div class="form-group col-md-8">
                <label <?=$hidden?> id="label_lieu_bis_entreprise">Lieu du stage</label>
                <input  <?=$hidden?> class="form-control" style="background-color:#e8f0ff" type="text" name="lieu_bis_entreprise" id="input_lieu_bis_entreprise" value="<?=$this->tab["lieu_bis_entreprise"];?>">
            </div>
        </div>
        <?php
    }

    public function teletravail(){
        $tab = $this->ifCheck($this->tab["teletravail"],"oui","non");
        $checkedOui = $tab[0];
        $checkedNon = $tab[1];
        ?>
        <div class="form-row">

            <label for="" class="col-md-8">
                Le stage peut partiellement se dérouler en télétravail ?
            </label>

            <div class="btn-group btn-group-toggle col-md-8" data-toggle="buttons" style="vertical-align:top">
                <?php
                $this->checkbox("oui","oui",$checkedOui,"teletravail","teletravail_oui","radio");
                $this->checkbox("non","non",$checkedNon,"teletravail","teletravail_non","radio");
                ?>
            </div>
        </div>
        <br/>
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

    public function anneeUniversitaire(){
         ?>
	    <?php
	    $idAnnee = $this->tab["annee_universitaire"];
	    $tabAnnee = array("2019-20","2020-21","2021-22","2022-23");
	    ?>
	    <div class="form-group col-md-4 ">

            	<label for="annee_universitaire">Année Universitaire</label>
            	<select name="annee_universitaire" id="annee_universitaire" onchange="showReferent(this.value)" required class="form-control" style="background-color:#e8f0ff">
		<option value=""></option>
                <?php
			foreach ($tabAnnee as $value) {
				$selected = $this->selected($idAnnee,$value);
				echo $selected;
				?>
		       	    	<option <?=$selected?> value="<?=$value?>"><?=$value?></option>
				<?php
		    	}
			?>				
            	</select>
	    </div>
         <?php
    }


    public function etablissement($dbh){

        $idEtablissement = $this->requestFk($dbh,"fk_enseignement_referent","referent","id_referent",$this->tab["fk_referent_stage"],"fk_enseignement_referent");
        $request ='SELECT * FROM etablissement';
        $array = array('');
        $tabEtablissement = $this->tryPrepareAll($dbh,$request,$array,true);

        ?>
        <div class="form-group col-md-4 ">
        <label for="etablissement">Etablissement</label>
            <select onchange="showReferent(this.value)" required class="form-control" style="background-color:#e8f0ff">
                <option value=""></option>
                <?php
                foreach ($tabEtablissement as $key => $value) {
                    
                    $selected = $this->selected($idEtablissement,$value["id_etablissement"]);
                    ?>
                    <option <?=$selected?> value="<?=$value['id_etablissement']?>"><?=$value["nom_etablissement"]?></option>
                    <?php
                }
                ?>
            </select> 
        </div>
        <?php
    }
    
    public function referent($dbh){

        $idEtablissement = $this->requestFk($dbh,"fk_enseignement_referent","referent","id_referent",$this->tab["fk_referent_stage"],"fk_enseignement_referent");
        $request = 'SELECT * FROM referent WHERE fk_enseignement_referent = :id';
        $array = array(':id'=>$idEtablissement);
        $tabReferent = $this->tryPrepareAll($dbh,$request,$array,true);

        ?>
        <div  class="form-group col-md-4">
            <label>Référent</label>
            <select id="ajaxReferent" required name="fk_referent_stage" class="form-control" style="background-color:#e8f0ff">
                <option value=""></option>
                <?php
                foreach($tabReferent as $key=>$value){

                    $selected = $this->selected($this->tab["fk_referent_stage"],$value["id_referent"]);
                    ?>
                    <option <?=$selected?> value="<?=$value['id_referent']?>"><?=$value["nom_referent"].' '.$value["prenom_referent"]?></option>;
                    <?php

                }
                ?>
            </select>
        </div>
        <?php
    }

    public function entreprise($dbh){

        $idEntreprise = $this->requestFk($dbh,"fk_entreprise","tuteur","id_tuteur",$this->tab["fk_tuteur_stage"],"fk_entreprise");
        $request = 'SELECT * FROM entreprise WHERE fk_utilisateur_entreprise = :id';
        if($_SESSION["profile"] == "administrateur" && empty($_GET["id"])){
            $id = $this->tab["fk_utilisateur_stage"];
        }else{
            $id = $this->id;
        }
        $array = array(':id'=>$id);
        $tabEntreprise = $this->tryPrepareAll($dbh,$request,$array,true);

        ?>
        <div class="form-group col-md-4">
        <label for="entreprise">Entreprise</label>
            <select onchange="showTuteur(this.value)" required class="form-control" style="background-color:#e8f0ff">
                <option value=""></option>
                <?php
                foreach ($tabEntreprise as $key => $value) {
                    
                    $selected = $this->selected($idEntreprise,$value["id_entreprise"]);
                    ?>
                    <option <?=$selected?> value="<?=$value['id_entreprise']?>"><?=$value["nom_entreprise"]?></option>;
                    <?php

                }
                ?>
            </select> 
        </div>
        <?php
    }
    
    public function Tuteur($dbh){

        $idEntreprise = $this->requestFk($dbh,"fk_entreprise","tuteur","id_tuteur",$this->tab["fk_tuteur_stage"],"fk_entreprise");
        $request = 'SELECT * FROM tuteur WHERE  fk_entreprise = :id';
        $array = array(':id'=>$idEntreprise);
        $tabTuteur = $this->tryPrepareAll($dbh,$request,$array,true);

        ?>
        <div class="form-group col-md-4">
            <label>Tuteur</label>
            <select id="ajaxTuteur" name="fk_tuteur_stage" required class="form-control" style="background-color:#e8f0ff">
                <option value=""></option>
                <?php foreach($tabTuteur as $key => $value){

                    $selected = $this->selected($this->tab["fk_tuteur_stage"],$value["id_tuteur"]);
                    ?>
                    <option <?=$selected?> value="<?=$value["id_tuteur"]?>"><?=$value["nom_tuteur"]." ".$value["prenom_tuteur"]?></option>;
                    <?php

                }
                ?>
            </select>
        </div>
        <?php
    }

    public function dateDebutFin(){
        ?>
        <div class="form-row">
            <?php
            $this->formGroup("Du",$this->tab["date_debut"],"date_debut","text");
            $this->formGroup("au",$this->tab["date_fin"],"date_fin","text");
            ?>
        </div>
        <?php
    }

    public function dureeTotale(){
        ?>
        <div class="form-row">
            <label for="duree_totale" class="col-sm-7 col-form-label">Durée totale du stage en nombre d'heures de présence effective par semaine</label>
            <div class="col-sm-1">
                <input type="number" value="<?=$this->tab["duree_totale"]?>" class="form-control" style="background-color:#e8f0ff" min="0" name="duree_totale" id="duree_totale">
            </div>
        </div>
        <?php
    }

    public function dureeSemaineMois(){
        if($this->tab["duree_totale_de"] == "semaines"){
            $checkedSemaines = "checked";
            $checkedMois = "";
        }elseif($this->tab["duree_totale_de"] == "mois"){
            $checkedSemaines = "";
            $checkedMois = "checked";
        }else{
            $checkedSemaines = "";
            $checkedMois = "";
        }
        ?>
         <div class='form-group'>
            <label>Durée totale du stage :</label>
            <div class="input-group">

                <input class="form-control col-md-2" type="number" required min="0" name="duree_semaine_mois" value="<?=$this->tab["duree_semaine_mois"]?>" aria-describedby="basic-addon2" />

                <span style="margin:10px">en nombre </span>

                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <?php
                    $this->checkbox("de semaines","semaine",$checkedSemaines,"duree_totale_de","duree_totale_par_semaine","radio");
                    $this->checkbox("de mois","mois",$checkedMois,"duree_totale_de","duree_totale_par_mois","radio");
                    ?>
                </div>

            </div>
        </div>
        <?php
    }

    public function dureeDiscontinue(){
        if($this->tab["duree_dicontinue_par"] == "semaine"){
            $checkedSemaine = "checked";
            $checkedJour = "";
        }elseif($this->tab["duree_discontinue_par"] == "jour"){
            $checkedSemaine = "";
            $checkedJour = "checked";
        }else{
            $checkedSemaine = "";
            $checkedJour = "";
        }
        ?>
         <div class='form-group'>
            <label>Répartition si présence discontinue :</label>
            <div class="input-group">

                <input class="form-control col-md-2" type="number" required min="0" name="duree_discontinue" value="<?=$this->tab["duree_discontinue"]?>" aria-describedby="basic-addon2" />

                <span style="margin:10px"> heures </span>

                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <?php
                    $this->checkbox("par semaine","semaine",$checkedHeure,"duree_discontinue_par","duree_discontinue_par_semaine","radio");
                    $this->checkbox("par jour","jour",$checkedJour,"duree_discontinue_par","duree_discontinue_par_jour","radio");
                    ?>
                </div>


            </div>
        </div>
        <?php
    }

    public function commentaireDuree(){
        ?>
        <div class="form-row">
            <?php
            $this->textArea("Commentaires","commentaire_duree","commentaire_duree",$this->tab["commentaire_duree"],"commentaire_duree");
            ?>
        </div>
        <?php
    }

    public function obligatoireOptionnel(){
        $tab = $this->ifCheck($this->tab["obligatoire"],"obligatoire","optionnel");
        $checkedObligatoire = $tab[0];
        $checkedOptionnel = $tab[1];
        ?>
        <div class="btn-group btn-group-toggle" data-toggle="buttons">
            <?php
            $this->checkbox("Stage obligatoire","obligatoire",$checkedObligatoire,"obligatoire","obligatoire","radio");
            $this->checkbox("Stage optionnel","optionnel",$checkedOptionnel,"obligatoire","optionnel","radio");
            ?>
        </div>
        <?php
    }

    public function completPartiel(){
        $tab = $this->ifCheck($this->tab["temps_complet"],"complet","partiel");
        $checkedComplet = $tab[0];
        $checkedPartiel = $tab[1];
        ?>
        <div class="btn-group btn-group-toggle" data-toggle="buttons">
            <?php
            $this->checkbox("Temps complet","complet",$checkedComplet,"temps_complet","complet","radio");
            $this->checkbox("Temps partiel","partiel",$checkedPartiel,"temps_complet","partiel","radio");
            ?>
        </div>
        <?php
    }

    public function heurePartiel(){
        if($this->tab["temps_complet"] == "complet" || empty($this->tab["temps_complet"]) ){
            $hidden = "hidden";
        }else{
            $hidden = "";
        }
        ?>
        <div class="form-row">
            <label for="heure_partiel" class="col-sm-4 col-form-label" <?= $hidden ?>>Veuillez préciser le nombre d'heures</label>
            <div class="col-sm-2">
                <input type="number" value="<?=$this->tab["heure_partiel"]?>" class="form-control" <?= $hidden ?> style="background-color:#e8f0ff" min="0" name="heure_partiel" id="heure_partiel">
            </div>
        </div>
        <?php
    }

    public function jourPresence(){
        ?>
        <label>Jour de présence :</label>
        <div class="form-row">
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <?php
                $array = array("lundi","mardi","mercredi","jeudi","vendredi","samedi");
                foreach($array as $value){
                    if(isset($_GET["id_stage"])){
                        if($value == $this->tab[$value]){
                            $check = "checked";
                        }else{
                            $check = "";
                        }
                            $this->checkbox(ucfirst($value),$value,$check,$value,$value,"checkbox");
                    }else{
                        $this->checkbox(ucfirst($value),$value,"",$value,$value,"checkbox");
                    }

                }
                ?>
            </div>
        </div>
        <?php
    }

    public function casParticulier(){
        $tab = $this->ifCheck($this->tab["cas_particulier_booleen"],"oui","non");
        $checkedOui = $tab[0];
        $checkedNon = $tab[1];
        $hidden = $tab[2];
        ?>
        <div class="col-md-8" style="padding-left:0;padding-right:0">
            <label class="col-md-9" style="padding-left:0;padding-right:0">Le STAGIAIRE doit-il être présent dans l'ENTREPRISE la nuit, le dimanche, jour férié...?</label>
            <div class="btn-group btn-group-toggle col-md-2" data-toggle="buttons" style="vertical-align:top">
                <?php
                $this->checkbox("oui","oui",$checkedOui,"cas_particulier_booleen","cas_particulier_booleen_oui","radio");
                $this->checkbox("non","non",$checkedNon,"cas_particulier_booleen","cas_particulier_booleen_non","radio");
                ?>
            </div>
        </div>
        <div class='form-row'>
            <?php
            $this->textArea("Préciser les cas particuliers","cas_particulier","cas_particulier",$this->tab["cas_particulier"],"text_cas_particulier",$hidden);
            ?>
        </div>
        <?php
    }

    public function gratification(){
        if($this->tab["gratification_par"] == "heure"){
            $checkedHeure = "checked";
            $checkedJour = "";
            $checkedMois = "";
        }elseif($this->tab["gratification_par"] == "jour"){
            $checkedHeure = "";
            $checkedJour = "checked";
            $checkedMois = "";
        }elseif($this->tab["gratification_par"] == "mois"){
            $checkedHeure = "";
            $checkedJour = "";
            $checkedMois = "checked";
        }else{
            $checkedHeure = "";
            $checkedJour = "";
            $checkedMois = "";
        }
        ?>
        <div class='form-group'>
            <label>Le montant de la gratification est fixé à :</label>
            <div class="input-group">

                <input class="form-control col-md-2" type="number" required min="0" step="0.01" name="gratification" value="<?=$this->tab["gratification"]?>" aria-describedby="basic-addon2" />
                <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2">€</span>
                </div>

                <span style="margin:10px">par</span>

                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <?php
                    $this->checkbox("heure","heure",$checkedHeure,"gratification_par","gratification_par_heure","radio");
                    $this->checkbox("jour","jour",$checkedJour,"gratification_par","gratification_par_jour","radio");
                    $this->checkbox("mois","mois",$checkedMois,"gratification_par","gratification_par_mois","radio");
                    ?>
                </div>

                <span style="margin:10px">(après lissage)</span>

            </div>
        </div>
        <?php        
    }

    public function conditionRemboursement(){
        ?>
        <div class="form-row">
            <?php
            $this->textArea("Les frais engagés par le stagiaire à la demande de l'ENTREPRISE, dans le cadre de la réalisation du stage seront remboursés dans les conditions suivantes : ","conditions_remboursement","conditions_remboursement",$this->tab["conditions_remboursement"],"conditions_remboursement");
            ?>
        </div>
        <?php
    }

    public function activiteMission(){
        ?>
        <div class="form-row">
            <?php
            $this->textArea("Activités / missions confiées","activites_missions","activites_missions",$this->tab["activites_missions"],"activites_missions");
            ?>
        </div>
        <?php
    }

    public function competence(){
        ?>
        <div class="form-row">
            <?php
            $this->textArea("Compétences à acquérir ou à développer","competences_developper","competences_developper",$this->tab["competences_developper"],"competences_developper");
            ?>
        </div>
        <?php
    }

    public function textArea($nom,$id,$name,$value,$idLabel,$hidden = "",$col = 8){
        if($name == "droit_avantage" || $name == "conditions_remboursement" || $name == "modalite_conge" || $name == "cas_particulier"){
            $required = "";
        }else{
            $required = "required";
        }
        ?>
        <div class="form-group col-md-<?=$col?>">
            <label id="<?=$idLabel?>" <?=$hidden?>><?=$nom?></label>
            <textarea class="form-control" <?=$required?> style="background-color:#e8f0ff" id="<?=$id?>" name="<?=$name?>" rows="3" cols="55" <?=$hidden?>><?= $value;?></textarea>
        </div>
        <?php
    }

    public function requestFk($dbh,$select,$from,$where,$id,$key){
        $request = 'SELECT '.$select.' FROM '.$from.' WHERE '.$where.' = :id';
        $array = array(':id'=>$id);
        $tab = $this->tryPrepare($dbh,$request,$array,true);
        return $tab[$key];
    }

    public function modaliteConge(){
        $tab = $this->ifCheck($this->tab["modalite_conge_booleen"],"oui","non");
        $checkedOui = $tab[0];
        $checkedNon = $tab[1];
        $hidden = $tab[2];
        ?>
        <div class="form-row">
            <label class="col-md-8">
                Pour les stages dont la durée est supérieur à deux mois et dans la limite de la durée maximal de six mois, des congés ou autorisation d'absence sont possibles.<br/>
                <br/>
                Avez-vous des jours de congés ?
            </label>

            <div class="btn-group btn-group-toggle col-md-8" data-toggle="buttons" style="vertical-align:top">
                <?php
                    $this->checkbox("oui","oui",$checkedOui,"modalite_conge_booleen","modalite_conge_oui","radio");
                    $this->checkbox("non","non",$checkedNon,"modalite_conge_booleen","modalite_conge_non","radio");
                ?>
            </div>
        </div>

        <br/>

        <div class='form-row'>
            <?php
            $this->textArea("Nombre de jours de congés autorisés / modalités des congés / autorisation d'absence durant le stage :","modalite_conge","modalite_conge",$this->tab["modalite_conge"],"modalite_conge_label",$hidden);
            ?>
        </div>
        <?php
    }

    public function droitAvantage(){

        ?>
        <div class="form-row">
            <h6 class="col-md-8">Accès aux droits des salariés, avantages <a class="badge badge-warning" data-toggle="collapse" role="button" data-target="#collapseExample">Détails</a></h6>
            
        </div>
        <div class="form-row">
            <div class="col-md-8 collapse" id="collapseExample">
                <p>(Organisme de droit privé en France sauf en cas de règle particulières applicables dans certaines collectivités d'outre-mer françaises):</p>
                <p>Le STAGIAIRE bénéficie des protections et droits mentionnés aux articles L.1121-1, L.1152-1 et L.1153-1 du code du travail, dans les mêmes conditions que les salariés.</p>
                <p>Le STAGIAIRE a accès au restaurant d'entreprise ou aux titres-restaurants prévus à l'article L.3262-1 du code du travail, dans les mêmes conditions que les salariés de l'ENTREPRISE. Il bénéficie également de la prise en charge des frais de transport prévue à l'article L.3261-2 du même code.</p>
                <p>Le STAGIAIRE accède aux activités sociales et culturelles mentionnées à l'article L.2323-83 du code du travail dans les mêmes conditions que les salariés.</p>
            </div>
        </div>
        <div class="form-row">
            <?php
            $this->textArea("AUTRE AVANTAGES ACCORDES","droit_avantage","droit_avantage",$this->tab["droit_avantage"],"droit_avantage_label");
            ?>
        </div>
        <?php
    }

}