<?php
session_start();
//Inclusion des librairies modele, class ainsi que de l'autoloader
require("modele.php");
require("class.php");
require("classes/autoload.php");
//Redirection si l'utilisateur n'est pas authentifié
Database::redirection();
//Deconnexion si l'utilisateur appuis sur le bouton deconnexion
Database::deconnexion();
//Création d'une connexion à la base de donnée
$dbh = Database::pdo();
//Mis en tampon de l'affichage
ob_start();
//Moteur du site
Application::process();
//Injection de l'affichage générer par process() dans le template layout
$pageContent = ob_get_clean();
require("layout.php");
?>