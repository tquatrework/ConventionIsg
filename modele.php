<?php
    function jour_presence($jour,$string){ 
        if($jour == $string){
            $check = "checked";
        }else{
            $check = "";
        }    
        ?>
        <div class="form-check form-check-inline">
            <input class="form-check-input" value="<?=$string?>" type="checkbox" id="<?=$string;?>" name="<?=$string;?>" <?=$check?>>
            <label class="form-check-label" for="<?=$string;?>"><?= ucfirst($string);?></label>
        </div>
        <?php
    }

    function gratification_par($periode){
        if($periode == "heure"){
    ?>
        <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gratification_par" value="heure" hidden>
                    <label class="form-check-label">par </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gratification_par" value="heure" checked>
                    <label class="form-check-label">heure</label>
                </div>
                <div class="form-check form-check-inline" >
                    <input class="form-check-input" type="radio" name="gratification_par" value="jour">
                    <label class="form-check-label">jour</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gratification_par" value="mois"> 
                    <label class="form-check-label">mois</label> (après lissage)
            </div>
    <?php
        }
        elseif($periode == "jour"){
            ?>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gratification_par" value="heure" hidden>
                    <label class="form-check-label">par</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gratification_par" value="heure" >
                    <label class="form-check-label">heure</label>
                </div>
                <div class="form-check form-check-inline" >
                    <input class="form-check-input" type="radio" name="gratification_par" value="jour" checked>
                    <label class="form-check-label">jour</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gratification_par" value="mois"> 
                    <label class="form-check-label">mois</label> (après lissage)
            </div>
    <?php
        }
        elseif($periode == "mois"){
    ?>
            <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gratification_par" value="heure" hidden>
                    <label class="form-check-label">par </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gratification_par" value="heure" >
                    <label class="form-check-label">heure</label>
                </div>
                <div class="form-check form-check-inline" >
                    <input class="form-check-input" type="radio" name="gratification_par" value="jour">
                    <label class="form-check-label">jour</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gratification_par" value="mois" checked> 
                    <label class="form-check-label">mois</label> (après lissage)
            </div>
    <?php
        }else{
            ?>
            <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gratification_par" value="heure" hidden>
                    <label class="form-check-label">par </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gratification_par" value="heure" >
                    <label class="form-check-label">heure</label>
                </div>
                <div class="form-check form-check-inline" >
                    <input class="form-check-input" type="radio" name="gratification_par" value="jour">
                    <label class="form-check-label">jour</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gratification_par" value="mois" > 
                    <label class="form-check-label">mois</label> (après lissage)
            </div>
            <?php
        }
    }

    function liste($titre,$p1,$p2,$a1,$a2,$t1,$t2){
        ?>
        <div class="liste_entreprise col-md-10 d-flex justify-content-between">
            <div>
                <h5><?=$titre?></h5>
                <p><?=$p1?></p>
                <p><?=$p2?></p>
            </div>
            <div>
            <a href="<?=$a1?>" class="badge badge-info"><?=$t1?></a>
                <a href="<?=$a2?>" class="badge badge-secondary "><?=$t2?></a>
            </div>
        </div>
        <?php
}

function select($request,$dbh,$text = ""){
    $result = $dbh->query($request);
    if (!$result) {
        echo "\nPDO::errorInfo():\n";
        print_r($dbh->errorInfo());
    }
    return $result->fetch(PDO::FETCH_ASSOC);
    

}

function sql($request,$dbh,$text = ""){
    $result = $dbh->query($request);
    if(!$result){
        echo "\nPDO::errorInfo():\n";
        print_r($dbh->errorInfo());
    }else{
        echo "<div class='alert alert-success col-md-4'>$text</div>";
    }
}

function selectAll($request,$dbh,$text = ""){
    $result = $dbh->query($request);
    if (!$result) {
        echo "\nPDO::errorInfo():\n";
        print_r($dbh->errorInfo());
    }
    return $result->fetchAll(PDO::FETCH_ASSOC);
    
}

class Recup{

