<?php

class NavigationStagiaireE{

    public $id;
    public $nom;
    public $prenom;
    public $entreprise;
    public $linkStagiaire;
    public $linkEntreprise;
    public $linkStage;
    public $linkTuteur;
    public $linkPdf;

    public function nav(){
?>
<ul class="nav nav-pills">
    <li class="nav-item">
        <a class="nav-link <?=$this->linkStagiaire?>" href="/Convention/Administration/mod_stagiaire.php?id=<?=$this->id?>"><?=$this->nom." ".$this->prenom?> </a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?=$this->linkEntreprise?>"
            href="/Convention/Administration/entreprise.php?id=<?=$this->id?>">Entreprise</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?=$this->linkStage?>" href="/Convention/Administration/stage.php?id=<?=$this->id?>">Stage</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?=$this->linkTuteur?>" href="/Convention/Administration/tuteur.php?id=<?=$this->id?>">Tuteur</a>
    </li>
</ul>
<br/>
<?php
}
}

class Navigatione{
    
    public $linkStagiaire;
    public $linkEntreprise;
    public $linkStage;
    public $linkTuteur;
    public $linkEtablissement;
    public $linkReferent;
    public $administration;
    public $entreprise = "/entreprise.php";
    public $stage = "/stage.php";
    public $tuteur = "/tuteur.php";
    public $etablissement = "/liste_etablissement.php";
    public $referent = "/liste_referent.php";
    
    public function nav(){
        ?>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link <?=$this->linkStagiaire?>" href="/Convention<?=$this->administration?>">Stagiaire</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?=$this->linkEntreprise?>" href="/Convention<?=$this->administration.$this->entreprise;?>">Entreprise</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?=$this->linkStage?>" href="/Convention<?=$this->administration.$this->stage?>">Stage</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?=$this->linkTuteur?>" href="/Convention<?=$this->administration.$this->tuteur?>">Tuteur</a>
            </li>
            <?php
            if(isset($_SESSION["utilisateur"])){
                if($_SESSION["utilisateur"] == "administrateur"){
                    ?>
                    <li class="nav-item">
                        <a class="nav-link <?=$this->linkEtablissement?>" href="/Convention<?=$this->administration.$this->etablissement?>">Etablissement</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?=$this->linkReferent?>" href="/Convention<?=$this->administration.$this->referent?>">Référent</a>
                    </li>
                    <?php
                }
            }
            ?>
        </ul>
        <br/>

<?php
    }

}

class Stagiaire{

    public function nom($nom,$col = 4){
        ?>
        <div class="form-group col-md-<?=$col?>">
                <label>Nom</label>
                <input type="text" id="nom" name="nom" class="form-control" value="<?=$nom?>" style="background-color:#e8f0ff">
            </div>
        <?php
    }

    public function prenom($prenom,$col = 4){
        ?>
        <div class="form-group col-md-<?=$col?>">
                <label>Prénom</label>
                <input type="text" id="prenom" name="prenom" class="form-control" value="<?=$prenom?>" style="background-color:#e8f0ff">
            </div>
        <?php
    }

