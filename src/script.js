
var nom = document.getElementById("nom");
var non_valide = document.querySelector(".non_valide");
var naissance = document.getElementById("date_naissance");
var mail = document.getElementById("mail");
var radio_partiel = document.getElementById("partiel");
var radio_complet = document.getElementById("complet");
var heure_partiel = document.getElementById("heure_partiel");
var label_heure_partiel = document.querySelector("label[for='heure_partiel']");

var text_cas_particulier = document.getElementById("text_cas_particulier")
var cas_particulier = document.getElementById("cas_particulier");
var cas_particulier_booleen_oui = document.getElementById("cas_particulier_booleen_oui");
var cas_particulier_booleen_non = document.getElementById("cas_particulier_booleen_non");

var submit = document.getElementById("submit");
var lien = document.getElementById("lien");

var fermeture_oui = document.getElementById("fermeture_oui");
var fermeture_non = document.getElementById("fermeture_non");
var label_debut_fermeture = document.querySelector("label[for='date_debut_fermeture_entreprise']");
var label_fin_fermeture = document.querySelector("label[for='date_fin_fermeture_entreprise']");
var input_debut_fermeture = document.getElementById("date_debut_fermeture_entreprise");
var input_fin_fermeture = document.getElementById("date_fin_fermeture_entreprise");

var lieu_bis_oui = document.getElementById("lieu_bis_oui");
var lieu_bis_non = document.getElementById("lieu_bis_non");
var input_lieu_bis_entreprise = document.getElementById("label_lieu_bis_entreprise");
var label_lieu_bis_entreprise = document.getElementById("input_lieu_bis_entreprise");

var modalite_conge_oui = document.getElementById("modalite_conge_oui");
var modalite_conge_non = document.getElementById("modalite_conge_non");
var modalite_conge = document.getElementById("modalite_conge");
var modalite_conge_label = document.getElementById("modalite_conge_label");

var masqueMail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
var masqueDate = /^[0-9]{2}[/-]{1}[0-9]{2}[/-]{1}[0-9]{4}$/g;

//--------------INPUT MAIL-------------
// mail.addEventListener("blur",()=>{
    
    //     if(masqueMail.test(mail.value)){
        //         console.log("ok");
        //     }else{
            //         console.log("ko");
            //     }
            // });
            
            //------------INPUT DATE NAISSANCE------------
// naissance.addEventListener("change",()=>{

//     if(!(masqueDate.test(naissance.value))){
//         this.non_valide.hidden = false;
//     }else{
//         this.non_valide.hidden = true;
//     }
// });

// naissance.addEventListener("input",()=>{
//     if(naissance.value.length == 2){
//         console.log(naissance.value.length);
//         naissance.value = naissance.value + "/";
//     }

//     if(naissance.value.length == 5){
//         console.log(naissance.value.length);
//         naissance.value = naissance.value + "/";
//     }
// });

// Rendre visible ou non le nombre d'heure partiel
cacher(radio_partiel,label_heure_partiel,heure_partiel,false,true);
cacher(radio_complet,label_heure_partiel,heure_partiel,true);

// Rendre visible ou non les cas particuliers
cacher(cas_particulier_booleen_oui,text_cas_particulier,cas_particulier,false,true);
cacher(cas_particulier_booleen_non,text_cas_particulier,cas_particulier,true);

// Rendre visible ou non les dates de fermetures
cacher(fermeture_oui,label_debut_fermeture,input_debut_fermeture,false,true);
cacher(fermeture_oui,label_fin_fermeture,input_fin_fermeture,false,true);
cacher(fermeture_non,label_debut_fermeture,input_debut_fermeture,true);
cacher(fermeture_non,label_fin_fermeture,input_fin_fermeture,true);

cacher(lieu_bis_oui,input_lieu_bis_entreprise,label_lieu_bis_entreprise,false,true);
cacher(lieu_bis_non,input_lieu_bis_entreprise,label_lieu_bis_entreprise,true);

cacher(modalite_conge_oui,modalite_conge_label,modalite_conge,false,true);
cacher(modalite_conge_non,modalite_conge_label,modalite_conge,true);

