<?php
namespace Controllers;

class Controller
{
    public $page;
    public $dbh;
    public $model;
    public $view;

    public function __construct()
    {
        $this->dbh = \Database::pdo();
        $modelName = "\Model\\".$this->page;
        $viewName = "\View\\".$this->page;
        $this->model = new $modelName;
        $this->view = new $viewName;
        
    }

    public function liste()
    {
        $affichage = "\Affichage\\" . $this->page;
        $card = new $affichage($this->dbh);
    }

    public function show()
    {
        $form = "\Form\\" . $this->page;
        $card = new $form($this->dbh);
    }

    public function recupPassword(){
        $view = new \View\Authentification;
        $model = new \Model\Authentification;

        if (isset($_POST["envoi_email"])) {
            //CHAMPS VIDE
            if($model->champVideRecup()){
                $view->pushError("Veuillez renseigné un identifiant");
            }
            //FILTRAGE ET VALIDATION DE EMAIL
            $email = \Utils::sanitizeEmail($_POST["email"]);
            if(!\Utils::validateEmail($email)){
                $view->pushError("Mauvais format d'email");
            }
            //Création d'un token
            $token = bin2hex(openssl_random_pseudo_bytes(50));

            //Recherche de l'email dans la base de donnée
            if(count($view->errors_Array) == 0){
                $result = $model->selectIdentifiant($email);
                if(!$result){
                    $view->pushError("Identifiant inconnu");
                }elseif($result["compteur"] > 5){
                    $view->pushError("Limite de demande pour changement de mot de passe atteint, veuillez contacter votre administrateur");
                }
            }

            if (count($view->errors_Array) == 0) {
                //Création d'une ligne pour le changement de mot de passe
                $model->insertPasswordReset($email,$token);
                //Incrémente le compteur de demande de changement d'email dans la table utilisateur
                $model->incrCompteurUtilisateur($email);
                //Envoi d'un email avec un token
                $model->sendMailAuth($email,$token);
                //Message de réussite et redirection
                $view->pushSuccess("Demande envoyé, veuillez consulter vos mails");
                refresh(2,"index.php?controller=authentification&task=authentification");
            }
        }
        $view->recupPasswordTemplate();
    }

    public function newPassword(){

        $view = new \View\Authentification;
        $model = new \Model\Authentification;

        if(isset($_POST["envoi_nouveau_mdp"])){
            // CHAMPS VIDE
            if($model->champVideNewPassword()){
                $view->pushError("Veuillez remplir tout les champs");
            }
            //FILTRAGE DES DONNEES
            $nouveau_mdp = \Utils::sanitizePassword($_POST["nouveau_mdp"]);
            $confirmation_mdp = \Utils::sanitizePassword($_POST["confirmation_mdp"]);
            $token = $_GET["token"];
            // PASSWORD DIFFERENT =>ERREUR
            if($nouveau_mdp !== $confirmation_mdp){
                $view->pushError("Les deux champs ne correspondent pas");
            }

            if(count($view->errors_Array) == 0){
                //RECHERCHE DU CHAMP CORRESPONDANT AU TOKEN
                $result = $model->recupToken($token);
                //ERREUR SI LE CHAMP N'EXISTE PAS
                if(!$result){
                    $view->pushError("Token invalide, veuillez réitérer votre demande en cliquant sur ce <a href='www.convention.isgbx.fr/Convention/index.php?controller=authentification&task=recupPassword'>lien</a>");
                    $model->deleteToken($token);
                //ERREUR SI LE TOKEN A EXPIRE
                }elseif($result["expire"] < date("Y-m-d H:i:s")){
                    $view->pushError("Votre token a expiré, veuillez réitérer votre demande en cliquant sur ce <a href='www.convention.isgbx.fr/Convention/index.php?controller=authentification&task=recupPassword'>lien</a>");
                    $model->deleteToken($token);
                }
            }

            if(count($view->errors_Array) == 0){
                $email =  $result["email"];
                $nouveau_mdp = password_hash($nouveau_mdp,PASSWORD_BCRYPT);
                //Changement du mdp
                $model->updatePassword($email,$nouveau_mdp);
                $model->deleteToken($token);
                //message de réussite et redirection
                $view->pushSuccess("Mot de passe changé");
                refresh(2,"index.php?controller=authentification&task=authentification");
            }
        }
        $view->newPasswordTemplate();
    }