    public function dateNaissance($date_naissance,$col = 4){
        ?>
        <div class="form-group col-md-<?=$col?>">
                <label>Date de naissance</label>
                <input type="text" id="date_naissance" name="date_naissance" value="<?=$date_naissance?>" class="form-control" style="background-color:#e8f0ff">
        </div>
        <?php
    
    }
    public function nationalite($nationalite,$col = 4){
        ?>
        <div class="form-group col-md-<?=$col?>">
                <label>Nationalité</label>
                <select name="nationalite" id="nationalite" class="form-control" style="background-color:#e8f0ff">
                    <?php if(isset($nationalite) && $nationalite != ""){
                        echo "<option value=$nationalite>$nationalite</option>";
                    }else{
                        echo "<option value=''></option>";
                    }
                    ?>
                    <option value="Afghane">Afghane (Afghanistan)</option>
                    <option value="Albanaise">Albanaise (Albanie)</option>
                    <option value="Algérienne">Algérienne (Algérie)</option>
                    <option value="Allemande">Allemande (Allemagne)</option>
                    <option value="Americaine">Americaine (États-Unis)</option>
                    <option value="Andorrane">Andorrane (Andorre)</option>
                    <option value="Angolaise">Angolaise (Angola)</option>
                    <option value="Antiguaise-et-Barbudienne">Antiguaise-et-Barbudienne (Antigua-et-Barbuda)</option>
                    <option value="Argentine">Argentine (Argentine)</option>
                    <option value="Armenienne">Armenienne (Arménie)</option>
                    <option value="Australienne">Australienne (Australie)</option>
                    <option value="Autrichienne">Autrichienne (Autriche)</option>
                    <option value="Azerbaïdjanaise">Azerbaïdjanaise (Azerbaïdjan)</option>
                    <option value="Bahamienne">Bahamienne (Bahamas)</option>
                    <option value="Bahreinienne">Bahreinienne (Bahreïn)</option>
                    <option value="Bangladaise">Bangladaise (Bangladesh)</option>
                    <option value="Barbadienne">Barbadienne (Barbade)</option>
                    <option value="Belge">Belge (Belgique)</option>
                    <option value="Belizienne">Belizienne (Belize)</option>
                    <option value="Béninoise">Béninoise (Bénin)</option>
                    <option value="Bhoutanaise">Bhoutanaise (Bhoutan)</option>
                    <option value="Biélorusse">Biélorusse (Biélorussie)</option>
                    <option value="Birmane">Birmane (Birmanie)</option>
                    <option value="Bissau">Bissau-Guinéenne (Guinée-Bissau)</option>
                    <option value="Bolivienne">Bolivienne (Bolivie)</option>
                    <option value="Bosnienne">Bosnienne (Bosnie-Herzégovine)</option>
                    <option value="Botswanaise">Botswanaise (Botswana)</option>
                    <option value="Brésilienne">Brésilienne (Brésil)</option>
                    <option value="Britannique">Britannique (Royaume-Uni)</option>
                    <option value="Brunéienne">Brunéienne (Brunéi)</option>
                    <option value="Bulgare">Bulgare (Bulgarie)</option>
                    <option value="Burkinabée">Burkinabée (Burkina)</option>
                    <option value="Burundaise">Burundaise (Burundi)</option>
                    <option value="Cambodgienne">Cambodgienne (Cambodge)</option>
                    <option value="Camerounaise">Camerounaise (Cameroun)</option>
                    <option value="Canadienne">Canadienne (Canada)</option>
                    <option value="verdienne">Cap-verdienne (Cap-Vert)</option>
                    <option value="Centrafricaine">Centrafricaine (Centrafrique)</option>
                    <option value="Chilienne">Chilienne (Chili)</option>
                    <option value="Chinoise">Chinoise (Chine)</option>
                    <option value="Chypriote">Chypriote (Chypre)</option>
                    <option value="Colombienne">Colombienne (Colombie)</option>
                    <option value="Comorienne">Comorienne (Comores)</option>
                    <option value="Congolaise">Congolaise (Congo-Brazzaville)</option>
                    <option value="Congolaise">Congolaise (Congo-Kinshasa)</option>
                    <option value="COCookienneK">Cookienne (Îles Cook)</option>
                    <option value="Costaricaine">Costaricaine (Costa Rica)</option>
                    <option value="Croate">Croate (Croatie)</option>
                    <option value="Cubaine">Cubaine (Cuba)</option>
                    <option value="Danoise">Danoise (Danemark)</option>
                    <option value="Djiboutienne">Djiboutienne (Djibouti)</option>
                    <option value="Dominicaine">Dominicaine (République dominicaine)</option>
                    <option value="Dominiquaise">Dominiquaise (Dominique)</option>
                    <option value="Égyptienne">Égyptienne (Égypte)</option>
                    <option value="Émirienne">Émirienne (Émirats arabes unis)</option>
                    <option value="Équato-guineenne">Équato-guineenne (Guinée équatoriale)</option>
                    <option value="Équatorienne">Équatorienne (Équateur)</option>
                    <option value="Érythréenne">Érythréenne (Érythrée)</option>
                    <option value="Espagnole">Espagnole (Espagne)</option>
                    <option value="Est-timoraise">Est-timoraise (Timor-Leste)</option>
                    <option value="Estonienne">Estonienne (Estonie)</option>
                    <option value="Éthiopienne">Éthiopienne (Éthiopie)</option>
                    <option value="Fidjienne">Fidjienne (Fidji)</option>
                    <option value="Finlandaise">Finlandaise (Finlande)</option>
                    <option value="Française">Française (France)</option>
                    <option value="Gabonaise">Gabonaise (Gabon)</option>
                    <option value="Gambienne">Gambienne (Gambie)</option>
                    <option value="Georgienne">Georgienne (Géorgie)</option>
                    <option value="Ghanéenne">Ghanéenne (Ghana)</option>
                    <option value="Grenadienne">Grenadienne (Grenade)</option>
                    <option value="Guatémaltèque">Guatémaltèque (Guatemala)</option>
                    <option value="Guinéenne">Guinéenne (Guinée)</option>
                    <option value="Guyanienne">Guyanienne (Guyana)</option>
                    <option value="Haïtienne">Haïtienne (Haïti)</option>
                    <option value="Hellénique">Hellénique (Grèce)</option>
                    <option value="Hondurienne">Hondurienne (Honduras)</option>
                    <option value="Hongroise">Hongroise (Hongrie)</option>
                    <option value="Indienne">Indienne (Inde)</option>
                    <option value="Indonésienne">Indonésienne (Indonésie)</option>
                    <option value="Irakienne">Irakienne (Iraq)</option>
                    <option value="Iranienne">Iranienne (Iran)</option>
                    <option value="Irlandaise">Irlandaise (Irlande)</option>
                    <option value="Islandaise">Islandaise (Islande)</option>
                    <option value="Israélienne">Israélienne (Israël)</option>
                    <option value="Italienne">Italienne (Italie)</option>
                    <option value="Ivoirienne">Ivoirienne (Côte d'Ivoire)</option>
                    <option value="Jamaïcaine">Jamaïcaine (Jamaïque)</option>
                    <option value="Japonaise">Japonaise (Japon)</option>
                    <option value="Jordanienne">Jordanienne (Jordanie)</option>
                    <option value="Kazakhstanaise">Kazakhstanaise (Kazakhstan)</option>
                    <option value="Kenyane">Kenyane (Kenya)</option>
                    <option value="Kirghize">Kirghize (Kirghizistan)</option>
                    <option value="Kiribatienne">Kiribatienne (Kiribati)</option>
                    <option value="Kittitienne">Kittitienne et Névicienne (Saint-Christophe-et-Niévès)</option>
                    <option value="Koweïtienne">Koweïtienne (Koweït)</option>
                    <option value="Laotienne">Laotienne (Laos)</option>
                    <option value="Lesothane">Lesothane (Lesotho)</option>
                    <option value="Lettone">Lettone (Lettonie)</option>
                    <option value="Libanaise">Libanaise (Liban)</option>
                    <option value="Libérienne">Libérienne (Libéria)</option>
                    <option value="Libyenne">Libyenne (Libye)</option>
                    <option value="Liechtensteinoise">Liechtensteinoise (Liechtenstein)</option>
                    <option value="Lituanienne">Lituanienne (Lituanie)</option>
                    <option value="Luxembourgeoise">Luxembourgeoise (Luxembourg)</option>
                    <option value="Macédonienne">Macédonienne (Macédoine)</option>
                    <option value="Malaisienne">Malaisienne (Malaisie)</option>
                    <option value="Malawienne">Malawienne (Malawi)</option>
                    <option value="Maldivienne">Maldivienne (Maldives)</option>
                    <option value="Malgache">Malgache (Madagascar)</option>
                    <option value="Maliennes">Maliennes (Mali)</option>
                    <option value="Maltaise">Maltaise (Malte)</option>
                    <option value="Marocaine">Marocaine (Maroc)</option>
                    <option value="Marshallaise">Marshallaise (Îles Marshall)</option>
                    <option value="Mauricienne">Mauricienne (Maurice)</option>
                    <option value="Mauritanienne">Mauritanienne (Mauritanie)</option>
                    <option value="Mexicaine">Mexicaine (Mexique)</option>
                    <option value="Micronésienne">Micronésienne (Micronésie)</option>
                    <option value="Moldave">Moldave (Moldovie)</option>
                    <option value="Monegasque">Monegasque (Monaco)</option>
                    <option value="Mongole">Mongole (Mongolie)</option>
                    <option value="Monténégrine">Monténégrine (Monténégro)</option>
                    <option value="Mozambicaine">Mozambicaine (Mozambique)</option>
                    <option value="Namibienne">Namibienne (Namibie)</option>
                    <option value="Nauruane">Nauruane (Nauru)</option>
                    <option value="Néerlandaise">Néerlandaise (Pays-Bas)</option>
                    <option value="Néo-Zélandaise">Néo-Zélandaise (Nouvelle-Zélande)</option>
                    <option value="Népalaise">Népalaise (Népal)</option>
                    <option value="Nicaraguayenne">Nicaraguayenne (Nicaragua)</option>
                    <option value="Nigériane">Nigériane (Nigéria)</option>
                    <option value="Nigérienne">Nigérienne (Niger)</option>
                    <option value="Niuéenne">Niuéenne (Niue)</option>
                    <option value="Nord-coréenne">Nord-coréenne (Corée du Nord)</option>
                    <option value="Norvégienne">Norvégienne (Norvège)</option>
                    <option value="Omanaise">Omanaise (Oman)</option>
                    <option value="Ougandaise">Ougandaise (Ouganda)</option>
                    <option value="Ouzbéke">Ouzbéke (Ouzbékistan)</option>
                    <option value="Pakistanaise">Pakistanaise (Pakistan)</option>
                    <option value="Palaosienne">Palaosienne (Palaos)</option>
                    <option value="Palestinienne">Palestinienne (Palestine)</option>
                    <option value="Panaméenne">Panaméenne (Panama)</option>
                    <option value="Papouane-Néo-Guinéenne">Papouane-Néo-Guinéenne (Papouasie-Nouvelle-Guinée)</option>
                    <option value="Paraguayenne">Paraguayenne (Paraguay)</option>
                    <option value="Péruvienne">Péruvienne (Pérou)</option>
                    <option value="Philippine">Philippine (Philippines)</option>
                    <option value="Polonaise">Polonaise (Pologne)</option>
                    <option value="Portugaise">Portugaise (Portugal)</option>
                    <option value="Qatarienne">Qatarienne (Qatar)</option>
                    <option value="Roumaine">Roumaine (Roumanie)</option>
                    <option value="Russe">Russe (Russie)</option>
                    <option value="Rwandaise">Rwandaise (Rwanda)</option>
                    <option value="Saint-Lucienne">Saint-Lucienne (Sainte-Lucie)</option>
                    <option value="SSaint-Marinaise">Saint-Marinaise (Saint-Marin)</option>
                    <option value="Saint-Vincentaise et Grenadine">Saint-Vincentaise et Grenadine (Saint-Vincent-et-les Grenadines)</option>
                    <option value="Salomonaise">Salomonaise (Îles Salomon)</option>
                    <option value="Salvadorienne">Salvadorienne (Salvador)</option>
                    <option value="Samoane">Samoane (Samoa)</option>
                    <option value="Santoméenne">Santoméenne (Sao Tomé-et-Principe)</option>
                    <option value="Saoudienne">Saoudienne (Arabie saoudite)</option>
                    <option value="Sénégalaise">Sénégalaise (Sénégal)</option>
                    <option value="Serbe">Serbe (Serbie)</option>
                    <option value="Seychelloise">Seychelloise (Seychelles)</option>
                    <option value="Sierra-Léonaise">Sierra-Léonaise (Sierra Leone)</option>
                    <option value="Singapourienne">Singapourienne (Singapour)</option>
                    <option value="Slovaque">Slovaque (Slovaquie)</option>
                    <option value="Slovène">Slovène (Slovénie)</option>
                    <option value="Somalienne">Somalienne (Somalie)</option>
                    <option value="Soudanaise">Soudanaise (Soudan)</option>
                    <option value="Sri-Lankaise">Sri-Lankaise (Sri Lanka)</option>
                    <option value="Sud-Africaine">Sud-Africaine (Afrique du Sud)</option>
                    <option value="Sud-Coréenne">Sud-Coréenne (Corée du Sud)</option>
                    <option value="Sud-Soudanaise">Sud-Soudanaise (Soudan du Sud)</option>
                    <option value="Suédoise">Suédoise (Suède)</option>
                    <option value="Suisse">Suisse (Suisse)</option>
                    <option value="Surinamaise">Surinamaise (Suriname)</option>
                    <option value="Swazie">Swazie (Swaziland)</option>
                    <option value="Syrienne">Syrienne (Syrie)</option>
                    <option value="Tadjike">Tadjike (Tadjikistan)</option>
                    <option value="Tanzanienne">Tanzanienne (Tanzanie)</option>
                    <option value="Tchadienne">Tchadienne (Tchad)</option>
                    <option value="Tchèque">Tchèque (Tchéquie)</option>
                    <option value="Thaïlandaise">Thaïlandaise (Thaïlande)</option>
                    <option value="Togolaise">Togolaise (Togo)</option>
                    <option value="Tonguienne">Tonguienne (Tonga)</option>
                    <option value="Trinidadienne">Trinidadienne (Trinité-et-Tobago)</option>
                    <option value="Tunisienne">Tunisienne (Tunisie)</option>
                    <option value="Turkmène">Turkmène (Turkménistan)</option>
                    <option value="Turque">Turque (Turquie)</option>
                    <option value="Tuvaluane">Tuvaluane (Tuvalu)</option>
                    <option value="Ukrainienne">Ukrainienne (Ukraine)</option>
                    <option value="Uruguayenne">Uruguayenne (Uruguay)</option>
                    <option value="Vanuatuane">Vanuatuane (Vanuatu)</option>
                    <option value="Vaticane">Vaticane (Vatican)</option>
                    <option value="Vénézuélienne">Vénézuélienne (Venezuela)</option>
                    <option value="Vietnamienne">Vietnamienne (Viêt Nam)</option>
                    <option value="Yéménite">Yéménite (Yémen)</option>
                    <option value="Zambienne">Zambienne (Zambie)</option>
                    <option value="Zimbabwéenne">Zimbabwéenne (Zimbabwe)</option>
                </select>
            </div>
        <?php
    }

    public function adresse($adresse,$col = 3){
        ?>
        <div class="form-group col-md-<?=$col?>">
                <label>Voie</label>
                <input type="text" id="adresse" name="adresse" value="<?=$adresse?>" class="form-control" style="background-color:#e8f0ff">
            </div>
        <?php
    
    }
    public function ville($ville,$col = 4){
        ?>
        <div class="form-group col-md-<?=$col?>">
                <label>Ville</label>
                <input type="text" id="ville" name="ville" value="<?=$ville?>" class="form-control" style="background-color:#e8f0ff">
            </div>
        <?php
    
    }
    public function telephone($telephone,$col = 4){
        ?>
       <div class="form-group col-md-<?=$col?>">
                <label>Téléphone</label>
                <input type="tel" id="telephone" name="telephone" value="<?=$telephone?>" pattern="[0-9]{3}[0-9]{3}[0-9]{4}" class="form-control" style="background-color:#e8f0ff">
            </div>
        <?php
    
    }
    public function classe($classe,$col = 4){
    
    ?>
        <div class="form-group col-md-<?=$col?>">
                <label for="classe">Classe</label>
                <select name="classe" id="classe" class="form-control" style="background-color:#e8f0ff">
                    <?php if(isset($classe) && $classe != ""){
                        echo "<option value=$classe>$classe</option>";
                    }else{
                        echo "<option value=''></option>";
                    }
                    ?>
                    <option value="MCS - 1re année">MCS - 1re année</option>
                    <option value="MCS - 2e année">MCS - 2e année</option>
                    <option value="MCS - 3e année">MCS - 3e année</option>
                    <option value="MCS - 4e année">MCS - 4e année</option>
                    <option value="MCS - 5e année">MCS - 5e année</option>
                </select>
            </div>
        <?php
    
}

    public function numeroSecu($numero_secu,$col = 8){
        ?>
    <div class="form-group col-md-<?=$col?>">
                    <label>Numéro sécurité social</label>
                    <input type="number" id="numero_secu" name="numero_secu" value="<?=$numero_secu?>" class="form-control" style="background-color:#e8f0ff">
                </div>
        <?php
    }

    public function adresseSecu($adresse_secu,$col = 4){
        ?>
    <div class="form-group col-md-<?=$col?>">
                    <label>Adresse</label>
                    <input type="text" id="adresse_secu" name="adresse_secu" value="<?=$adresse_secu?>" class="form-control" style="background-color:#e8f0ff">
                </div>
        <?php
    }

    public function villeSecu($ville_secu,$col = 4){
        ?>
    <div class="form-group col-md-4">
                    <label>Ville</label>
                    <input type="text" id="ville_secu" name="ville_secu" value="<?=$ville_secu?>" class="form-control" style="background-color:#e8f0ff">
                </div>
        <?php
    }

    public function numeroRue($numero_rue,$col = 1){
        ?>
        <div class="form-group col-md-<?=$col?>">
            <label>Numéro</label>
            <input class="form-control" style="background-color:#e8f0ff" type="text" id="numero_rue" name="numero_rue" value="<?=$numero_rue;?>">
        </div>
        <?php
    }

    public function codePostal($code_postal,$col = 4){
        ?>
        <div class="form-group col-md-<?=$col?>">
            <label>Code Postal</label>
            <input class="form-control" style="background-color:#e8f0ff" type="text" id="code_postal" name="code_postal" value="<?=$code_postal;?>">
        </div>
        <?php
    }

    public function complementAdresse($complement_adresse,$col = 4){
        ?>
        <div class="form-group col-md-<?=$col?>">
            <label>Complément d'adresse</label>
            <input class="form-control" style="background-color:#e8f0ff" type="text" id="complement_adresse" name="complement_adresse" value="<?=$complement_adresse;?>">
        </div>
        <?php
    }
}
class Entreprise{