// Fonction pour rendre visible ou cacher des balises
function cacher(baliseEvt,baliseHide,baliseHide2,booleen,bool = false){
    if( baliseEvt !== null){
        baliseEvt.addEventListener("click",()=>{
            baliseHide.hidden = booleen;
            baliseHide2.hidden = booleen;
            baliseHide.required = bool;
            baliseHide2.required = bool;
        });
    }
    return;
}


function showReferent(str){
    show(str,"referent","ajaxReferent");
}

function showTuteur(str){ 
    show(str,"tuteur","ajaxTuteur");
} 

var form = document.querySelector('.needs-validation');
form.addEventListener('submit',function(event){
    //window.alert(form.reportValidity());
    if (form.checkValidity() === false){
        event.preventDefault();
        event.stopPropagation();
    }
    form.classList.add('was-validated');
});

var $_GET = [];
var parts = window.location.search.substr(1).split("&");
for (var i = 0; i < parts.length; i++) {
    var temp = parts[i].split("=");
    $_GET[decodeURIComponent(temp[0])] = decodeURIComponent(temp[1]);
}

if($_GET["id"] == undefined && $_GET["id_entreprise"] == undefined){
    var nomEntreprise = document.querySelector("input[name='nom_entreprise']");
    nomEntreprise.addEventListener('focusout',doublonEntreprise);
    var numeroRue = document.querySelector("input[name='numero_rue_entreprise']");
    numeroRue.addEventListener('focusout',doublonEntreprise);
    var voie = document.querySelector("input[name='adresse_entreprise']");
    voie.addEventListener('focusout',doublonEntreprise);
    var codePostal = document.querySelector("input[name='code_postal_entreprise']");
    codePostal.addEventListener('focusout',doublonEntreprise);
    var ville = document.querySelector("input[name='ville_entreprise']");
    ville.addEventListener('focusout',doublonEntreprise);
}


function doublonEntreprise(){
    nomEntreprise = document.querySelector("input[name='nom_entreprise']");
    numeroRue = document.querySelector("input[name='numero_rue_entreprise']");
    voie = document.querySelector("input[name='adresse_entreprise']");
    codePostal = document.querySelector("input[name='code_postal_entreprise']");
    ville = document.querySelector("input[name='ville_entreprise']");
    if(nomEntreprise.value == ""){
        return;
    }else{
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // document.getElementById("modal").innerHTML = this.responseText;
                var baliseSmall = document.querySelector("small");
                baliseSmall.textContent = "";
                if(this.responseText != 0){
                    var texte = document.createTextNode(this.responseText);
                    baliseSmall.appendChild(texte);
                    // $('#modal').modal('show');
                }else{
                    baliseSmall.textContent = "";
                }
            } 
        };
        xmlhttp.open("GET","/Convention/doublon.php?nom="+nomEntreprise.value+"&rue="+numeroRue.value+"&voie="+voie.value+"&postal="+codePostal.value+"&ville="+ville.value,true);
        xmlhttp.send();
    }
}


// function doublonNomEntreprise(str){
//     if(str == ""){
//         document.getElementById("modal").innerHTML = "";
//         return;
//     }else{
//         if (window.XMLHttpRequest) {
//             // code for IE7+, Firefox, Chrome, Opera, Safari
//             xmlhttp = new XMLHttpRequest();
//         } else {
//             // code for IE6, IE5
//             xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
//         }
//         xmlhttp.onreadystatechange = function() {
//             if (this.readyState == 4 && this.status == 200) {
//                 document.getElementById("modal").innerHTML = this.responseText;
//                 // console.log(this.response.length);
//                 // console.log(this.response);
//                 if(this.responseText != 0){
//                     $('#modal').modal('show');
//                 }
//             }
//         };
//         xmlhttp.open("GET","/Convention/modal.php?q="+str,true);
//         xmlhttp.send();
//     }
// }


function show(str,table,id) {
    if (str == "") {
        document.getElementById(id).innerHTML = "";
        return;
    } else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById(id).innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","/Convention/ajax.php?table="+table+"&q="+str,true);
        xmlhttp.send();
    }
}







