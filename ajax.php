
<?php
require("modele.php");
require("classes/autoload.php");
$dbh = Database::pdo();


$q = intval($_GET['q']); 
$t = $_GET["table"];

if($t == "referent"){
    $where = "fk_enseignement_referent";
}elseif($t == "tuteur"){
    $where = "fk_entreprise";
}

$request = 'SELECT * FROM '.$t.' WHERE '.$where.' = :id';
$result = Utils::tryBindFetch($request,array(':id'=>$q),1);

if(!empty($result)){
    foreach($result as $row){
        ?>
        <option value="<?=$row["id_".$t]?>"><?=$row["nom_".$t]." ".$row["prenom_".$t]?></option>
        <?php
    }
}

   