    public function nomEntreprise($nom_entreprise,$col = 4){
        ?>

        <div class="form-group col-md-<?=$col?>">
            <label>La société ou organisme d'accueil</label>
            <input class="form-control" style="background-color:#e8f0ff" type="text" id="nom_entreprise" name="nom_entreprise" value="<?=$nom_entreprise;?>">
        </div>

        <?php
    } 

    public function numeroRue($numero_rue_entreprise,$col = 1){
        ?>
        <div class="form-group col-md-<?=$col?>">
            <label>Numéro</label>
            <input class="form-control" style="background-color:#e8f0ff" type="text" id="numero_rue_entreprise" name="numero_rue_entreprise" value="<?=$numero_rue_entreprise;?>">
        </div>
        <?php
    } 
    
    public function adresse($adresse_entreprise,$col = 3){
        ?>

        <div class="form-group col-md-<?=$col?>">
            <label>Voie</label>
            <input class="form-control" style="background-color:#e8f0ff" type="text" id="adresse_entreprise" name="adresse_entreprise" value="<?=$adresse_entreprise;?>">
        </div>

        <?php
    } 

    public function codePostal($code_postal_entreprise,$col = 2){
        ?>
        <div class="form-group col-md-<?=$col?>">
            <label>Code postal</label>
            <input class="form-control" style="background-color:#e8f0ff" type="number" id="code_postal_entreprise" name="code_postal_entreprise" value="<?=$code_postal_entreprise;?>">
        </div>
        <?php
    } 
    
