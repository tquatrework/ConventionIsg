<?php

namespace Model;

class Authentification extends Model
{
    public $table = "authentification";

    public function existIdentifiant($identifiant){
        $request = "SELECT identifiant FROM utilisateur WHERE identifiant = :identifiant";
        $identifiant_exist = \Utils::tryBindFetch($request,array(":identifiant"=>$identifiant));
        if(is_array($identifiant_exist)){
            return true;
        }else{
            return false;
        }
    }

    public function selectIdProfile($identifiant){
        $request = "SELECT id,profile FROM utilisateur WHERE identifiant = :identifiant";
        return \Utils::tryBindFetch($request,array(":identifiant"=>$identifiant));
    }

    public function insertUtilisateur($identifiant,$password){
        $request = 'INSERT INTO utilisateur (identifiant,password) VALUES (:identifiant,:password)';
        \Utils::tryBind($request,array(":identifiant"=>$identifiant,":password"=>$password));
    }

    public function selectUtilisateur($identifiant){
        $request = "SELECT password,id,profile FROM utilisateur WHERE identifiant = :identifiant";
        return \Utils::tryBindFetch($request,array(":identifiant"=>$identifiant));
    }

    public function selectIdentifiant($mail){
        $request = 'SELECT identifiant,compteur FROM utilisateur WHERE identifiant = :email ';
        return \Utils::tryBindFetch($request,array(':email'=>$mail));
    }

    public function insertPasswordReset($mail,$token){
        $request = 'INSERT INTO password_reset (email,token,expire) VALUES (:email,:token, NOW() + INTERVAL 5 MINUTE)';
        \Utils::tryBind($request,array(':email' => $mail, ':token' => $token));
    }

    public function incrCompteurUtilisateur($email){
        $request = 'UPDATE utilisateur SET compteur = compteur + 1 WHERE identifiant = :email';
        \Utils::tryBind($request,array(':email'=> $email));
    }

    public function sendMailAuth($email,$token){
        $to = $email;
        $subject = "Changement de mot de passe sur convention.isgbx.fr/Convention";
        $msg = 'Bonjour, Veuillez cliquer sur ce lien <a href="http://convention.isgbx.fr/Convention/index.php?controller=authentification&task=newPassword&token=' . $token . '">lien</a> pour changer de mot de passe';
        $msg = wordwrap($msg, 70);
        $headers[] = "MIME-Version: 1.0";
        $headers[] = "Content-type: text/html; charset=utf8";
        $headers[] = "From : convention@isgbx.fr";
        mail($to, $subject, $msg, implode("\r\n", $headers));
    }

    public function champVide(){
        if(empty($_POST["identifiant"]) || empty($_POST["password"]) || empty($_POST["verif_password"])){
            return true;
        }
        return false;
    }

    public function champVideAuth(){
        if(empty($_POST["identifiant"]) || empty($_POST["password"])){
            return true;
        }
        return false;
    }

    public function champVideRecup(){
        if(empty($_POST["email"])){
            return true;
        }
        return false;
    }

    public function champVideNewPassword(){
        if(empty($_POST["nouveau_mdp"]) || empty($_POST["confirmation_mdp"])){
            return true;
        }
        return false;
    }

    public function passwordDifferent(){
        if($_POST["password"] !== $_POST["verif_password"]){
            return true;
        }
        return false;
    }

    public function recupToken($token){
        $request = 'SELECT expire,email FROM password_reset WHERE token = :token';
        return \Utils::tryBindFetch($request,array(':token'=>$token));
    }

    public function deleteToken($token){
        $request = 'DELETE FROM password_reset WHERE token = :token';
        \Utils::tryBind($request,array(':token' => $token));
    }

    public function updatePassword($mail,$password){
        $request = 'UPDATE utilisateur SET password = :password WHERE identifiant = :email';
        \Utils::tryBind($request,array(':email'=> $mail, ':password'=>$password));
    }
}
