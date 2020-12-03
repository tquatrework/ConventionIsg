<?php
namespace Form;
use \PDO;
class Stagiaire extends Form{

    public function __construct($dbh){

        //Initialisation
        $this->page = "stagiaire";
        $this->idPage = "id_stagiaire";
        $this->tab = $this->fetchStagiaire($dbh);

        //Update ou Insert
        $this->id();
        $this->logic($dbh,",id_stagiaire",",".$this->id);

        //Conditions pour affichage du titre
        if($_SESSION["profile"] == "etudiant"){
            echo "<h3>Mes informations</h3>";
        }else{
            echo "<h3>Modification stagiaire</h3>";
        }

        //Affichage du formulaire
        ?>
        <form action="" method="post" class="needs-validation" novalidate>
            <?php
            #$this->nomPrenomCivilite();
		  $this->civilite();
            $this->nomPrenom();
            $this->dateNationalite();
            $this->adresse();
            $this->telephoneClasse();
            ?>
            <hr/>
            <h3>Caisse d'assurance maladie</h3>
            <?php
            $this->numeroSecu();
            $this->adresseAssurance();
            $this->villeAssurance();
            echo "<br/>";
            $this->button();
            ?>
        </form>
        <?php
    }

    public function classe($col = 4){
        ?>
            <div class="form-group col-md-<?=$col?>">
                    <label for="classe">Classe</label>
                    <select name="classe" required id="classe" class="form-control" style="background-color:#e8f0ff">
                        <?php 
                        if(!empty($this->tab["classe"])){
                            echo "<option selected value='".$this->tab["classe"]."'>".$this->tab["classe"]."</option>";
                        }else{
                            echo "<option value=''></option>";
                        }                        
                        ?>
                        <option value="ISG PBM - 1ere annee">ISG PBM - 1ère année</option>
                        <option value="ISG PBM - 2eme annee">ISG PBM - 2ème année</option>
                        <option value="ISG PBM - 3eme annee">ISG PBM - 3ème année</option>
                        <option value="MSC Finance 1ere annee – Finance de Marché>MSC Finance 1ère année – Finance de Marché</option>
                        <option value="MSC Finance 1ere annee – Corporate Finance>MSC Finance 1ère année – Corporate Finance</option>
                        <option value="MSC Finance 1ere annee – Audit et contrôle de gestion>MSC Finance 1ère année – Audit et contrôle de gestion</option>
                        <option value="MSC Marketing 1ere annee – Stratégie marketing et brand management>MSC Marketing 1ère année – Stratégie marketing et brand management</option>
                        <option value="MSC Marketing 1ere annee – Digital marketing et E-business>MSC Marketing 1ère année – Digital marketing et E-business</option>
                        <option value="MSC Marketing 1ere annee – Communication évènementielle et E-réputation>MSC Marketing 1ère année – Communication évènementielle et E-réputation</option>
                        <option value="MSC Marketing 1ere annee – Territoire de marque et brand content>MSC Marketing 1ère année – Territoire de marque et brand content</option>
                        <option value="MSC Finance 2eme annee – Finance de Marché>MSC Finance 2ème année – Finance de Marché</option>
                        <option value="MSC Finance 2eme annee – Corporate Finance>MSC Finance 2ème année – Corporate Finance</option>
                        <option value="MSC Finance 2eme annee – Audit et contrôle de gestion>MSC Finance 2ème année – Audit et contrôle de gestion</option>
                        <option value="MSC Marketing 2eme annee – Stratégie marketing et brand management>MSC Marketing 2ème année – Stratégie marketing et brand management</option>
                        <option value="MSC Marketing 2eme annee – Digital marketing et E-business>MSC Marketing 2ème année – Digital marketing et E-business</option>
                        <option value="MSC Marketing 2eme annee – Communication évènementielle et E-réputation>MSC Marketing 2ème année – Communication évènementielle et E-réputation</option>
                        <option value="MSC Marketing 2eme annee – Territoire de marque et brand content>MSC Marketing 2ème année – Territoire de marque et brand content</option>
                        <option value="MBA Management du patrimoine et des biens immobiliers>MBA Management du patrimoine et des biens immobiliers</option>
                        <option value="MBA International Business et Development>MBA International Business & Development</option>
                        <option value="MBA Business et Management in Luxury>MBA Business & Management in Luxury</option>
                        <option value="MBA Food, food tech et branding>MBA Food, food tech & branding</option>
                        <option value="MBA Supply Chain Management, achats et développement durable>MBA Supply Chain Management, achats et développement durable</option>
                        <option value="MBA Sport business, gaming et E-Sport>MBA Sport business, gaming & E-Sport</option>
                        <option value="MBA Economie collaborative, durable, RSE">MBA Economie collaborative, durable, RSE</option>

                    </select>
                </div>
            <?php
    }