    public function ville($ville_entreprise,$col = 2){
        ?>
        <div class="form-group col-md-<?=$col?>">
            <label>Ville</label>
            <input class="form-control" style="background-color:#e8f0ff" type="text" id="ville_entreprise" name="ville_entreprise" value="<?=$ville_entreprise;?>">
        </div>
        <?php
    }

    public function representant($representant_entreprise,$col = 4){
        ?>
        <div class="form-group col-md-<?=$col?>">
            <label for="representant_entreprise">Représentée par</label>
            <input class="form-control" style="background-color:#e8f0ff" type="text" name="representant_entreprise" id="representant_entreprise" value="<?=$representant_entreprise;?>">
        </div>
        <?php
    }

    public function fonction($fonction_representant_entreprise,$col = 4){
        ?>
        <div class="form-group col-md-<?=$col?>">
            <label>Fonction</label>
            <input class="form-control" style="background-color:#e8f0ff" type="text" name="fonction_representant_entreprise" id="fonction_representant_entreprise" value="<?=$fonction_representant_entreprise;?>">
        </div>
        <?php
    }

    public function telephone($telephone_entreprise,$col = 4){
        ?>
        <div class="form-group col-md-<?=$col?>">
            <label>Téléphone</label>
            <input class="form-control" style="background-color:#e8f0ff" type="tel" id="telephone_entreprise" name="telephone_entreprise" pattern="[0-9]{3}[0-9]{3}[0-9]{4}" value="<?=$telephone_entreprise;?>">
        </div>
        <?php
    }

