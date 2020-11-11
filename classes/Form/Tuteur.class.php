<?php
namespace Form;
use \PDO;
class Tuteur extends Form{

    public function __construct($dbh){

        $bool = $this->logique($dbh);

        if($bool == 1){
            ?>
            <h3><?=$this->titre_form?> tuteur</h3>
            <form action="" method="post" class="needs-validation" novalidate>
                <?php
                $this->entreprise($dbh);
                $this->nomPrenom(); 
                $this->telephoneMail();
                $this->discipline();
                echo "<br/>";
                $this->button();
                ?>
            </form>
            <?php
        }
    }

    public function entreprise($dbh,$col = 4){
        if($_SESSION["profile"] == "etudiant"){
            $id = $this->id;
        }else{
            $id = $this->tab["fk_utilisateur_tuteur"];
        }
        $resultEntreprise = $this->fetchTableEntreprise($dbh,"entreprise","fk_utilisateur_entreprise",$id,true);
        ?>
        <div class="form-row">
            <div class="form-group col-md-<?=$col?>">
                <label>Entreprise</label>
                <select class="form-control" required style="background-color:#e8f0ff" name="fk_entreprise" id="fk_entreprise">
                    <?php
                    foreach($resultEntreprise as $key=>$value){

                        if($value["id_entreprise"] == $this->tab["fk_entreprise"]){
                            $selected = "selected";
                        }else{
                            $selected = "";
                        }

                        ?>
                        <option value="<?=$value["id_entreprise"]?>" <?=$selected?> ><?=$value["nom_entreprise"]?></option>
                        <?php

                    }
                    ?>
                </select>
                <div class="invalid-feedback">
                    Champ obligatoire
                </div>
            </div>
        </div>
        <?php
    }

}
