<?php
if(!isset($_SESSION)){
  session_start();
}
?>

//Attendre que le document soit completement chargé
$(document).ready(function() {

    //Récupérer les éléments de l'ihm nécessaire
    var menu_parametrage = document.getElementById("menu_parametrage");
    var blockParametrageText = document.getElementById("blockParametrageText");
    var blockParametrageDonneeVariable = document.getElementById("blockParametrageDonneeVariable");
    var blockParametrageImage = document.getElementById("blockParametrageImage");
    var bouttonAjouterDonneeVariable = document.getElementById("bouttonAjouterDonneeVariable");
    var bouttonAjouter = document.getElementById("bouttonAjouter");

    //Stocker le type d'item en cours de création
    var itemEnCoursDeCration;

    //Gestion si click sur un item du menu de menu de droite
    $('.item').click(function(event){

            //Affichage du menu de paramétrage
            menu_parametrage.style.visibility = "visible";

            //Affichage (comme titre) de l'item séléctionné dans le menu paramétrage
            document.getElementById("titreParametrage").innerHTML = event.target.getAttribute("name");
            itemEnCoursDeCration = event.target;

            //Si l'item nécessite le block de paramétrage "Text"
            if( event.target.getAttribute("id") == "itemTitre" ||
                event.target.getAttribute("id") == "itemZoneTexte" ||
                event.target.getAttribute("id") == "itemQuestion"){
              blockParametrageDonneeVariable.style.display  = "none";
              blockParametrageImage.style.display  = "none";
              blockParametrageText.style.display  = "block";
            }

            //Si l'item nécessite le block de paramétrage "Donnée Variable"
            if(event.target.getAttribute("id") == "itemDonneeVariable"){
              blockParametrageText.style.display  = "none";
              blockParametrageImage.style.display  = "none";
              blockParametrageDonneeVariable.style.display  = "block";

              //Déterminer quel block de paramétrage de donnée variable afficher
              typeDonnerClick();

            }

            //Si l'item nécessite le block de paramétrage "Image"
            if(event.target.getAttribute("id") == "itemImage"){
              blockParametrageText.style.display  = "none";
              blockParametrageDonneeVariable.style.display  = "none";
              blockParametrageImage.style.display  = "block";
            }
        });

    //Au clique sur le boutton, ajouter l'item à la zone de création
    bouttonAjouter.onclick = function() {
      ajouterElement(itemEnCoursDeCration);
    };

    //Au clique sur le boutton, ajouter l'item block de donnée variable
    bouttonAjouterDonneeVariable.onclick = function() { ajouterBlockDonneeVariable(); };

});

//Renvoie TRUE si le boutton radio "Valeur a valeur" est coché
function isRadioValeurParValeurChecked(){
  return document.getElementById("itemTypeDonneeValeurAValeur").checked;
}

//Renvoie TRUE si le boutton radio "Interval" est coché
function isRadioIntervalChecked(){
  return document.getElementById("itemTypeDonneeInterval").checked;
}

//Change le block de paramétrage en fonction du type de donnée séléctionné
function typeDonnerClick() {

  //Récupérer les éléments de l'ihm nécessaire
  var blockParametrageValeurAValeur = document.getElementById("blockParametrageValeurAValeur");
  var blockParametrageInterval = document.getElementById("blockParametrageInterval");

  //Comportement à appliquer
  if(isRadioValeurParValeurChecked()){
    blockParametrageInterval.style.display  = "none";
    blockParametrageValeurAValeur.style.display  = "block";
  } else if(isRadioIntervalChecked()){
    blockParametrageValeurAValeur.style.display  = "none";
    blockParametrageInterval.style.display  = "block";
  }
}