    public function mail($mail_entreprise,$col = 4){
        ?>
        <div class="form-group col-md-<?=$col?>">
            <label>Email</label>
            <input class="form-control" style="background-color:#e8f0ff" type="mail" id="mail_entreprise" name="mail_entreprise" value="<?=$mail_entreprise;?>">
        </div>
        <?php
    }

    public function secteurActivite($secteur_activite_entreprise,$col = 4){
        ?>
        <div class="form-group col-md-<?=$col?>">
            <label for="secteur_activite_entreprise">Secteur d'activité</label>
            <select class="form-control" style="background-color:#e8f0ff" name="secteur_activite_entreprise" id="secteur_activite_entreprise">
                <option value="<?=$secteur_activite_entreprise;?>"><?=$secteur_activite_entreprise;?></option>
                <option value="Assurance, Banques et Organisme Financiers, Locations et Leasing">Assurance, Banques et Organisme Financiers, Locations et Leasing</option>
                <option value="Autres Activité d'Etudes, de conseil et d'Assistance, R&D">Autres Activité d'Etudes, de conseil et d'Assistance, R&D</option>
                <option value="Bâtiment, Génie Civil et Agricole">Bâtiment, Génie Civil et Agricole</option>
                <option value="Cabinet d'Expertise Comptable, d'Audit, d'Analyse Financière">Cabinet d'Expertise Comptable, d'Audit, d'Analyse Financière</option>
                <option value="Commerce, Distribution">Commerce, Distribution</option>
                <option value="Communication, Publicité, Régie Publicitaire, Relations Publiques">Communication, Publicité, Régie Publicitaire, Relations Publiques</option>
                <option value="Construction Automobile, de Matériels, de Transport Terrestre, Construction Navale, Aéronautique et Armement">Construction Automobile, de Matériels, de Transport Terrestre, Construction Navale, Aéronautique et Armement</option>
                <option value="Edition, Imprimerie, Média, Presse">Edition, Imprimerie, Média, Presse</option>
                <option value="Industrie Agro-alimentaire, Boissons, Vins et Spiritueux">Industrie Agro-alimentaire, Boissons, Vins et Spiritueux</option>
                <option value="Industrie Mécanique, Electrique, Electronique">Industrie Mécanique, Electrique, Electronique</option>
                <option value="Industrie textile, Habillement, Cuir, Chaussures, Orfèvrerie, Horlogerie">Industrie textile, Habillement, Cuir, Chaussures, Orfèvrerie, Horlogerie</option>
                <option value="Industrie Diverses">Industrie Diverses</option>
                <option value="Parachimie et Industrie Pharmaceutique, Cosmétiques">Parachimie et Industrie Pharmaceutique, Cosmétiques</option>
                <option value="Promoteurs et Professions Immobilières">Promoteurs et Professions Immobilières</option>
                <option value="Services divers et collectifs, NTIC">Services divers et collectifs, NTIC</option>
                <option value="Tourisme et Loisirs, Hôtellerie, Restauration">Tourisme et Loisirs, Hôtellerie, Restauration</option>
                <option value="Transports, Electricité, Postes et Télécommunications">Transports, Electricité, Postes et Télécommunications</option>
                <option value="Autres">Autres</option>
            </select>
        </div>
        <?php
    }

    public function service($services_entreprise,$col = 5){ 
        ?>
        <div class="form-group col-md-<?=$col?>">
            <label for="services_entreprise">Service dans lequel le stage sera effectué</label>
            <input class="form-control" style="background-color:#e8f0ff" type="text" name="services_entreprise" id="services_entreprise" value="<?=$services_entreprise;?>"/>
        </div>
        <?php
    }

    public function lieuBis($lieu_bis_entreprise,$col = 9){
        ?>
        <div class="form-group col-md-<?=$col?>">
            <label>Lieu du stage si différent de l'adresse de la société ou de l'organisme d'accueil</label>
            <input class="form-control" style="background-color:#e8f0ff" type="text" name="lieu_bis_entreprise" id="lieu_bis_entreprise" value="<?=$lieu_bis_entreprise;?>">
        </div>
        <?php
    }