    public function authentification(){

        $view = new \View\Authentification;
        $model = new \Model\Authentification;

        if (isset($_POST["envoi_authentification"])) {
            //CHAMPS VIDE
            if ($model->champVideAuth()) {
                $view->pushError("Veuillez remplir tout les champs");
            }
            //FILTRAGE
            if(count($view->errors_Array) == 0){
                $identifiant = \Utils::sanitizeEmail($_POST["identifiant"]);
                $password = \Utils::sanitizePassword($_POST["password"]);
                if (!\Utils::validateEmail($identifiant)) {
                    $view->pushError("Mauvais format d'email");
                }
            }
            //VALIDATION IDENTIFIANT/PASSWORD
            if(count($view->errors_Array) == 0){
                $result = $model->selectUtilisateur($identifiant);
                if (!$result) {
                    $view->pushError("Mauvais identifiant");
                }else{
                    if (!password_verify($password, $result["password"])){
                        $view->pushError("Mauvais mot de passe");
                    }
                }
            }
            //INSERTION SESSION
            if(count($view->errors_Array) == 0){
                $_SESSION["utilisateur"] = $identifiant;
                $_SESSION["id"] = $result["id"];
                $_SESSION["profile"] = $result["profile"];
                $token = bin2hex(openssl_random_pseudo_bytes(50));
                $_SESSION["token"] = $token;
                //REDIRECTION
                if($_SESSION["profile"] == "etudiant"){
                    redirect("index.php?controller=stagiaire&task=show");
                }else{
                    redirect("index.php?controller=stagiaire&task=liste");
                }
            }
        }
        //AFFICHAGE
        $view->authentificationTemplate();
    }

    public function inscription(){

        $view = new \View\Authentification;
        $model = new \Model\Authentification;

        //SI POST EXISTE
        if(isset($_POST["envoi_inscription"])){
            //SI UN CHAMP EST VIDE => ERREUR
            if($model->champVide()){
                $view->pushError("Veuillez remplir tout les champs");
            }
            //SI LES PASSWORDS NE CORRESPONDENT PAS => ERREUR
            if($model->passwordDifferent()){
                $view->pushError("Les mots de passes ne correspondent pas");
            }
            if(count($view->errors_Array) == 0){
                //FILTRAGE DES DONNEES
                $identifiant = \Utils::sanitizeEmail($_POST["identifiant"]);
                $password = \Utils::sanitizeHashPassword($_POST["password"]);
                //SI MAUVAIS FORMAT EMAIL => ERREUR
                if(!\Utils::validateEmail($identifiant)){
                    $view->pushError("Mauvais format d'identifiant");
                //SI IDENTIFIANT DEJA EXISTANT => ERREUR
                }elseif($model->existIdentifiant($identifiant)){
                    $view->pushError("L'identifiant $identifiant existe déjà");
                }
            }
            if(count($view->errors_Array) == 0){
                //INSERTION DANS BDD
                $model->insertUtilisateur($identifiant,$password);
                //INSERTION SESSION
                $result = $model->selectIdProfile($identifiant);
                extract($result);
                $_SESSION["utilisateur"] = $identifiant;
                $_SESSION["profile"] = $profile;
                $_SESSION["id"] = $id;
                $token = bin2hex(openssl_random_pseudo_bytes(50));
                $_SESSION["token"] = $token;
                //REDIRECTION
                if($_SESSION["profile"] == "etudiant"){
                    redirect("index.php?controller=stagiaire&task=show");
                }else{
                    redirect("index.php?controller=stagiaire&task=liste");
                }
            }
        }
        //AFFICHAGE    
        $view->inscriptionTemplate();
    }


    public function supprimer(){
        ?>
        <h3>Liste des <?=$_GET["controller"]?>s</h3>
        <?php

        if (isset($_GET["id_entreprise"])) {
            supprimer($this->dbh, "entreprise", "id_entreprise", $_GET["id_entreprise"], "Entreprise");
        }
        if (isset($_GET["id_tuteur"])) {
            supprimer($this->dbh, "tuteur", "id_tuteur", $_GET["id_tuteur"], "Tuteur");
        }
        if (isset($_GET["id_stage"])) {
            supprimer($this->dbh, "stage", "id_stage", $_GET["id_stage"], "Stage"); 
        }
        if (isset($_GET["id_etablissement"])) {
            supprimer($this->dbh, "etablissement", "id_etablissement", $_GET["id_etablissement"], "Etablissement");
        }
        if (isset($_GET["id_referent"])) {
            supprimer($this->dbh, "referent", "id_referent", $_GET["id_referent"], "Référent");
        }
        if (isset($_GET["id_stagiaire"])) {
            supprimer($this->dbh, "stagiaire", "id_stagiaire", $_GET["id_stagiaire"]);
        }
    }

}
