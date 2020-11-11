<?php

class Application
{
    public static function process()
    {
        //Initialisation et valeurs par défaut du controller et de la fonction
        $controllerName = "Stagiaire";
        $task = "liste";
        //Changement de controller dépendant du paramètre GET "controller"
        if (!empty($_GET["controller"])) {
            $controllerName = ucfirst($_GET["controller"]);
        }
        //Changement de la fonction à appeler dépendant du paramètre GET "task"
        if (!empty($_GET["task"])) {
            $task = $_GET["task"];
        }
        //On instancie la classe
        $controllerName = "\Controllers\\".$controllerName;
        $controller = new $controllerName();
        //On appelle la fonction de la class instancié
        $controller->$task();
    }
}
