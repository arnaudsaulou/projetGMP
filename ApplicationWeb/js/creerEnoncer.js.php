<?php
if(!isset($_SESSION)){
  session_start();
}
?>

$(document).ready(function() {

    var menu_parametrage = document.getElementById("menu_parametrage");

    var blockParametrageText = document.getElementById("blockParametrageText");
    var blockParametrageDonneeVariable = document.getElementById("blockParametrageDonneeVariable");
    var blockParametrageImage = document.getElementById("blockParametrageImage");

    var bouttonAjouterDonneeVariable = document.getElementById("bouttonAjouterDonneeVariable");
    var bouttonAjouter = document.getElementById("bouttonAjouter");

    var itemEnCoursDeCration;

    //Gestion si click sur un item du menu de menu de droite
    $('.item').click(function(event){

            menu_parametrage.style.visibility = "visible";

            document.getElementById("titreParametrage").innerHTML = event.target.getAttribute("name");
            itemEnCoursDeCration = event.target;

            if( event.target.getAttribute("id") == "itemTitre" ||
                event.target.getAttribute("id") == "itemZoneTexte" ||
                event.target.getAttribute("id") == "itemQuestion"){
              blockParametrageDonneeVariable.style.display  = "none";
              blockParametrageImage.style.display  = "none";
              blockParametrageText.style.display  = "block";
            }

            if(event.target.getAttribute("id") == "itemDonneeVariable"){
              blockParametrageText.style.display  = "none";
              blockParametrageImage.style.display  = "none";
              blockParametrageDonneeVariable.style.display  = "block";

              typeDonnerClick();

            }

            if(event.target.getAttribute("id") == "itemReponse"){
              blockParametrageText.style.display  = "none";
              blockParametrageDonneeVariable.style.display  = "none";
              blockParametrageImage.style.display  = "none";
            }

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

function isRadioValeurParValeurChecked(){
  return document.getElementById("itemTypeDonneeValeurAValeur").checked;
}

function isRadioIntervalChecked(){
  return document.getElementById("itemTypeDonneeInterval").checked;
}

function typeDonnerClick() {

  var blockParametrageValeurAValeur = document.getElementById("blockParametrageValeurAValeur");
  var blockParametrageInterval = document.getElementById("blockParametrageInterval");

  if(isRadioValeurParValeurChecked()){
    blockParametrageInterval.style.display  = "none";
    blockParametrageValeurAValeur.style.display  = "block";
  } else if(isRadioIntervalChecked()){
    blockParametrageValeurAValeur.style.display  = "none";
    blockParametrageInterval.style.display  = "block";
  }
}

function ajouterElement(typeItem) {

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

  if(itemGras.checked){
    itemGras = itemGras.value;
  }

  if(itemItalique.checked){
    itemItalique = itemItalique.value;
  }

  if(itemSousligne.checked){
    itemSousligne = itemSousligne.value;
  }

  switch (itemTitre) {
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

      case "itemQuestion":
          var newTitre = document.createElement('span');
          newTitre.id = 'question';
          newTitre.style.fontSize = itemPolice;
          newTitre.style.color = itemCouleur;
          newTitre.style.fontWeight = itemGras;
          newTitre.style.fontStyle = itemItalique;
          newTitre.style.textDecoration = itemSousligne;
          newTitre.appendChild(document.createTextNode(itemValeur));
          ajouterNouvelleQuestion(itemValeur);
        break;

      case "itemReponse":
          var newTitre = document.createElement('input');
          newTitre.id = 'reponse';
          newTitre.type = 'text';
          newTitre.placeholder = "Renseigner ici votre réponse";
        break;

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

    default:
      console.log("cc");
  }

  para1.appendChild(newTitre);
}

function ajouterBlockDonneeVariable(){

  //Simulation d'une variable globale
  if( typeof idInput == 'undefined' ) { idInput = 0; }
  idInput++;

  var blockParametrageValeurAValeur = document.getElementById("blockParametrageValeurAValeur");

  var newLabelDonneeVariable = document.createElement('label');
  newLabelDonneeVariable.id = 'labelDonneeVariable';
  newLabelDonneeVariable.appendChild(document.createTextNode("Valeur : "));

  var newInputDonneeVariable = document.createElement('input');
  newInputDonneeVariable.id = 'inputDonneeVariable'+idInput;
  newInputDonneeVariable.appendChild(document.createTextNode(""));

  blockParametrageValeurAValeur.appendChild(newLabelDonneeVariable);
  blockParametrageValeurAValeur.appendChild(newInputDonneeVariable);

}

function validerEnonce(){
  var enonceCreer = document.getElementById('page_creation').innerHTML;
  var inputEnonceCreer = document.getElementById('enonceCreer');
  inputEnonceCreer.value = enonceCreer;
}

function ajouterNouveauTypeDonnee(){
  var newTypeDonnee = document.getElementById("newTypeDonnee").value;

  if(newTypeDonnee != ""){
    $.post("./ajax/ajoutTypeDonnee.ajax.php", { newTypeDonnee: newTypeDonnee }, function(data) {
      ajouterNouvelleDonneeVariable();
    });
  }
}

function ajouterNouvelleDonneeVariable(){

  if(isRadioIntervalChecked()){
    ajouterNouvelleDonneeVariableViaInterval();
  } else if(isRadioValeurParValeurChecked()){
    ajouterNouvelleDonneeVariableValeurAValeur();
  }

}

function ajouterNouvelleDonneeVariableViaInterval(){
  var borneInferieurInterval = document.getElementById("borneInferieurInterval").value;
  var borneSuperieurInterval = document.getElementById("borneSuperieurInterval").value;
  var pasInterval = document.getElementById("pasInterval").value;

  if(borneInferieurInterval != "" && borneSuperieurInterval != "" && pasInterval != ""){
    $.post("./ajax/ajoutDonneeVariableViaInterval.ajax.php", {
      borneInferieurInterval: borneInferieurInterval ,
      borneSuperieurInterval: borneSuperieurInterval ,
      pasInterval: pasInterval
    });
  }
}

function ajouterNouvelleDonneeVariableValeurAValeur(){

  var tab = document.getElementsByTagName('input');
  var liste = [];

  for(var i=0; i<tab.length; i++) {

     if ( tab[i].id.substring(0, 19) == 'inputDonneeVariable' ) {
       liste.push(document.getElementById(tab[i].id).value);
     }
  }

  if(liste.length != 0){
    $.post("./ajax/ajoutDonneeVariableValeurAValeur.ajax.php", {
      liste: liste
    });
  }

}

function recupererIdTypeDonneeAjoute(){

  var typeDonnee = document.getElementById("typeDonnee");
  typeDonnee = typeDonnee.options[typeDonnee.selectedIndex].value;

  if(typeDonnee == "0"){
    return "<?php if(isset($_SESSION['newIdTypeDonne'])){ echo $_SESSION['newIdTypeDonne']; } else { echo '0'; }?>";
  } else {
    return typeDonnee;
  }

}

function recupererLibelleTypeDonneeAjoute(){

  var newTypeDonnee = document.getElementById("newTypeDonnee").value;

  var typeDonnee = document.getElementById("typeDonnee");
  typeDonneeValue = typeDonnee.options[typeDonnee.selectedIndex].value;
  typeDonneeText = typeDonnee.options[typeDonnee.selectedIndex].text;

  if(typeDonneeValue == 0){
    return "\"" + newTypeDonnee + "\"";
  } else {
    return "\"" + typeDonneeText + "\"";
  }

}

function ajouterNouvelleQuestion(libelle){

  if(libelle != ""){
    $.post("./ajax/ajoutQuestion.ajax.php", { libelle: libelle });
  }

}