    public function fermetureOui($checked = "",$col = 4){
        ?>
        <div class="form-check form-check-inline col-md-<?=$col?>">
            <input class="form-check-input" type="radio" name="fermeture_entreprise" id="fermeture_oui" value="on" <?=$checked?>/>
            <label class="form-check-label">oui</label>
        </div>
        <?php
    }

    public function fermetureNon($checked = "",$col = 4){
        ?>
        <div class="form-check form-check-inline col-md-<?=$col?>">
                <input class="form-check-input" type="radio" name="fermeture_entreprise" id="fermeture_non" value="off" <?=$checked?>/>
                <label class="form-check-label">non</label>
            </div>
        <?php
    }

    public function dateDebutFermeture($date_debut_fermeture_entreprise,$hidden = "",$col = 4){
        ?>
        <div class="form-group col-md-<?=$col?>">
            <label <?=$hidden?> for="date_debut_fermeture_entreprise" >Date début fermeture</label>
            <input <?=$hidden?> class="form-control" style="background-color:#e8f0ff" type="text" name="date_debut_fermeture_entreprise" id="date_debut_fermeture_entreprise" value="<?=$date_debut_fermeture_entreprise;?>">
        </div>
        <?php
    }

    public function dateFinFermeture($date_fin_fermeture_entreprise,$hidden = "",$col = 4){
        ?>
        <div class="form-group col-md-<?=$col?>">
            <label <?=$hidden?> for="date_fin_fermeture_entreprise" >Date fin fermeture</label>
            <input <?=$hidden?> class="form-control" style="background-color:#e8f0ff" type="text" name="date_fin_fermeture_entreprise" id="date_fin_fermeture_entreprise" value="<?=$date_fin_fermeture_entreprise;?>">
        </div>
        <?php
    }

    public function complementAdresse($complement_adresse_entreprise,$col = 4){
        ?>
        <div class="form-group col-md-<?=$col?>">
            <label>Complément d'adresse</label>
            <input class="form-control" style="background-color:#e8f0ff" type="text" id="complement_adresse_entreprise" name="complement_adresse_entreprise" value="<?=$complement_adresse_entreprise;?>">
        </div>
        <?php
    }
}

class Tuteur{

    public function nomTuteur($nom_tuteur="",$col = 4){
        ?>
        <div class="form-group col-md-<?=$col?>">
            <label>Nom</label>
            <input class="form-control" style="background-color:#e8f0ff" type="text" name="nom_tuteur" id="nom_tuteur"
                value="<?=$nom_tuteur;?>">
        </div>
        <?php
    }
    
    public function prenomTuteur($prenom_tuteur,$col = 4){
        ?>
        <div class="form-group col-md-<?=$col?>">
            <label>Prénom</label>
            <input class="form-control" style="background-color:#e8f0ff" type="text" name="prenom_tuteur" id="prenom_tuteur"
                value="<?=$prenom_tuteur;?>">
        </div>
        <?php
    }

    public function telephone($telephone_tuteur,$col = 4){
        ?>
        <div class="form-group col-md-<?=$col?>">
            <label>Telephone</label>
            <input class="form-control" style="background-color:#e8f0ff" type="number" name="telephone_tuteur"
                id="telephone_tuteur" value="<?=$telephone_tuteur;?>">
        </div>
        <?php
    }

    public function mail($mail_tuteur,$col = 4){
        ?>
        <div class="form-group col-md-<?=$col?>">
            <label>Mail</label>
            <input class="form-control" style="background-color:#e8f0ff" type="mail" name="mail_tuteur" id="mail_tuteur"
                value="<?=$mail_tuteur;?>">
        </div>
        <?php
    }

    public function fonction($fonction_tuteur,$col = 4){
        ?>
        <div class="form-group col-md-<?=$col?>">
            <label>Fonction ou discipline</label>
            <input class="form-control" style="background-color:#e8f0ff" type="text" name="fonction_tuteur"
                id="fonction_tuteur" value="<?=$fonction_tuteur;?>">
        </div>
        <?php
    }

    public function selectEntreprise($tab,$id_entreprise,$name,$id,$col=4){
        ?>
        <div class="form-group col-md-<?=$col?>">
        <label>Entreprise</label>
        <select class="form-control" style="background-color:#e8f0ff" name="<?=$name?>" id="<?=$id?>">
            <option value=""></option>
            <?php
            foreach($tab as $value){
                if($value["id_entreprise"] == $id_entreprise){
                    ?>
                    <option selected value="<?=$value["id_entreprise"]?>"><?=$value["nom_entreprise"]?></option>
                    <?php
                }else{
                    ?>
                    <option value="<?=$value["id_entreprise"]?>"><?=$value["nom_entreprise"]?></option> 
                    <?php
                }
            }
            ?>
        </select>
        </div>
        <?php
    }

}

class Stage{

    public function formGroup($nom,$id,$name,$col,$value,$type="text"){
        ?>
        <div class="form-group col-md-<?=$col?>">
            <label><?=$nom?></label>
            <input class="form-control" style="background-color:#e8f0ff" type="<?=$type?>" id="<?=$id?>" name="<?=$name?>" value="<?=$value?>">
        </div>
        <?php
    }

    public function formCheck($nom,$id,$name,$col,$value,$checked){
        ?>
        <div class="form-group col-md-<?=$col?>">
            <div class="form-check form-check-inline ">
                <input class="form-check-input" type="radio" name="<?=$name?>" id="<?=$id?>" value="<?=$value?>" <?=$checked?>>
                <label class="form-check-label"><?=$nom?></label>
            </div>
        </div>
        <?php
    }

    public function textArea($nom,$id,$name,$value,$idLabel,$hidden,$col){
        ?>
        <div class="form-group col-md-<?=$col?>">
            <label id="<?=$idLabel?>" <?=$hidden?>><?=$nom?></label>
            <textarea class="form-control" style="background-color:#e8f0ff" id="<?=$id?>" name="<?=$name?>" rows="3" cols="55" <?=$hidden?>><?= $value;?></textarea>
        </div>
        <?php
    }

