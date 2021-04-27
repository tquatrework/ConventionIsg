<?php

namespace Model;

use Database;
use PDO;
use Utils;

class Stage_pbm extends Model
{
    public $table = "stage";

    function findAll() {
        $request = "SELECT * FROM {$this->table} ORDER BY date_debut DESC LIMIT 5 ";
        return Utils::tryFetch($request,1);
    }

    function updateStatut($statut){
        $request = "UPDATE {$this->table} SET statut = :statut WHERE id_stage = :id" ;
        Utils::tryBind($request,array(":id"=>$_GET["id_stage"],":statut"=>$statut));
        redirect("index.php?controller=stage_pbm&task=liste");
    }

    public function recupNomPrenom(){
        $request = "SELECT nom_stagiaire, prenom_stagiaire FROM {$this->table} 
                    INNER JOIN utilisateur ON stage.fk_utilisateur_stage = utilisateur.id
                    INNER JOIN stagiaire ON utilisateur.id = stagiaire.id_stagiaire
                    WHERE id_stage = :id";
        return Utils::tryBindFetch($request,array(":id"=>$_GET["id_stage"]),1,1);
    }

    public function recupIdentifiant(){
        $request = "SELECT identifiant FROM {$this->table} 
                    INNER JOIN utilisateur ON fk_utilisateur_stage = utilisateur.id
                    WHERE id_stage = :id";
        return Utils::tryBindFetch($request,array(":id"=>$_GET["id_stage"]),0,1);
    }

    function selectEnAttente(){
        $request = 'SELECT * FROM stage WHERE statut = "en attente de validation"';
        return Utils::tryFetch($request,1);
    }

    function selectAllForTableBis($idStage){
        $request = 'SELECT * FROM stage WHERE id_stage = :id';
    }

     function requestFKeysStage($table,$id){
        if($table == "stage"){
        $requestFkStage = "SELECT fk_utilisateur_stage, fk_tuteur_stage, fk_referent_stage FROM stage WHERE id_stage = :id";
    }else{
        $requestFkStage = "SELECT fk_utilisateur_stage, fk_tuteur_stage, fk_referent_stage FROM stage_history WHERE id_stage = :id";
    }
    return \Utils::tryBindFetch($requestFkStage,array(":id"=>$id),0,1);
    }

     function requestIdEntreprise($table,$id){
    if($table == "entreprise"){
        $requestIdEntreprise = "SELECT fk_entreprise FROM tuteur WHERE id_tuteur = :id";
    }else{
        $requestIdEntreprise = "SELECT fk_entreprise FROM tuteur_history WHERE id_tuteur_history = :id";
    }
    return \Utils::tryBindFetch($requestIdEntreprise,array(":id"=>$id),0,1)["fk_entreprise"];
    }

     function requestEntreprise($table,$id){
    if($table == "entreprise"){
        $requestEntreprise = "SELECT nom_entreprise,adresse_entreprise,ville_entreprise,telephone_entreprise,mail_entreprise,secteur_activite_entreprise,nom_representant_entreprise,prenom_representant_entreprise,fonction_representant_entreprise,numero_rue_entreprise,code_postal_entreprise,complement_adresse_entreprise,siret_entreprise 
        FROM entreprise 
        WHERE id_entreprise = :id";
    }else{
        $requestEntreprise = "SELECT nom_entreprise,adresse_entreprise,ville_entreprise,telephone_entreprise,mail_entreprise,secteur_activite_entreprise,nom_representant_entreprise,prenom_representant_entreprise,fonction_representant_entreprise,numero_rue_entreprise,code_postal_entreprise,complement_adresse_entreprise,siret_entreprise
        FROM entreprise_history
        WHERE id_entreprise_history = :id";
    }
    return \Utils::tryBindFetch($requestEntreprise,array(":id"=>$id),0,1);
    }

     function requestTuteur($table,$id){
    if($table == "tuteur"){
        $requestTuteur = "SELECT nom_tuteur,prenom_tuteur,fonction_tuteur,telephone_tuteur,mail_tuteur FROM tuteur WHERE id_tuteur = :id";
    }else{
        $requestTuteur = "SELECT nom_tuteur,prenom_tuteur,fonction_tuteur,telephone_tuteur,mail_tuteur FROM tuteur_history WHERE id_tuteur_history = :id ";
    }
    return \Utils::tryBindFetch($requestTuteur,array(":id"=>$id));
    }

