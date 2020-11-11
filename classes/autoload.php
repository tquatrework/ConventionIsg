<?php
spl_autoload_register(function($className){
        $className = str_replace("\\",'/',$className);
        // var_dump($className);
        // echo "<br>";
        require("$className.class.php");
});