    public function nomEntreprise($tabEntreprise,$id_entreprise){
        ?>
        <div class="form-group col-md-4">
        <label for="entreprise">Entreprise</label>
            <select onchange="showUser(this.value)" class="form-control" style="background-color:#e8f0ff">
                <option value=""></option>
                <?php
                foreach ($tabEntreprise as $key => $value) {
                    if($id_entreprise == $value["id_entreprise"]){
                        echo "<option selected value=".$value['id_entreprise'].">".$value["nom_entreprise"]." </option>";
                    }else{
                        echo "<option value=".$value["id_entreprise"].">".$value["nom_entreprise"]." </option>";
                    }
                }
                ?>
            </select> 
        </div>
        <?php
    }

    public function selectEtablissement($tabEtablissement,$fk_etablissement=""){
        ?>
        <div class="form-group col-md-4">
            <label for="etablissement">Etablissement d'enseignement</label>   
            <select disabled name="etablissement" class="form-control" style="background-color:#e8f0ff">
                <option value=""></option>
                <?php
                foreach ($tabEtablissement as $value) {
                    if($fk_etablissement == $value["id_etablissement"]){
                        echo "<option selected value=".$value["id_etablissement"].">".$value['nom_etablissement']." </option>";
                    }else{
                        echo "<option value=".$value["id_etablissement"].">".$value["nom_etablissement"]." </option>";
                    }
                }
                ?>
            </select>
        </div>
        <?php
    }

    public function selectReferent($tabReferent,$fk_referent_stage=""){
        ?>
        <div class="form-group col-md-4">
        <label for="fk_referent_stage">Referent</label>
            <select name="fk_referent_stage" class="form-control" style="background-color:#e8f0ff">
                <option value=""></option>
                <?php
                foreach ($tabReferent as $value) {
                    if($fk_referent_stage == $value["id_referent"]){
                        echo "<option selected value=".$value["id_referent"].">".$value['nom_referent']." ".$value["prenom_referent"]." (" .$value["nom_etablissement"]. ") </option>";
                    }else{
                        echo "<option  value=".$value["id_referent"].">".$value['nom_referent']." ".$value["prenom_referent"]." (" .$value["nom_etablissement"]. ") </option>";
                    }
                }
                ?>
            </select>
        </div>
        <?php
    }

    public function nomTuteur($tabEntreprise,$fk_tuteur_stage){
        ?>
        <div  class="form-group col-md-4">
            <label>Tuteur</label>
            <select id="txtHint" name="fk_tuteur_stage" class="form-control" style="background-color:#e8f0ff">
                <option value=""></option>
                <?php foreach($tabEntreprise as $key => $value){
                    if($fk_tuteur_stage == $value["id_tuteur"]){
                        echo "<option selected value=".$value["id_tuteur"].">".$value["nom_tuteur"]." ".$value["prenom_tuteur"]." (".$value["nom_entreprise"].")</option>";
                    }else{
                        echo "<option value=".$value["id_tuteur"].">".$value["nom_tuteur"]." ".$value["prenom_tuteur"]." (".$value["nom_entreprise"].")</option>";
                    }
                }?>
            </select>
        </div>
        <?php
    }

    public function dateDebut($date_debut,$col = 4){
        ?>
        <div class="form-group col-md-<?=$col?>">
            <label>Du </label>
            <input class="form-control" style="background-color:#e8f0ff" type="text" name="date_debut"
                value="<?=$date_debut;?>" />
        </div>
        <?php
    }

    public function dateFin($date_fin,$col = 4){
        ?>
        <div class="form-group col-md-<?=$col?>">
            <label> au </label>
            <input class="form-control" style="background-color:#e8f0ff" type="text" name="date_fin"
                value="<?=$date_fin;?>" />
        </div>
        <?php
    }

    public function dureeTotale($duree_totale,$col = 8){
        ?>
        <div class="form-group col-md-<?=$col?>">
            <label>Durée totale du stage en nombre d'heures de présence effective</label>
            <input class="form-control" style="background-color:#e8f0ff" type="number" name="duree_totale"
                value="<?=$duree_totale;?>">
        </div>
        <?php
    }

    public function obligatoire($checked = "",$col = 4){
        ?>
        <div class="form-check form-check-inline col-md-<?=$col?>">
            <input class="form-check-input" type="radio" name="obligatoire" id="obligatoire" value="obligatoire" <?=$checked?>/>
            <label class="form-check-label">Stage obligatoire </label>
        </div>
        <?php
    } 

    public function optionnel($checked = "",$col = 4){
        ?>
        <div class="form-check form-check-inline col-md-<?=$col?>">
            <input class="form-check-input" type="radio" name="obligatoire" id="optionnel" value="optionnel" <?=$checked?>>
            <label class="form-check-label">Stage optionnel </label>
        </div>
        <?php
    }

    public function complet($checked = "",$col = 4){
        ?>
        <div class="form-check form-check-inline col-md-<?=$col?>">
            <input class="form-check-input" type="radio" name="temps_complet" value="complet" id="complet" <?=$checked?>>
            <label class="form-check-label"> Temps complet </label>
        </div>
        <?php
    }

    public function partiel($checked = "",$col = 4){
        ?>
        <div class="form-check form-check-inline col-md-<?=$col?>">
            <input class="form-check-input" type="radio" name="temps_complet" value="partiel" id="partiel" <?=$checked?>>
            <label class="form-check-label"> Temps partiel </label>
        </div>
        <?php
    }

    public function heurePartiel($heure_partiel="",$hidden="",$col = 4){
        ?>
        <div class="form-group col-md-<?=$col?>">
                <label  for="heure_partiel" <?=$hidden?>>Veuillez préciser le
                    nombre d'heures</label>
                <input class="form-control" style="background-color:#e8f0ff" <?=$hidden?> type="number" id="heure_partiel" name="heure_partiel" value="<?=$heure_partiel?>">
            </div>
        </div>
        <?php
    }