     function requestReferent($table,$id){
    if($table == "referent"){
        $requestReferent = "SELECT nom_referent,prenom_referent,fonction_referent,telephone_referent,mail_referent FROM referent WHERE id_referent = :id";
    }else{
        $requestReferent = "SELECT nom_referent,prenom_referent,fonction_referent,telephone_referent,mail_referent FROM referent_history WHERE id_referent_history = :id";
    }
    return \Utils::tryBindFetch($requestReferent,array(":id"=>$id));
    }

     function requestIdEtablissement($table,$id){
    if($table == "etablissement"){
        $requestIdEtablissement = "SELECT fk_enseignement_referent FROM referent WHERE id_referent = :id";
    }else{
        $requestIdEtablissement = "SELECT fk_enseignement_referent FROM referent_history WHERE id_referent_history = :id";
    }
    return \Utils::tryBindFetch($requestIdEtablissement,array(":id"=>$id),0,1)["fk_enseignement_referent"];
    }

     function requestEtablissement($table,$id){
    if($table == "etablissement"){
        $requestEtablissement = "SELECT nom_etablissement,numero_rue_etablissement,adresse_etablissement,complement_adresse_etablissement,code_postal_etablissement,ville_etablissement,mail_etablissement,telephone_etablissement,nom_representant_etablissement,prenom_representant_etablissement,fonction_representant_etablissement FROM etablissement WHERE id_etablissement = :id";
    }else{
        $requestEtablissement = "SELECT nom_etablissement,numero_rue_etablissement,adresse_etablissement,complement_adresse_etablissement,code_postal_etablissement,ville_etablissement,mail_etablissement,telephone_etablissement,nom_representant_etablissement,prenom_representant_etablissement,fonction_representant_etablissement FROM etablissement_history WHERE id_etablissement_history = :id";
    }
    return \Utils::tryBindFetch($requestEtablissement,array(":id"=>$id));
    }

     function requestStagiaire($table,$id){
    if($table == "stagiaire"){
        $requestStagiaire = "SELECT civilite_stagiaire,nom_stagiaire,prenom_stagiaire,adresse_stagiaire,date_naissance_stagiaire,ville_stagiaire,telephone_stagiaire,nationalite,mail_stagiaire,classe,numero_securite_social,adresse_caisse_assurance,ville_secu,numero_rue_stagiaire,code_postal_stagiaire,complement_adresse_stagiaire,numero_rue_assurance,adresse_assurance,complement_adresse_assurance,code_postal_assurance,ville_assurance FROM stagiaire WHERE id_stagiaire = :id";
    }else{
        $requestStagiaire = "SELECT civilite_stagiaire,nom_stagiaire,prenom_stagiaire,adresse_stagiaire,date_naissance_stagiaire,ville_stagiaire,telephone_stagiaire,nationalite,mail_stagiaire,classe,numero_securite_social,adresse_caisse_assurance,ville_secu,numero_rue_stagiaire,code_postal_stagiaire,complement_adresse_stagiaire,numero_rue_assurance,adresse_assurance,complement_adresse_assurance,code_postal_assurance,ville_assurance FROM stagiaire_history WHERE id_stagiaire_history = :id";
    }
    return \Utils::tryBindFetch($requestStagiaire,array(":id"=>$id));
    }

     function deleteHistoryFrom($table,$id){
    $request = "DELETE FROM ".$table."_history WHERE id_".$table."_history = :id";
    \Utils::tryBindFetch($request,array(":id"=>$id));
    }

     function notEquals($tab1,$tab2){
    if($tab1 != $tab2){
        return true;
    }
    return false;
    }

     function errorMessage($table){
    echo "<span class='alert alert-danger col'>Opération impossible car des changements ont été apportés au niveau de la table ".$table.", Veuillez contacter votre responsable informatique</span>";
    }

     function devalidationMessage(){
    echo "<span class='alert alert-success col'>Stage dévalidé</span>";
    }

     function validationMessage(){
    echo "<span class='alert alert-success col'>Stage validé</span>";
    }

     function DemandeMessage(){
    echo "<span class='alert alert-success col'>Demande de validation envoyée</span>";
    }

     function requestDateValidation($idStage){
    $requestDateValidation = "SELECT date_validation FROM stage_history WHERE id_stage = :idStage";
    return \Utils::tryBindFetch($requestDateValidation,array(":idStage"=>$idStage))["date_validation"];
    }
}