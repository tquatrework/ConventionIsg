<?php
namespace Form;
use \PDO;
class Referent extends Form{

    public function __construct($dbh){

        $bool = $this->logique($dbh);
            
        if($bool == 1){
            ?>
            <h3><?=$this->titre_form?> referent</h3>
            <form action="" method="post">
                <?php
                $this->etablissement($dbh);
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

    public function etablissement($dbh,$col = 4){
        $resultEtablissement = $this->fetchTableEntreprise($dbh,"etablissement","","",true,true);
        ?>
        <div class="form-row">
            <div class="form-group col-md-<?=$col?>">
                <label>Etablissement</label>
                <select class="form-control" style="background-color:#e8f0ff" name="fk_enseignement_referent" id="fk_enseignement_referent">
                    <?php
                    foreach($resultEtablissement as $key=>$value){
                        
                        $selected = $this->selected($value["id_etablissement"],$this->tab["fk_enseignement_referent"]);
                        ?>
                        <option <?=$selected?> value="<?=$value["id_etablissement"]?>"><?=$value["nom_etablissement"]?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <?php
    }
}