    public function casParticulierBooleenOui($checked = "",$col = 3){
        $this->formCheck("oui","cas_particulier_booleen_oui","cas_particulier_booleen",$col,"oui",$checked);
    }

    public function casParticulierBooleenNon($checked = "",$col = 3){
        $this->formCheck("non","cas_particulier_booleen_non","cas_particulier_booleen",$col,"non",$checked);
    }

    public function casParticulier($value,$hidden= "",$col = 8){
        $this->textArea("Préciser les cas particuliers","cas_particulier","cas_particulier",$value,"text_cas_particulier",$hidden,$col);
    }

    public function gratification($gratification){
        ?>
        <div class="form-group col-md-2">
            <div class="input-group">
                <input class="form-control" style="background-color:#e8f0ff" type="number" name="gratification" value="<?=$gratification;?>" aria-describedby="basic-addon2"/>
                <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2">€</span>
                </div>
            </div>
        </div>
        <?php
    }

    public function conditionsRemboursement($value,$col = 8){
        $this->textArea("Les frais engagés par le stagiaire à la demande de l'ENTREPRISE, dans le cadre de la réalisation du stage seront remboursés dans les conditions suivantes","conditions_remboursement","conditions_remboursement",$value,"","",$col);
    }

    public function activite($value,$col=8){
        $this->textArea("Activités / missions confiées","activites_missions","activites_missions",$value,"","",$col);
    }

    public function competence($value,$col=8){
        $this->textArea("Compétences à acquérir ou à développer","competences_developper","competences_developper",$value,"","",$col);
    }
    

}

class Enseignement{

    public function formGroup($nom,$id,$name,$col,$value,$type="text"){
        ?>
        <div class="form-group col-md-<?=$col?>">
            <label><?=$nom?></label>
            <input class="form-control" style="background-color:#e8f0ff" type="<?=$type?>" id="<?=$id?>" name="<?=$name?>" value="<?=$value?>">
        </div>
        <?php
    }

    public function nom($col=4,$value=""){
        $this->formGroup("Nom","nom_etablissement","nom_etablissement",$col,$value);
    }

    public function numeroRue($col=4,$value=""){
        $this->formGroup("Numero","numero_rue_etablissement","numero_rue_etablissement",$col,$value,"number");
    }

    public function adresse($col=4,$value=""){
        $this->formGroup("Voie","adresse_etablissement","adresse_etablissement",$col,$value);
    }

    public function complementAdresse($col=4,$value=""){
        $this->formGroup("Complément d'adresse","complement_adresse_etablissement","complement_adresse_etablissement",$col,$value);
    }

    public function codePostal($col=4,$value=""){
        $this->formGroup("Code postal","code_postal_etablissement","code_postal_etablissement",$col,$value,"number");
    }

    public function ville($col=4,$value=""){
        $this->formGroup("Ville","ville_etablissement","ville_etablissement",$col,$value);
    }

    public function representant($col=4,$value=""){
        $this->formGroup("Représentée par","representant_etablissement","representant_etablissement",$col,$value);
    }

    public function fonction($col=4,$value=""){
        $this->formGroup("Fonction du représentant","fonction_representant_etablissement","fonction_representant_etablissement",$col,$value);
    }

    public function telephone($col=4,$value=""){
        $this->formGroup("Téléphone","telephone_etablissement","telephone_etablissement",$col,$value,"tel");
    }

    public function mail($col=4,$value=""){
        $this->formGroup("Email","mail_etablissement","mail_etablissement",$col,$value,"mail");
    }
}

class Referent{

    public function formGroup($nom,$id,$name,$col,$value="",$type="text"){
        ?>
        <div class="form-group col-md-<?=$col?>">
            <label><?=$nom?></label>
            <input class="form-control" style="background-color:#e8f0ff" type="<?=$type?>" id="<?=$id?>" name="<?=$name?>" value="<?=$value?>">
        </div>
        <?php
    }

    public function nom($col=4,$value=""){
        $this->formGroup("Nom","nom_referent","nom_referent",$col,$value);
    }

    public function prenom($col=4,$value=""){
        $this->formGroup("Prénom","prenom_referent","prenom_referent",$col,$value);
    }

    public function telephone($col=4,$value=""){
        $this->formGroup("Téléphone","telephone_referent","telephone_referent",$col,$value,"tel");
    }

    public function mail($col=4,$value=""){
        $this->formGroup("Email","mail_referent","mail_referent",$col,$value,"mail");
    }

    public function fonction($col=4,$value=""){
        $this->formGroup("Fonction ou discipline","fonction_referent","fonction_referent",$col,$value);
    }
    
    public function selectEntreprise($tab,$id_etablissement,$name,$id,$col=4){
        ?>
        <div class="form-group col-md-<?=$col?>">
            <select class="form-control" style="background-color:#e8f0ff" name="<?=$name?>" id="<?=$id?>">
                <option value=""></option>
                <?php
                foreach($tab as $value){
                    if($value["id_etablissement"] == $id_etablissement){
                        ?>
                        <option selected value="<?=$value["id_etablissement"]?>"><?=$value["nom_etablissement"]?></option>
                        <?php
                    }else{
                        ?>
                        <option value="<?=$value["id_etablissement"]?>"><?=$value["nom_etablissement"]?></option>
                        <?php
                    }
                }
                ?>
            </select>
        </div>
        <?php
    }
}
class Input{

    public function inp($col = 4){
        ?>
        <div class="form-group col-md-<?=$col?>">
            <label>La société ou organisme d'accueil</label>
            <input class="form-control" style="background-color:#e8f0ff" type="text" id="nom_entreprise" name="nom_entreprise" value="<?=$nom_entreprise;?>">
        </div>
        <?php
    }
}

?>