    public function recuperation(){
        if(isset($_POST["prenom_tuteur"])){
            //-----------------------------------------------------
            foreach($_POST as $key=>$value){
                $$key = $_POST[$key];
            }
            $fk_utilisateur = $_SESSION["id"];
            //-----------------------------------------------------

            if(isset($_GET["id_tuteur"])){

                //-----------------------------------------------------
                $request = 'SELECT fk_utilisateur FROM tuteur WHERE id_tuteur = '.$_GET["id_tuteur"].'';
                $resultat = select($request,$dbh,"");
                $fk_utilisateur = $resultat["fk_utilisateur"];
                
                foreach($_POST as $key=>$value){
                    $result = $dbh->query('UPDATE tuteur
                                        SET '.$key.' = "'.$_POST[$key].'"
                                        WHERE id_tuteur = "'.$_GET["id_tuteur"].'"
                                        ');
                                        if(!$result){
                        echo "\nPDO::errorInfo():\n";
                        print_r($dbh->errorInfo());
                    }
                }
                echo "<div class='alert alert-success col-md-4'>Données modifiées</div> ";
                //-----------------------------------------------------
                
            }else{

                //-----------------------------------------------------
                $request = 'INSERT INTO tuteur
                            (nom_tuteur,prenom_tuteur,fonction_tuteur,telephone_tuteur,mail_tuteur,fk_entreprise,fk_utilisateur)
                            VALUES
                            ("'.$nom_tuteur.'","'.$prenom_tuteur.'","'.$fonction_tuteur.'","'.$telephone_tuteur.'","'.$mail_tuteur.'","'.$fk_entreprise.'","'.$fk_utilisateur.'")
                            ';
                            $result = $dbh->query($request);
                if(!$result){
                    echo "\nPDO::errorInfo():\n";
                    print_r($dbh->errorInfo());
                }else{
                    echo "<div class='alert alert-success col-md-4'>Tuteur enregistré</div> ";
                }
                //-----------------------------------------------------

            }
        }else{
            if(isset($_GET["id_tuteur"])){

                //-----------------------------------------------------
                $request = 'SELECT * FROM tuteur WHERE id_tuteur = '.$_GET["id_tuteur"].'';
                $tabResult = select($request,$dbh,"");
                foreach($tabResult as $key=>$value){
                    $$key = $tabResult[$key];
                }
                //-----------------------------------------------------

            }else{

                //-----------------------------------------------------
                $fk_utilisateur = $_SESSION["id"];
                $fk_entreprise = "";
                $nom_tuteur = "";
                $prenom_tuteur = "";
                $telephone_tuteur = "";
                $mail_tuteur = "";
                $fonction_tuteur = "";
                //-----------------------------------------------------

            }
        }
    }
}

function update($dbh,$table,$where,$where2,$text = "Données Modifiées"){
    foreach($_POST as $key=>$value){
        if($key == "envoi_stage"){
            $button = "envoi_stage";
        }else{
            $result = $dbh->query('UPDATE '.$table.'
                                SET '.$key.' = "'.$_POST[$key].'"
                                WHERE '.$where.' = "'.$where2.'"
                                ');
            if(!$result){
                echo "\nPDO::errorInfo():\n";
                print_r($dbh->errorInfo());
            }
        }
    }
    echo "<div class='alert alert-success col-md-4'>$text</div> ";

}

function insertTuteur($dbh,$fk_utilisateur){

    foreach($_POST as $key=>$value){
        $$key = $_POST[$key];
    }
    $request = 'INSERT INTO tuteur
                    (nom_tuteur,prenom_tuteur,fonction_tuteur,telephone_tuteur,mail_tuteur,fk_entreprise,fk_utilisateur)
                    VALUES
                    ("'.$nom_tuteur.'","'.$prenom_tuteur.'","'.$fonction_tuteur.'","'.$telephone_tuteur.'","'.$mail_tuteur.'","'.$fk_entreprise.'","'.$fk_utilisateur.'")
                    ';
        $result = $dbh->query($request);
        if(!$result){
            echo "\nPDO::errorInfo():\n";
            print_r($dbh->errorInfo());
        }else{
            echo "<div class='alert alert-success col-md-4'>Tuteur enregistré</div> ";
        }
}

function tryCatch($dbh,$request,$array,$bool = false){
    try {
        $sth = $dbh->prepare($request);
        $sth->execute($array);
        if($bool == true){
            $result = $sth->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}

function tryCatchAll($dbh,$request,$array){
    try {
        $sth = $dbh->prepare($request);
        foreach($array as $key=>$value){
            if($key == ':offset'){
                $sth->bindValue($key,$value,\PDO::PARAM_INT);
            }else{
                $sth->bindValue($key,$value);
            }
        }
         $sth->execute();
            $result = $sth->fetchAll(PDO::FETCH_ASSOC);
            if($result){
                return $result;
            }

    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}

function rechercher(){
    ?>
    <div class="d-flex col-md-9 justify-content-between" style="padding-left:0">
        <form method='post' action='' class="form-inline d-flex justify-content-between col-md-5" style="padding-left:0">
            <div class="form-group" style="padding-left:0px">
                <input name="recherche" class="form-control"/>
            </div>
            <button type='submit' class="btn btn-outline-secondary"><i class="fas fa-search"></i></button>
        </form>
    </div>
    <br/>
    <?php
}

function requestRecherche($dbh,$request,$erreur = "",$array = array()){
    $tabResult = tryCatchAll($dbh,$request,$array);
    if(empty($tabResult)){
        if(!empty($erreur)){
            if(empty($_POST["recherche"])){
                echo "<div class='alert alert-danger col-md-auto d-inline-block'>".$erreur." renseigné(e)</div>";
            }else{
                echo "<div class='alert alert-danger col-md-auto d-inline-block'>".$erreur." correspondant à la recherche</div>";
            }
        }
    }else{
        return $tabResult;
    }
}

function pagination($offset,$nombre,$recherche,$page){
    ?>
        <div class="row col-md-9 justify-content-end" style="padding-right:0px">
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="/Convention/Administration/<?=$page;?>offset=<?=$offset-5;?>&recherche=<?=$recherche;?>">Précédent</a></li>
                    <?php
                    if((($offset)/5) != 0){
                        ?>
                        <li class="page-item"><a class="page-link" href="/Convention/Administration/<?=$page;?>offset=<?=((($offset)/5))*5-5?>&recherche=<?=$recherche;?>"><?=(($offset)/5)?></a></li>
                        <?php
                    }
                    ?>
                    <li class="page-item"><a class="page-link" href="/Convention/Administration/<?=$page;?>offset=<?=((($offset)/5)+1)*5-5?>&recherche=<?=$recherche;?>"><?=(($offset)/5)+1?></a></li>
                    <?php
                    if(((($offset)/5)+2)*5-5 < $nombre){
                        ?>
                        <li class="page-item"><a class="page-link" href="/Convention/Administration/<?=$page;?>offset=<?=((($offset)/5)+2)*5-5?>&recherche=<?=$recherche;?>"><?=(($offset)/5)+2?></a></li>
                        <?php
                    }
                    if($offset+5 < $nombre){
                        ?>
                            <li class="page-item"><a class="page-link" href="/Convention/Administration/<?=$page;?>offset=<?=$offset+5;?>&recherche=<?=$recherche;?>">Suivant</a></li>
                        <?php
                    }else{
                        ?>
                            <li class="page-item disabled"><a class="page-link" href="/Convention/Administration/<?=$page;?>offset=<?=$offset+5;?>&recherche=<?=$recherche;?>">Suivant</a></li>
                        <?php
                    }
                    ?>
                </ul>
            </nav>
        </div>
    <?php
}

function isOffset(){
    if(isset($_GET["offset"]) && $_GET["offset"] > 0){
        $offset = intval($_GET["offset"]);
    }else{
        $offset = 0;
    }
    if(!empty($_POST["recherche"])){
        $offset = 0;
    }
    return $offset;
}

function varRecherche(){
    if(!empty($_POST["recherche"])){
        $recherche = $_POST["recherche"];
    }elseif(!empty($_GET["recherche"])){
        $recherche = $_GET["recherche"];
    }
    return $recherche;
}

class Carde{

   public $onglet ;
   public $nom ;
   public $prenom ;
   public $lien_modification ;
   public $lien_suppression ;
   public $adresse ;
   public $code_postal ;
   public $ville ;
   public $telephone ;
   public $classe ;
   public $icon ;
   public $modification = "Modification" ;
   public $entreprise;
   public $fonction;
   public $representant;
   public $date_debut;
   public $date_fin;
   public $id_stage;

   public function card(){
       ?>
    <div class="col-md-9" style="padding-left:0px">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div>
                    <?php
                    if($this->onglet == "entreprise"){
                        ?>
                        <strong ><?=$this->nom;?></strong>
                        <?php
                    }else{
                        ?>
                        <strong ><?=$this->nom." ".$this->prenom;?></strong>
                        <?php
                    }
                    ?>
                </div>
                <div>
                    <?php
                    if($this->onglet == "stage"){
                        ?>
                        <a href="../pdf/pdf.php?id_stage=<?=$this->id_stage?>" class="btn btn-outline-info btn-sm">PDF</a>
                        <?php
                    }
                    ?>
                    <a href="<?=$this->lien_modification?>" class="btn btn-primary btn-sm"><?=$this->modification?></a>
                    <a href="<?=$this->lien_suppression?>" class="btn btn-info btn-sm">Suppression</a>
                </div>
            </div>
            <div class="card-body">
                <?php if($this->onglet == "stagiaire"){
                    ?>
                    <!-- <h5 class="card-title"></h5> -->
                    <p class="card-text"><i class="far fa-address-card"></i> <?=$this->adresse.", ".$this->code_postal." ".$this->ville?></p>
                    <p class="card-text"><i class="fas fa-phone"></i> <?=$this->telephone?></p>
                    <p class="card-text"><i class="fas fa-graduation-cap"></i><?=$this->classe?></p>
                    <?php

                }else if($this->onglet == "entreprise"){
                    ?>
                    <p class="card-text"><i class="far fa-address-card"></i> <?=$this->adresse.", ".$this->code_postal." ".$this->ville?></p>
                    <p class="card-text"><i class="fas fa-phone"></i> <?=$this->telephone?></p>
                    <p class="card-text"><i class="fas fa-briefcase"></i> <?=$this->entreprise?></p>
                    <?php    

                }else if($this->onglet == "referent"){
                    ?>
                    <p class="card-text"><i class="fas fa-briefcase"></i> <?=$this->fonction?></p>
                    <p class="card-text"><i class="fas fa-phone"></i> <?=$this->telephone?></p>
                    <p class="card-text"><i class="fas fa-school"></i> <?=$this->entreprise?></p>
                    <?php

                }else if($this->onglet == "etablissement"){
                    ?>
                    <p class="card-text"><i class="fas fa-user-alt"></i> <?=$this->representant?></p>
                    <p class="card-text"><i class="far fa-address-card"></i> <?=$this->numero." ". $this->adresse.", ".$this->code_postal." ".$this->ville?></p>
                    <p class="card-text"><i class="fas fa-phone"></i> <?=$this->telephone?></p>
                    
                    <?php

                }else if($this->onglet == "tuteur"){
                    if($this->fonction != ""){
                        ?>
                        <p class="card-text"><i class="fas fa-briefcase"></i> <?=$this->fonction?></p>
                        <?php
                    }
                    if($this->telephone != ""){
                        ?>
                        <p class="card-text"><i class="fas fa-phone"></i> <?=$this->telephone?></p>
                        <?php
                    }
                    if($this->entreprise != ""){
                        ?>
                        <p class="card-text"><i class="fas fa-building"></i> <?=$this->entreprise?></p>
                        <?php
                    }
                    ?>
                    
                    <?php
                }else if($this->onglet == "stage"){
                    ?>
                    <p class="card-text"><i class="far fa-calendar-alt"></i> <?="Du ".$this->date_debut." au ".$this->date_fin?></p>
                    <p class="card-text"><i class="fas fa-building"></i> <?=$this->entreprise?></p>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
    <br/>
<?php
   }

}

function selectPagination($request,$dbh,$offset,$lien,$recherche = ""){
    $result = selectAll($request,$dbh);
    $nombre = count($result);
    if($nombre > 5){
        pagination($offset,$nombre,$recherche,$lien);
    }
}

function tryPrepare($dbh,$request,$array,$fetch = false){

    try{
        $sth= $dbh->prepare($request);
        $sth->execute($array);
        if($fetch == true){
            $result = $sth->fetch(PDO::FETCH_ASSOC);
        }
    }
    catch(PDOException $e){
        echo $e->getMessage();
    }

    if($fetch){
        return $result;
    }
}

function tryPrepareAll($dbh,$request,$array,$fetch = false){

    try{
        $sth= $dbh->prepare($request);
        $sth->execute($array);
        if($fetch = true){
            $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    catch(PDOException $e){
        echo $e->getMessage();
    }

    if($fetch){
        return $result;
    }
}

function supprimer($dbh,$table,$where,$id,$erreur = ""){

    verifToken();
    if(!verifDroitSuppression($dbh,$table,$id)){return;}
    $request = 'DELETE FROM '.$table.' WHERE '.$where.' = :id ';
    $array = array(':id'=>$id);
    tryPrepare($dbh,$request,$array);

    if(!empty($erreur)){
        echo "<div class='alert alert-danger col-md-auto d-inline-block'>".$erreur." supprimé(e)";
    }
}

function verifToken(){
    if($_SESSION["token"] != $_GET["token"]){die("Vous n'avez pas la permission pour effectuer cette action");}
}


function verifDroitSuppression($dbh,$table,$idTable){
    $result;
    if(empty($_SESSION["profile"])){return 0;}
    if($_SESSION["profile"] == "administrateur"){return 1;}
    if($_SESSION["profile"] != "etudiant"){return 0;}
    if($table == "referent" || $table == "etablissement" || $table == "utilisateur" || $table == "stagiaire"){return 0;}

    $request = 'SELECT fk_utilisateur_'.$table.' FROM '.$table.' WHERE id_'.$table.' = :id';
    $array = array(':id'=>$idTable);
    $result = tryPrepare($dbh,$request,$array,true);
    $fkUtilisateur = $result["fk_utilisateur_".$table];
    $idUtilisateur = $_SESSION["id"];
    if($fkUtilisateur != $idUtilisateur){return 0;}
    return 1;
}

function redirect($page){
    header("Location: $devHost/Convention/$page");
}

function refresh($refresh,$url){
    header( "Refresh:$refresh; url=http://www.convention.isgbx.fr/Convention/$url", true);
}

function titre(){
    ?>
    <div class="header">
            <div class ="logo">
                <img src="/Convention/images/ISG_logo.jpg">
                <h1>CONVENTION DE STAGE ETUDIANT
                    <br/>
                    <span>Année universitaire 2020/21</span>
                </h1>
                <?php
                if($_GET["controller"] != "authentification"){
                    ?>
                    <button type="button" class="btn btn-light"><a href="/Convention/index.php?controller=deconnexion" >Deconnexion</a></button>
                    <?php
                    }
                    ?>
            </div>
        </div>
        <br/>

        <div class="modal fade" id="documentNecessaire" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Liste des documents nécessaires pour remplir les formulaires</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">fermer</button>
                </div>
                </div>
            </div>
        </div>
    <?php
}

function navigation($dbh){
    if($_GET["controller"] != "authentification"){
        $nav = new \Navigation\Navigation();
        $navS = new \Navigation\Stagiaire($dbh);
    }
}

function head(){
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="/Convention/src/style.css"/>
    <title>ISG convention de stage</title> 
    <?php
}

function script(){
    ?>
    <br/>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script src="/Convention/src/script.js"></script>
    <?php
}