    public function telephoneClasse(){
        ?>
        <div class='form-row'>
            <?php
            $this->telephone();
            $this->classe();
            ?>
        </div>
        <?php
    }

    public function telephone(){
        $this->formGroup("Télephone",$this->tab["telephone_".$this->page],"telephone_".$this->page,"number");
    }

    public function dateNationalite(){
        ?>
        <div class='form-row'>
            <?php
            $this->dateNaissance();
            $this->nationalite();
            ?>
        </div>
        <?php
    }

    public function nom(){
        $this->formGroup("Nom",$this->tab["nom_stagiaire"],"nom_".$this->page,"text");
    }

    public function prenom(){
        $this->formGroup("Prénom",$this->tab["prenom_stagiaire"],"prenom_".$this->page,"text");
    }

    public function adresseAssurance(){
        ?>
        <div class='form-row'>
            <?php
            $this->formGroup("Numéro",$this->tab["numero_rue_assurance"],"numero_rue_assurance","number",2);
            $this->formGroup("Voie",$this->tab["adresse_assurance"],"adresse_assurance","text",4);
            $this->formGroup("Code Postal",$this->tab["code_postal_assurance"],"code_postal_assurance","number",2);
            ?>
        </div>
        <?php
    }
    
    public function villeAssurance(){
        ?>
        <div class='form-row'>
            <?php
            $this->formGroup("Complément d'adresse",$this->tab["complement_adresse_assurance"],"complement_adresse_assurance","text",4);
            $this->formGroup("Ville",$this->tab["ville_assurance"],"ville_assurance","text",4);
            ?>
        </div>
        <?php
    }

    public function numeroSecu(){
        ?>
        <div class='form-row'>
            <?php
            $this->formGroup("Numéro de sécurité sociale",$this->tab["numero_securite_social"],"numero_securite_social",8);
            ?>
        </div>
        <?php
    }

    public function dateNaissance(){
        $this->formGroup("Date de naissance",$this->tab["date_naissance_stagiaire"],"date_naissance_stagiaire","text");
    }

    public function nationalite($col = 4){
        ?>
        <div class="form-group col-md-<?=$col?>">
                <label>Nationalité</label>
                <select name="nationalite" required id="nationalite" class="form-control" style="background-color:#e8f0ff">
                    <?php if(!empty($this->tab["nationalite"])){
                        echo "<option value=".$this->tab["nationalite"].">".$this->tab["nationalite"]."</option>";
                    }else{
                        echo "<option value=''></option>";
                    }
                    ?>
                    <option value="Afghane">Afghane (Afghanistan)</option>
                    <option value="Albanaise">Albanaise (Albanie)</option>
                    <option value="Algérienne">Algérienne (Algérie)</option>
                    <option value="Allemande">Allemande (Allemagne)</option>
                    <option value="Americaine">Américaine (États-Unis)</option>
                    <option value="Andorrane">Andorrane (Andorre)</option>
                    <option value="Angolaise">Angolaise (Angola)</option>
                    <option value="Antiguaise-et-Barbudienne">Antiguaise-et-Barbudienne (Antigua-et-Barbuda)</option>
                    <option value="Argentine">Argentine (Argentine)</option>
                    <option value="Armenienne">Arménienne (Arménie)</option>
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
}