<?php

namespace View;

class Authentification extends View{

    public $table = "authentification";
    public $errors_Array = array();
    public $success_Array = array();

    public function authentificationTemplate(){

        ?>
        <div class="form-authentification">
        <h2>Authentification</h2>
        <?php
        $this->message();
        ?>
        <div class="authentification">

            <form action="" method="post" >
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="identifiant">Email</label>
                        <input autofocus type="email" name="identifiant" class="form-control"/>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control"/>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-2">
                        <button type='submit' class="btn btn-primary" name="envoi_authentification">Connexion</button>
                    </div>

                    <div class="form-group col-md-2">
                        <a class="btn btn-info" href="<?php $devHost;?>/Convention/index.php?controller=authentification&task=inscription">Inscription</a>
                    </div>

                    <div class="form-group col-md-12">
                        <a href="/Convention/index.php?controller=authentification&task=recupPassword" style="text-decoration:underligne;color:blue">Mot de passe oublié?</a>
                    </div>
                </div>
            </form>

        </div>
    </div>

    <?php

    }

    public function message(){

        if (count($this->errors_Array) > 0) : ?>
            <div class="alert alert-danger col-md-auto d-inline-block">
                <?php echo $this->errors_Array[0] ?>
            </div>
          <?php  endif ?>
          
          <?php  if (count($this->success_Array) > 0) : ?>
            <div class="alert alert-info col-md-auto d-inline-block">
                <?php foreach ($this->success_Array as $error) : ?>
                  <?php echo $error ?>
                <?php endforeach ?>
            </div>
          <?php  endif ?>
                    <?php
    }

    public function pushError($error){
        array_push($this->errors_Array,$error);
    }

    public function pushSuccess($success){
        array_push($this->success_Array,$success);
    }

    public function recupPasswordTemplate(){
        ?>
        <h2>Modification mot de passe</h2>
        <?php
        $this->message();
        ?>
        <br/>
        <div class="authentification">
            <form action="" method="post">
                <div class="form-row">
                    <div class="form-group col-md-5">
                        <input autofocus type="email" name="email" class="form-control" />
                        <small class="form-text text-muted">Veuillez renseigner l'identifiant/email du compte</small>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <button type='submit' class="btn btn-primary" name="envoi_email">Envoyer</button>
                    </div>
                    <div class="form-group col-md-2">
                        <a href="/Convention/index.php?controller=authentification&task=authentification" class="btn btn-secondary">Retour</a>
                    </div>
                </div>
            </form>
        </div>
        <?php
    }

    public function inscriptionTemplate(){
        ?>
        <h2>Inscription</h2>
        <?php
        $this->message();
        ?>
        <form action="" method="post" class="form-inscription">

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="identifiant">Email</label>
                    <input autofocus type="identifiant" id="identifiant" name="identifiant" class="form-control"/>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" class="form-control"/>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="verif_password">Confirmation mot de passe</label>
                    <input type="password" id="verif_password" name="verif_password" class="form-control"/>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-2">
                    <button type="submit" class="btn btn-info" name="envoi_inscription">Inscription</button>
                </div>
                <div class="form-group col-md-2">
                    <a href="/Convention/index.php?controller=authentification&task=authentification" class="btn btn-secondary">retour</a>
                </div>
            </div>

        </form>
        <?php

    }

    public function newPasswordTemplate(){
        ?>
        <h2>Changement mot de passe</h2>
        <?php
        $this->message();
        ?>

        <div class="authentification">
            <form action="" method="post">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="nouveau_mdp">Nouveau mot de passe</label>
                        <input type="password" autofocus type="nouveau_mdp" name="nouveau_mdp" class="form-control" />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="confirmation_mdp">Confirmation</label>
                        <input autofocus type="password" name="confirmation_mdp" class="form-control" />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <button type='submit' class="btn btn-primary" name="envoi_nouveau_mdp">Envoyer</button>
                    </div>
                </div>
            </form>
        </div>
        <?php
    }

}