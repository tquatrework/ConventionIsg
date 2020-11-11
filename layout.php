
<!DOCTYPE html>
<html lang="fr">

    <head> 
       <?php head(); ?>
    </head>

    <body>
        <?php
        titre();
        navigation($dbh);
        echo $pageContent;
        script();

        ?>
        <?php if(isset($_SESSION["profile"])):?>
            <?php if( $_SESSION["profile"] == "etudiant" ):?>
                <?php
                $rgpd = new \Model\Rgpd;
                $status = $rgpd->statusRgpd();
                ?>
                <?php if($status["rgpd"] != "accepte" && $status["rgpd"] != "refuse"): ?>
                    <div class="rgpd">
                        <div class="col-md-9 texte">
                            J'affirme savoir que mes données seront traitées en conformité avec le RGPD suivant les procédures en cours à l'ISG et disponibles à l'adresse suivante :
                            <a href="https://www.isg.fr/mentions-legales">https://www.isg.fr/mentions-legales</a> 
                        </div>
                        <div class="col-md-3 d-flex flex-column justify-content-between">
                            <a href="index.php?controller=Rgpd&task=valider" class="btn-sm btn-success BtnRgpd" >Valider</a>
                            <a href="index.php?controller=Rgpd&task=fermer" class="btn-sm btn-danger BtnRgpd">Fermer</a>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif;?>
        <?php endif;?>
    </body>

</html>

