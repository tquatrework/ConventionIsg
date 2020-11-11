<?php
namespace Form;
use \PDO;
class Etablissement extends Form{
    public function __construct($dbh){
        $bool = $this->logique($dbh);
        if($bool ==1){
            ?>
            <h3><?=$this->titre_form?> etablissement</h3> 
            <form action="" method="post"> 
                <div class="form-row">
                    <?php
                    $this->nom();
                    ?>
                </div>
                <?php
                $this->adresse();
                ?>
                <hr/>
                <h6>Representant</h6>
                <?php
                $this->representant();
                echo "<br/>";
                $this->button();
                ?>
                <br/>
            </form>
            <?php
        }
    }
}