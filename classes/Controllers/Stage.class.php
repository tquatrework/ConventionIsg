<?php

namespace Controllers;
use Database;

class Stage extends Controller
{
    public $page = "Stage";

    public function validation(){
        
        // ChangeCampus
        //$recipients = "thierry1.quatre@iseg.fr";
        $recipients = "camille.pierrot@isg.fr, thierry.quatre@isg.fr";
	    // $this->model->sendMail("thierry.quatre@isg.fr","Stage en attente de validation","Bonjour, vous avez un stage en attente de validation ");
        $NomPrenomEtudiant = $this->model->recupNomPrenom();
        $classeEtudiant= $this->model->recupClasse();
        $this->model->sendMail($recipients,"Stage en attente de validation : ".$NomPrenomEtudiant[0]['nom_stagiaire']." ".$NomPrenomEtudiant[0]['prenom_stagiaire']
        ." - ".$classeEtudiant[0]['classe'],
        "Bonjour, vous avez un stage en attente de validation.<br/><br/>
        Nom de l'étudiant : ".$NomPrenomEtudiant[0]['nom_stagiaire']."<br/>
        Prénom de l'étudiant : ".$NomPrenomEtudiant[0]['prenom_stagiaire']."<br/>
        Classe de l'étudiant : ".$classeEtudiant[0]['classe']);
        $this->model->updateStatut("en attente de validation");
        header('refresh:3; url=index.php?controller=stage_pbm&task=liste');
        $this->model->demandeMessage();
        // redirect("index.php?controller=stage&task=liste");
    }
    
	public function confirmation(){

        $pdo = \DATABASE::pdo();
        
        //Récupération des foreign_key du stage
        $idStage = $_GET["id_stage"];
        $requestStage = "SELECT fk_utilisateur_stage, fk_tuteur_stage, fk_referent_stage FROM stage WHERE id_stage = :idStage";
        $stage = \Utils::tryBindFetch($requestStage,array(":idStage"=>$idStage),0,1);
        
        //Insertion etablissement dans etablissement_history
        $requestIdEtablissement = "SELECT fk_enseignement_referent FROM referent WHERE id_referent = :id_referent";
        $idEtablissement = \Utils::tryBindFetch($requestIdEtablissement,array(":id_referent"=>$stage["fk_referent_stage"]),0,1)["fk_enseignement_referent"];
        $requestInsertEtablissement = "INSERT INTO etablissement_history SELECT 0,nom_etablissement,numero_rue_etablissement,adresse_etablissement,complement_adresse_etablissement,code_postal_etablissement,ville_etablissement,mail_etablissement,telephone_etablissement,nom_representant_etablissement,prenom_representant_etablissement,fonction_representant_etablissement,id_etablissement FROM etablissement WHERE id_etablissement = :id_etablissement";
        $sth = $pdo->prepare($requestInsertEtablissement);
        $sth->execute(array(':id_etablissement'=>$idEtablissement));

         //Insertion referent dans referent_history
        $requestInsertReferent = "INSERT INTO referent_history SELECT 0,nom_referent,prenom_referent,fonction_referent,telephone_referent,mail_referent,".$pdo->lastInsertId().",id_referent FROM referent WHERE id_referent = :id_referent";
         $sth = $pdo->prepare($requestInsertReferent);
        $sth->execute(array(':id_referent'=>$stage["fk_referent_stage"]));
        $fk_referent = $pdo->lastInsertId();

        //Insertion utilisateur dans utilisateur_history
        $requestInsertUtilisateur = "INSERT INTO utilisateur_history SELECT 0,identifiant,password,compteur,profile,rgpd,id FROM utilisateur WHERE id = :id_utilisateur";
        $sth = $pdo->prepare($requestInsertUtilisateur);
        $sth->execute(array(':id_utilisateur'=>$stage["fk_utilisateur_stage"]));
        $fk_utilisateur = $pdo->lastInsertId();

        //Insertion entreprise dans entreprise_history
        $requestIdEntreprise = "SELECT fk_entreprise FROM tuteur WHERE id_tuteur = :id_tuteur";
        $idEntreprise = \Utils::tryBindFetch($requestIdEntreprise,array(":id_tuteur"=>$stage["fk_tuteur_stage"]),0,1)["fk_entreprise"];
        $requestInsertEntreprise = "INSERT INTO entreprise_history SELECT 0,nom_entreprise,adresse_entreprise,ville_entreprise,telephone_entreprise,mail_entreprise,secteur_activite_entreprise,nom_representant_entreprise,prenom_representant_entreprise,fonction_representant_entreprise,".$fk_utilisateur.",numero_rue_entreprise,code_postal_entreprise,complement_adresse_entreprise,statut_entreprise,siret_entreprise,id_entreprise FROM entreprise WHERE id_entreprise = :id_entreprise";
        $sth = $pdo->prepare($requestInsertEntreprise);
        $sth->execute(array(':id_entreprise'=>$idEntreprise));
        $fk_entreprise = $pdo->lastInsertId();

        //Insertion tuteur dans tuteur_history
        $requestInsertTuteur = "INSERT INTO tuteur_history SELECT 0,nom_tuteur,prenom_tuteur,fonction_tuteur,telephone_tuteur,mail_tuteur,".$fk_entreprise.",".$fk_utilisateur.",id_tuteur FROM tuteur WHERE id_tuteur = :id_tuteur";
        $sth = $pdo->prepare($requestInsertTuteur);
        $sth->execute(array(':id_tuteur'=>$stage["fk_tuteur_stage"]));
        $fk_tuteur = $pdo->lastInsertId();

        //Insertion stagiaire dans stagiaire_history
        $requestIdStagiaire = "SELECT id_stagiaire FROM stagiaire WHERE id_stagiaire = :id_stagiaire";
        $idStagiaire = \Utils::tryBindFetch($requestIdStagiaire,array(":id_stagiaire"=>$stage["fk_utilisateur_stage"]),0,1)["id_stagiaire"];
        if($idStagiaire){
            $requestInsertStagiaire = "INSERT INTO stagiaire_history SELECT 0,civilite_stagiaire,nom_stagiaire,prenom_stagiaire,adresse_stagiaire,date_naissance_stagiaire,ville_stagiaire,telephone_stagiaire,nationalite,mail_stagiaire,classe,numero_securite_social,adresse_caisse_assurance,ville_secu,numero_rue_stagiaire,code_postal_stagiaire,complement_adresse_stagiaire,numero_rue_assurance,adresse_assurance,complement_adresse_assurance,code_postal_assurance,ville_assurance,id_stagiaire FROM stagiaire WHERE id_stagiaire = :id_stagiaire";
            \Utils::tryBindFetch($requestInsertStagiaire,array(":id_stagiaire"=>$stage["fk_utilisateur_stage"]));
        }else{
            $requestInsertNull = "INSERT INTO stagiaire_history (id_stagiaire) VALUES (0)";
            \Utils::tryBindFetch($requestInsertNull,array());
        }

        // Insertion stage dans stage_history
        $requestInsertStage = "INSERT INTO stage_history SELECT 0,annee_universitaire,date_debut,date_fin,duree_semaine_mois, duree_totale_de,duree_totale,duree_discontinue,duree_discontinue_par,commentaire_duree,temps_complet,heure_partiel,obligatoire,lundi,mardi,mercredi,jeudi,vendredi,samedi,cas_particulier,gratification,gratification_par,intitulePoste,activites_missions,cas_particulier_booleen,modalite_conge,modalite_conge_booleen,conditions_remboursement,droit_avantage,competences_developper,".$fk_utilisateur.",".$fk_tuteur.",".$fk_referent.",statut,lieu_bis_bool,lieu_bis_entreprise,fermeture_entreprise,date_debut_fermeture_entreprise,date_fin_fermeture_entreprise,services_entreprise,teletravail,type_stage,id_stage FROM stage WHERE id_stage = :id_stage";
        \Utils::tryBindFetch($requestInsertStage,array(":id_stage"=>$idStage));
        
        //Changement du statut entreprise en permanente
        $requestEntreprisePermanente = "UPDATE entreprise SET statut_entreprise = 'permanente' WHERE id_entreprise = :id_entreprise";
        \Utils::tryBindFetch($requestEntreprisePermanente,array(":id_entreprise"=>$idEntreprise));

        $etudiantEmail = $this->model->recupIdentifiant();
        $this->model->updateStatut("Stage valide");
        $this->model->sendMail($etudiantEmail["identifiant"],"Validation de stage","Bonjour, votre stage a été validé");
        header('refresh:3; url=index.php?controller=stage_pbm&task=liste');
        $this->model->validationMessage();
        // redirect("index.php?controller=stage&task=liste");
    }

    public function devalidationStage(){
        $idStage = $_GET["id_stage"];
        $fkStage = $this->model->requestFKeysStage("stage",$idStage);
        $fkStageHistory = $this->model->requestFKeysStage("stage_history",$idStage);
        
        //Comparaison entreprises
        $idEntreprise = $this->model->requestIdEntreprise("entreprise",$fkStage["fk_tuteur_stage"]);
        $idEntrepriseHistory = $this->model->requestIdEntreprise("entreprise_history",$fkStageHistory["fk_tuteur_stage"]);
        $entreprise = $this->model->requestEntreprise("entreprise",$idEntreprise);
        $entrepriseHistory = $this->model->requestEntreprise("entrepriseHistory",$idEntrepriseHistory);
        if($this->model->notEquals($entreprise,$entrepriseHistory)){
            $this->model->errorMessage("entreprise");
            return;
        }
        
        //Comparaison tuteurs
        $tuteur = $this->model->requestTuteur("tuteur",$fkStage["fk_tuteur_stage"]);
        $tuteurHistory = $this->model->requestTuteur("tuteurHistory",$fkStageHistory["fk_tuteur_stage"]);
        if($this->model->notEquals($tuteur,$tuteurHistory)){
            $this->model->errorMessage("tuteur");
            return;
        }
        
        //Comparaison référents
        $referent = $this->model->requestReferent("referent",$fkStage["fk_referent_stage"]);
        $referentHistory = $this->model->requestReferent("referent_history",$fkStageHistory["fk_referent_stage"]);
        if($this->model->notEquals($referent,$referentHistory)){
            $this->model->errorMessage("referent");
            return;
        }

        //Comparaison établissements
        $idEtablissement = $this->model->requestIdEtablissement("etablissement",$fkStage["fk_referent_stage"]);
        $idEtablissementHistory = $this->model->requestIdEtablissement("etablissement_history",$fkStageHistory["fk_referent_stage"]);
        $etablissement = $this->model->requestEtablissement("etablissement",$idEtablissement);
        $etablissementHistory = $this->model->requestEtablissement("etablissement_history",$idEtablissementHistory);
        if($this->model->notEquals($etablissement,$etablissementHistory)){
            $this->model->errorMessage("etablissement");
            return;
        }

        //Comparaison stagiaires
        $stagiaire = $this->model->requestStagiaire("stagiaire",$fkStage["fk_utilisateur_stage"]);
        $stagiaireHistory = $this->model->requestStagiaire("stagiaire_history",$fkStageHistory["fk_utilisateur_stage"]);
        if($this->model->notEquals($stagiaire,$stagiaireHistory)){
            $this->model->errorMessage("stagiaire");
            return;
        }

        //Suppression des lignes historiques de ce stage
        $this->model->deleteHistoryFrom("tuteur",$fkStageHistory["fk_tuteur_stage"]);
        $this->model->deleteHistoryFrom("referent",$fkStageHistory["fk_referent_stage"]);
        $this->model->deleteHistoryFrom("stagiaire",$fkStageHistory["fk_utilisateur_stage"]);
        $this->model->deleteHistoryFrom("utilisateur",$fkStageHistory["fk_utilisateur_stage"]);
        $this->model->deleteHistoryFrom("entreprise",$idEntrepriseHistory);
        $this->model->deleteHistoryFrom("etablissement",$idEtablissementHistory);
        $this->model->deleteHistoryFrom("stage",$idStage);

        //Changement de statut du stage 
        $this->model->updateStatut("en attente de validation",$idStage);
        header('refresh:3; url=index.php?controller=stage_pbm&task=liste');
        $this->model->devalidationMessage();
    }

    public function historiqueStageValide(){

        $pdo = \DATABASE::pdo();
        $requestStage = "SELECT id_stage FROM stage WHERE statut = 'Stage valide' or statut = 'Stage validé'";
        $idStages = \Utils::tryBindFetch($requestStage,array(),1,1);
        var_dump($idStages);

        foreach($idStages as $stageId){

            $idStage = $stageId["id_stage"];
            $requestStage = "SELECT fk_utilisateur_stage, fk_tuteur_stage, fk_referent_stage FROM stage WHERE id_stage = :idStage";
            $stage = \Utils::tryBindFetch($requestStage,array(":idStage"=>$idStage),0,1);
            echo $stage["fk_utilisateur_stage"]."<br>";
            
            //Insertion etablissement dans etablissement_history
            $requestIdEtablissement = "SELECT fk_enseignement_referent FROM referent WHERE id_referent = :id_referent";
            $idEtablissement = \Utils::tryBindFetch($requestIdEtablissement,array(":id_referent"=>$stage["fk_referent_stage"]),0,1)["fk_enseignement_referent"];
            $requestInsertEtablissement = "INSERT INTO etablissement_history SELECT 0,nom_etablissement,numero_rue_etablissement,adresse_etablissement,complement_adresse_etablissement,code_postal_etablissement,ville_etablissement,mail_etablissement,telephone_etablissement,nom_representant_etablissement,prenom_representant_etablissement,fonction_representant_etablissement,id_etablissement FROM etablissement WHERE id_etablissement = :id_etablissement";
            $sth = $pdo->prepare($requestInsertEtablissement);
            $sth->execute(array(':id_etablissement'=>$idEtablissement));

            //Insertion referent dans referent_history
            $requestInsertReferent = "INSERT INTO referent_history SELECT 0,nom_referent,prenom_referent,fonction_referent,telephone_referent,mail_referent,".$pdo->lastInsertId().",id_referent FROM referent WHERE id_referent = :id_referent";
            $sth = $pdo->prepare($requestInsertReferent);
            $sth->execute(array(':id_referent'=>$stage["fk_referent_stage"]));
            $fk_referent = $pdo->lastInsertId();

            //Insertion utilisateur dans utilisateur_history
            $requestInsertUtilisateur = "INSERT INTO utilisateur_history SELECT 0,identifiant,password,compteur,profile,rgpd,id FROM utilisateur WHERE id = :id_utilisateur";
            $sth = $pdo->prepare($requestInsertUtilisateur);
            $sth->execute(array(':id_utilisateur'=>$stage["fk_utilisateur_stage"]));
            $fk_utilisateur = $pdo->lastInsertId();

            //Insertion entreprise dans entreprise_history
            $requestIdEntreprise = "SELECT fk_entreprise FROM tuteur WHERE id_tuteur = :id_tuteur";
            $idEntreprise = \Utils::tryBindFetch($requestIdEntreprise,array(":id_tuteur"=>$stage["fk_tuteur_stage"]),0,1)["fk_entreprise"];
            $requestInsertEntreprise = "INSERT INTO entreprise_history SELECT 0,nom_entreprise,adresse_entreprise,ville_entreprise,telephone_entreprise,mail_entreprise,secteur_activite_entreprise,nom_representant_entreprise,prenom_representant_entreprise,fonction_representant_entreprise,".$fk_utilisateur.",numero_rue_entreprise,code_postal_entreprise,complement_adresse_entreprise,statut_entreprise,siret_entreprise,id_entreprise FROM entreprise WHERE id_entreprise = :id_entreprise";
            $sth = $pdo->prepare($requestInsertEntreprise);
            $sth->execute(array(':id_entreprise'=>$idEntreprise));
            $fk_entreprise = $pdo->lastInsertId();

            //Insertion tuteur dans tuteur_history
            $requestInsertTuteur = "INSERT INTO tuteur_history SELECT 0,nom_tuteur,prenom_tuteur,fonction_tuteur,telephone_tuteur,mail_tuteur,".$fk_entreprise.",".$fk_utilisateur.",id_tuteur FROM tuteur WHERE id_tuteur = :id_tuteur";
            $sth = $pdo->prepare($requestInsertTuteur);
            $sth->execute(array(':id_tuteur'=>$stage["fk_tuteur_stage"]));
            $fk_tuteur = $pdo->lastInsertId();

            //Insertion stagiaire dans stagiaire_history
            $requestIdStagiaire = "SELECT id_stagiaire FROM stagiaire WHERE id_stagiaire = :id_stagiaire";
       
            $idStagiaire = \Utils::tryBindFetch($requestIdStagiaire,array(":id_stagiaire"=>$stage["fk_utilisateur_stage"]),0,1)["id_stagiaire"];
            if($idStagiaire){
                $requestInsertStagiaire = "INSERT INTO stagiaire_history SELECT 0,civilite_stagiaire,nom_stagiaire,prenom_stagiaire,adresse_stagiaire,date_naissance_stagiaire,ville_stagiaire,telephone_stagiaire,nationalite,mail_stagiaire,classe,numero_securite_social,adresse_caisse_assurance,ville_secu,numero_rue_stagiaire,code_postal_stagiaire,complement_adresse_stagiaire,numero_rue_assurance,adresse_assurance,complement_adresse_assurance,code_postal_assurance,ville_assurance,id_stagiaire FROM stagiaire WHERE id_stagiaire = :id_stagiaire";
                \Utils::tryBindFetch($requestInsertStagiaire,array(":id_stagiaire"=>$stage["fk_utilisateur_stage"]));
            }else{
                $requestInsertNull = "INSERT INTO stagiaire_history (id_stagiaire) VALUES (0)";
                \Utils::tryBindFetch($requestInsertNull,array());
            }

            //Insertion stage dans stage_history
            echo($fk_utilisateur.$fk_tuteur.$fk_referent.$idStage);
            $requestInsertStage = "INSERT INTO stage_history SELECT 0,annee_universitaire,date_debut,date_fin,duree_semaine_mois, duree_totale_de,duree_totale,duree_discontinue,duree_discontinue_par,commentaire_duree,temps_complet,heure_partiel,obligatoire,lundi,mardi,mercredi,jeudi,vendredi,samedi,cas_particulier,gratification,gratification_par,intitulePoste,activites_missions,cas_particulier_booleen,modalite_conge,modalite_conge_booleen,conditions_remboursement,droit_avantage,competences_developper,".$fk_utilisateur.",".$fk_tuteur.",".$fk_referent.",statut,lieu_bis_bool,lieu_bis_entreprise,fermeture_entreprise,date_debut_fermeture_entreprise,date_fin_fermeture_entreprise,services_entreprise,teletravail,type_stage,id_stage FROM stage WHERE id_stage = :id_stage";
            \Utils::tryBindFetch($requestInsertStage,array(":id_stage"=>$idStage));
        }
    }
}