//Ajouter un item séléctionné et paramétré à la page de création (énoncé)
function ajouterElement(typeItem) {

  //Récupérer les éléments de l'ihm nécessaire
  var para1 = document.querySelector('.page_creation');
  var itemTitre = typeItem.getAttribute("id");
  var itemValeur = document.getElementById("itemValeur").value;
  var itemPolice = document.getElementById("itemPolice");
  itemPolice = itemPolice.options[itemPolice.selectedIndex].value;
  var itemCouleur = document.getElementById("itemCouleur");
  itemCouleur = itemCouleur.options[itemCouleur.selectedIndex].value;
  var itemGras = document.getElementById("itemGras");
  var itemItalique = document.getElementById("itemItalique");
  var itemSousligne = document.getElementById("itemSousligne");
  var itemSource = document.getElementById("itemSource");
  var itemDescription = document.getElementById("itemDescription");
  var itemLargeur = document.getElementById("itemLargeur");
  var itemHauteur = document.getElementById("itemHauteur");

  //Récupérer la valeur de la check box si elle est cochée
  if(itemGras.checked){
    itemGras = itemGras.value;
  }

  //Récupérer la valeur de la check box si elle est cochée
  if(itemItalique.checked){
    itemItalique = itemItalique.value;
  }

  //Récupérer la valeur de la check box si elle est cochée
  if(itemSousligne.checked){
    itemSousligne = itemSousligne.value;
  }

  //Différent comportement à appliquer en fonction du type d'item à ajouter
  switch (itemTitre) {

    //Si l'item à ajouter est un "Titre"
    case "itemTitre":
        var newTitre = document.createElement('h1');
        newTitre.id = 'titre';
        newTitre.style.fontSize = itemPolice;
        newTitre.style.color = itemCouleur;
        newTitre.style.fontWeight = itemGras;
        newTitre.style.fontStyle = itemItalique;
        newTitre.style.textDecoration = itemSousligne;
        newTitre.appendChild(document.createTextNode(itemValeur));
      break;

    //Si l'item à ajouter est une "Zone de texte"
    case "itemZoneTexte":
        var newTitre = document.createElement('p');
        newTitre.id = 'zonedetext';
        newTitre.style.fontSize = itemPolice;
        newTitre.style.color = itemCouleur;
        newTitre.style.fontWeight = itemGras;
        newTitre.style.fontStyle = itemItalique;
        newTitre.style.textDecoration = itemSousligne;
        newTitre.appendChild(document.createTextNode(itemValeur));
      break;

      //Si l'item à ajouter est une "Donnée Variable"
      case "itemDonneeVariable":
          var newTitre = document.createElement('p');
          newTitre.id = '##' + recupererIdTypeDonneeAjoute() + '##';
          newTitre.style.fontSize = itemPolice;
          newTitre.style.color = itemCouleur;
          newTitre.style.fontWeight = itemGras;
          newTitre.style.fontStyle = itemItalique;
          newTitre.style.textDecoration = itemSousligne;
          newTitre.appendChild(document.createTextNode(recupererLibelleTypeDonneeAjoute()));
        break;

      //Si l'item à ajouter est une "Question"
      case "itemQuestion":
          var numQR = recupererNumQuestionReponse();
          var newTitre = document.createElement('span');
          newTitre.id = 'question_' + numQR;
          newTitre.style.fontSize = itemPolice;
          newTitre.style.color = itemCouleur;
          newTitre.style.fontWeight = itemGras;
          newTitre.style.fontStyle = itemItalique;
          newTitre.style.textDecoration = itemSousligne;
          newTitre.appendChild(document.createTextNode(itemValeur));

          //Appel de la fonction ajoutant la question à la base de donnée
          ajouterNouvelleQuestion(itemValeur);

          //Ajout d'un champ réponse associé
          var newTitre2 = document.createElement('input');
          newTitre2.id = 'reponse_' + numQR;
          newTitre2.type = 'text';
          newTitre2.placeholder = "Renseigner ici votre réponse";
        break;

      //Si l'item à ajouter est une "Image"
      case "itemImage":
        var newTitre = document.createElement('img');
        newTitre.id = 'image';
        newTitre.alt = itemDescription.value;

        //Attendre que l'immage soit chargée pour l'afficher
        var reader = new FileReader();
        reader.addEventListener('load', function () {
          newTitre.src = reader.result;
          newTitre.width = itemLargeur.value;
          newTitre.height = itemHauteur.value;
        });

        reader.readAsDataURL(itemSource.files[0]);
      break;

    //Comportement par defaut
    default:
      console.log("Une erreur est survenue");
  }

  para1.appendChild(newTitre);

  if( typeof newTitre2 != 'undefined'){
    para1.appendChild(newTitre2);
  }

}

//Ajoute un block d'insertion de donnée "Valeur à valeur"
function ajouterBlockDonneeVariable(){

  //Simulation d'une variable globale
  if( typeof idInput == 'undefined' ) { idInput = 0; }
  idInput++;

  //Récupérer les éléments de l'ihm nécessaire
  var blockParametrageValeurAValeur = document.getElementById("blockParametrageValeurAValeur");
  var newLabelDonneeVariable = document.createElement('label');
  var newInputDonneeVariable = document.createElement('input');

  //Ajout d'un label
  newLabelDonneeVariable.id = 'labelDonneeVariable';
  newLabelDonneeVariable.appendChild(document.createTextNode("Valeur : "));

  //Ajout de l'input
  newInputDonneeVariable.id = 'inputDonneeVariable'+idInput;
  newInputDonneeVariable.appendChild(document.createTextNode(""));

  //Ajout des éléments au block de paramétrage des items
  blockParametrageValeurAValeur.appendChild(newLabelDonneeVariable);
  blockParametrageValeurAValeur.appendChild(newInputDonneeVariable);

}

  //Récupère le code HTML de la page de création et l'insère comme valeur de champ "hidden pour la méthode POST
function validerEnonce(){
  var enonceCreer = document.getElementById('page_creation').innerHTML;
  var inputEnonceCreer = document.getElementById('enonceCreer');
  inputEnonceCreer.value = enonceCreer;
}

//Appel du fichier AJAX afin d'ajouter un nouveau type de donnée dans la base
function ajouterNouveauTypeDonnee(){

  //Récupérer les éléments de l'ihm nécessaire
  var newTypeDonnee = document.getElementById("newTypeDonnee").value;

  //Si le libellé donné pour le type de donnée n'est pas vide
  if(newTypeDonnee != ""){
    $.post("./ajax/ajoutTypeDonnee.ajax.php", { newTypeDonnee: newTypeDonnee }, function(data) {
      //Appel de la fonction d'ajout des donnée variables associé
      ajouterNouvelleDonneeVariable();
    });
  }
}

//Descide du comportement à appliquer en fonction du type de donnée à ajouter
function ajouterNouvelleDonneeVariable(){

  //Si se sont des données à ajouter via un interval
  if(isRadioIntervalChecked()){
    ajouterNouvelleDonneeVariableViaInterval();
  }
  //Si se sont des données à ajouter valeur à valeur
  else if(isRadioValeurParValeurChecked()){
    ajouterNouvelleDonneeVariableValeurAValeur();
  }

}

//Appel du fichier AJAX afin d'ajouter les nouvelles donnée variable associé au nouveau type de donnée via un interval
function ajouterNouvelleDonneeVariableViaInterval(){

  //Récupérer les éléments de l'ihm nécessaire
  var borneInferieurInterval = document.getElementById("borneInferieurInterval").value;
  var borneSuperieurInterval = document.getElementById("borneSuperieurInterval").value;
  var pasInterval = document.getElementById("pasInterval").value;

  //Si les champs nécessaire ne sont pas vide
  if(borneInferieurInterval != "" && borneSuperieurInterval != "" && pasInterval != ""){

    //Appel du fichier AJAX avec les paramètres passé grace à la méthode POST
    $.post("./ajax/ajoutDonneeVariableViaInterval.ajax.php", {
      borneInferieurInterval: borneInferieurInterval ,
      borneSuperieurInterval: borneSuperieurInterval ,
      pasInterval: pasInterval
    });
  }
}

//Appel du fichier AJAX afin d'ajouter les nouvelles donnée variable associé au nouveau type de donnée valeur après valeur
function ajouterNouvelleDonneeVariableValeurAValeur(){

  //Récupérer les éléments de l'ihm nécessaire
  var tab = document.getElementsByTagName('input');
  var liste = [];

  for(var i=0; i<tab.length; i++) {

    //Récupérer toutes les valeurs possible de la donnée variable
     if ( tab[i].id.substring(0, 19) == 'inputDonneeVariable' ) {
       liste.push(document.getElementById(tab[i].id).value);
     }

  }

  //Si la liste des donnée variable à ajouter n'est pas vide
  if(liste.length != 0){

    //Appel du fichier AJAX avec les paramètres passé grace à la méthode POST
    $.post("./ajax/ajoutDonneeVariableValeurAValeur.ajax.php", {
      liste: liste
    });
  }

}

//Retourne l'id du type de donnée séléctionné
function recupererIdTypeDonneeAjoute(){

  //Récupérer les éléments de l'ihm nécessaire
  var typeDonnee = document.getElementById("typeDonnee");

  //Récupérer la valeur de l'item séléctionné dans la liste déroulante
  typeDonnee = typeDonnee.options[typeDonnee.selectedIndex].value;

  //Si l'item séléctionné dans la liste est le 1er ("Créer un nouveau type")
  if(typeDonnee == "0"){
    //Retourner le dernier idType inséré dans la table TypeDonnee de la base de donnée (via la variable de session venant du TypeDonneeManager)
    return "<?php if(isset($_SESSION['newIdTypeDonne'])){ echo $_SESSION['newIdTypeDonne']; } else { echo '0'; }?>";
  } else {
    //Retourner l'id du type séléctionné dans la liste déroulante
    return typeDonnee;
  }

}


//Retourne le libellé du type de donnée séléctionné
function recupererLibelleTypeDonneeAjoute(){

  //Récupérer les éléments de l'ihm nécessaire
  var typeDonnee = document.getElementById("typeDonnee");
  var newTypeDonnee = document.getElementById("newTypeDonnee").value;

  //Récupérer le libellé du type de donnée séléctionné / inséré
  typeDonneeValue = typeDonnee.options[typeDonnee.selectedIndex].value;
  typeDonneeText = typeDonnee.options[typeDonnee.selectedIndex].text;

  //Si le typeDonneeValue est "Créer un nouveau type de donnée"
  if(typeDonneeValue == 0){
    //Retourne le nouveau type de donné saisi
    return "\"" + newTypeDonnee + "\"";
  } else {
    //Retourne le nouveau type de donné séléctionné
    return "\"" + typeDonneeText + "\"";
  }

}

//Appel du fichier AJAX afin d'ajouter une nouvelle question dans la base de donnée
function ajouterNouvelleQuestion(libelle){

  //Si le libellé de la question n'est pas vide
  if(libelle != ""){
    $.post("./ajax/ajoutQuestion.ajax.php", { libelle: libelle });
  }

}

//Retourne un id pour la question/réponse autoincrémenté a chaque fois
function recupererNumQuestionReponse(){

  //Simulation d'une variable globale
  if( typeof numQR == 'undefined' ) { numQR = 0; } else { numQR++; }

  return numQR;
}
