<?php
if(!isset($_SESSION)){
  session_start();
}
?>

let fontWeight = ["normal" , "bold"];
let fontStyle = ["normal" , "italic"];
let textDecoration = ["none" , "underline"];
let fontSize = ["60%", "80%", "100%", "150%", "200%", "300%", "400%", "500%"];

let isBoldSelected = false;
let isItalicSelected = false;
let isUnderlineSelected = false;
let policeSize = 3;

//Attendre que le document soit completement chargé
$(document).ready(function() {

  //Récupérer les éléments de l'ihm nécessaire
  let blockParametrageText = document.getElementById("blockParametrageText");
  let blockParametrageDonneeVariable = document.getElementById("blockParametrageDonneeVariable");
  let blockParametrageImage = document.getElementById("blockParametrageImage");
  let boutonAjouterDonneeVariable = document.getElementById("boutonAjouterDonneeVariable");
  let boutonAjouter = document.getElementById("boutonAjouter");
  let boldButton = document.getElementById("boldButton");
  let italicButton = document.getElementById("italicButton");
  let underlineButton = document.getElementById("underlineButton");
  let policeUpButton = document.getElementById("policeUpButton");
  let policeDownButton = document.getElementById("policeDownButton");

  //Stocker le type d'item en cours de création
  let itemEnCoursDeCration = document.getElementById("itemTitre");

  //chargement de la zone par défaut
  document.getElementById("itemTitre").classList.add("active");
  blockParametrageDonneeVariable.style.display  = "none";
  blockParametrageImage.style.display  = "none";
  blockParametrageText.style.display  = "block";

  //Gestion si click sur un item du menu de menu de droite
  $('.item').click(function(event){



    itemEnCoursDeCration = event.target;

    //affichage dans le menu de droite d'un backgroundgris sur l'option
    resetMenuSelectedItem();
    event.target.classList.add("active");

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

      //Déterminer quel block de paramétrage de donnée letiable afficher
      typeDonnerClick();

    }

    //Si l'item nécessite le block de paramétrage "Image"
    if(event.target.getAttribute("id") == "itemImage"){
      blockParametrageText.style.display  = "none";
      blockParametrageDonneeVariable.style.display  = "none";
      blockParametrageImage.style.display  = "block";
    }
  });

  //Au clique sur le bouton, ajouter l'item à la zone de création
  boutonAjouter.onclick = function() {
    console.log(itemEnCoursDeCration)
    ajouterElement(itemEnCoursDeCration);
  };

  //Au clique sur le bouton, ajouter l'item block de donnée letiable
  boutonAjouterDonneeVariable.onclick = function() { ajouterBlockDonneeVariable(); };

  //Toggle fontWeight
  boldButton.onclick = function(){
    isBoldSelected = !isBoldSelected;

    if(isBoldSelected){
      this.classList.remove("btn-light");
      this.classList.add("btn-secondary");
    } else {
      this.classList.remove("btn-secondary");
      this.classList.add("btn-light");
    }
  };

  //Toggle fontStyle
  italicButton.onclick = function(){
    isItalicSelected = !isItalicSelected;

    if(isItalicSelected){
      this.classList.remove("btn-light");
      this.classList.add("btn-secondary");
    } else {
      this.classList.remove("btn-secondary");
      this.classList.add("btn-light");
    }
  };

  //Text Decoration
  underlineButton.onclick = function(){
    isUnderlineSelected = !isUnderlineSelected;

    if(isUnderlineSelected){
      this.classList.remove("btn-light");
      this.classList.add("btn-secondary");
    } else {
      this.classList.remove("btn-secondary");
      this.classList.add("btn-light");
    }
  };

  policeUpButton.onclick = function(){
    if(policeSize < fontSize.length)
      policeSize++;
    console.log(policeSize);
  };

  policeDownButton.onclick = function(){
    if(policeSize > 0)
      policeSize--;
    console.log(policeSize);
  };

  $('#buttonFakeInputFile').bind("click" , function () {
        $('#html_btn').click();
    });

});


function resetMenuSelectedItem(){
  document.getElementById("itemTitre").classList.remove("active");
  document.getElementById("itemZoneTexte").classList.remove("active");
  document.getElementById("itemDonneeVariable").classList.remove("active");
  document.getElementById("itemQuestion").classList.remove("active");
  document.getElementById("itemImage").classList.remove("active")
}

//Renvoie TRUE si le bouton radio "Valeur a valeur" est coché
function isRadioValeurParValeurChecked(){
  return document.getElementById("itemTypeDonneeValeurAValeur").checked;
}

//Renvoie TRUE si le bouton radio "Interval" est coché
function isRadioIntervalChecked(){
  return document.getElementById("itemTypeDonneeInterval").checked;
}

//Change le block de paramétrage en fonction du type de donnée séléctionné
function typeDonnerClick() {

  //Récupérer les éléments de l'ihm nécessaire
  let blockParametrageValeurAValeur = document.getElementById("blockParametrageValeurAValeur");
  let blockParametrageInterval = document.getElementById("blockParametrageInterval");

  //Comportement à appliquer
  if(isRadioValeurParValeurChecked()){
    blockParametrageInterval.style.display  = "none";
    blockParametrageValeurAValeur.style.display  = "block";
    boutonAjouterDonneeVariable.style.display = "block"
  } else if(isRadioIntervalChecked()){
    blockParametrageValeurAValeur.style.display  = "none";
    blockParametrageInterval.style.display  = "block";
    boutonAjouterDonneeVariable.style.display = "none"
  }
}

//Ajouter un item séléctionné et paramétré à la page de création (énoncé)
function ajouterElement(typeItem) {

  //Récupérer les éléments de l'ihm nécessaire
  let para1 = document.getElementById("page_creation");
  let itemTitre = typeItem.getAttribute("id");
  let itemValeur = document.getElementById("itemValeur").value;
  let itemCouleur = document.getElementById("frenchColor").value;
  let itemSource = document.getElementById("html_btn");
  let itemDescription = document.getElementById("itemDescription");
  let itemLargeur = document.getElementById("itemLargeur");
  let itemHauteur = document.getElementById("itemHauteur");

  //Différent comportement à appliquer en fonction du type d'item à ajouter
  switch (itemTitre) {

    //Si l'item à ajouter est un "Titre"
    case "itemTitre":
      let newTitre = document.createElement('h1');
      newTitre.id = 'titre';
      newTitre.style.fontSize = fontSize[policeSize];
      newTitre.style.color = itemCouleur;
      newTitre.style.fontWeight = fontWeight[isBoldSelected ? 1 : 0];
      newTitre.style.fontStyle = fontStyle[isItalicSelected ? 1 : 0];
      newTitre.style.textDecoration = textDecoration[isUnderlineSelected ? 1 : 0];
      newTitre.appendChild(document.createTextNode(itemValeur));
    break;

    //Si l'item à ajouter est une "Zone de texte"
    case "itemZoneTexte":
      let newTitre = document.createElement('p');
      newTitre.id = 'zonedetext';
      newTitre.style.fontSize = fontSize[policeSize];
      newTitre.style.color = itemCouleur;
      newTitre.style.fontWeight = fontWeight[isBoldSelected ? 1 : 0];
      newTitre.style.fontStyle = fontStyle[isItalicSelected ? 1 : 0];
      newTitre.style.textDecoration = textDecoration[isUnderlineSelected ? 1 : 0];
      newTitre.style.display = "inline";
      newTitre.appendChild(document.createTextNode(itemValeur));
    break;

    //Si l'item à ajouter est une "Donnée Variable"
    case "itemDonneeVariable":
      let newTitre = document.createElement('p');
      newTitre.id = '##' + recupererIdTypeDonneeAjoute() + '##';
      newTitre.style.fontSize = fontSize[policeSize];
      newTitre.style.color = itemCouleur;
      newTitre.style.fontWeight = fontWeight[isBoldSelected ? 1 : 0];
      newTitre.style.fontStyle = fontStyle[isItalicSelected ? 1 : 0];
      newTitre.style.textDecoration = textDecoration[isUnderlineSelected ? 1 : 0];
      newTitre.style.display = "inline";
      newTitre.appendChild(document.createTextNode(recupererLibelleTypeDonneeAjoute()));
    break;

    //Si l'item à ajouter est une "Question"
    case "itemQuestion":
      let numQR = recupererNumQuestionReponse();

      let newTitre = document.createElement('div');

      let question = document.createElement('span');
      question.id = 'question_' + numQR;
      question.style.fontSize = fontSize[policeSize];
      question.style.color = itemCouleur;
      question.style.fontWeight = fontWeight[isBoldSelected ? 1 : 0];
      question.style.fontStyle = fontStyle[isItalicSelected ? 1 : 0];
      question.style.textDecoration = textDecoration[isUnderlineSelected ? 1 : 0];
      question.style.display = "inline";
      question.appendChild(document.createTextNode(itemValeur));

      //Appel de la fonction ajoutant la question à la base de donnée
      ajouterNouvelleQuestion(itemValeur);

      //Ajout d'un champ réponse associé
      let reponse = document.createElement('input');
      reponse.id = 'reponse_' + numQR;
      reponse.type = 'text';
      reponse.placeholder = "Renseigner ici votre réponse";
      reponse.style.display = "inline";

      newTitre.appendChild(question);
      newTitre.appendChild(reponse);
    break;

    //Si l'item à ajouter est une "Image"
    case "itemImage":
      let newTitre = document.createElement('img');
      newTitre.id = 'image';
      newTitre.alt = itemDescription.value;

      //Attendre que l'immage soit chargée pour l'afficher
      let reader = new FileReader();
      reader.addEventListener('load', function () {
        newTitre.src = reader.result;

        if(!empty(itemLargeur.value))
          newTitre.width = itemLargeur.value;

        if(!empty(itemHauteur.value))
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

  //Simulation d'une letiable globale
  if( typeof idInput == 'undefined' ) { idInput = 0; }
  idInput++;

  //Récupérer les éléments de l'ihm nécessaire
<<<<<<< HEAD
  let blockParametrageValeurAValeur = document.getElementById("blockParametrageValeurAValeur");
  let newDivDonneeVariable = document.createElement('div');
  let newLabelDonneeVariable = document.createElement('label');
  let newInputDonneeVariable = document.createElement('input');
=======
  let blockParametrageValeurAValeur = document.getElementById("blockParametrageValeurAValeur");
  let newLabelDonneeVariable = document.createElement('label');
  let newInputDonneeVariable = document.createElement('input');
>>>>>>> 1fbd7d880a520d7c055dd16f53f0383977199485

  newDivDonneeVariable.classList.add("form-group");

  //Ajout d'un label
  newLabelDonneeVariable.id = 'labelDonneeVariable';
  newLabelDonneeVariable.appendChild(document.createTextNode("Valeur : "));

  //Ajout de l'input
  newInputDonneeVariable.id = 'inputDonneeVariable'+idInput;
  //newInputDonneeVariable.appendChild(document.createTextNode(""));
  newInputDonneeVariable.classList.add("form-control");


  //Ajout des éléments au block de paramétrage des items
  newDivDonneeVariable.appendChild(newLabelDonneeVariable);
  newDivDonneeVariable.appendChild(newInputDonneeVariable);
  blockParametrageValeurAValeur.appendChild(newDivDonneeVariable);

}

//Récupère le code HTML de la page de création et l'insère comme valeur de champ "hidden pour la méthode POST
function validerEnonce(){
  let enonceCreer = document.getElementById('page_creation').innerHTML;
  let inputEnonceCreer = document.getElementById('enonceCreer');
  inputEnonceCreer.value = enonceCreer;
}

//Appel du fichier AJAX afin d'ajouter un nouveau type de donnée dans la base
function ajouterNouveauTypeDonnee(){

  //Récupérer les éléments de l'ihm nécessaire
  let newTypeDonnee = document.getElementById("newTypeDonnee").value;

  //Si le libellé donné pour le type de donnée n'est pas vide
  if(newTypeDonnee != ""){
<<<<<<< HEAD
    // $.post("./ajax/ajoutTypeDonnee.ajax.php", { newTypeDonnee: newTypeDonnee }, function(data) {
    //   //Appel de la fonction d'ajout des donnée variables associé
    //   ajouterNouvelleDonneeVariable();
    //   refreshSelectTypeDonnee(data);
    // });

    $.ajax({
      type: "POST",
      url: './ajax/ajoutTypeDonnee.ajax.php',
      data : { newTypeDonnee: newTypeDonnee },
      success: function() {
        //Appel de la fonction d'ajout des donnée variables associé
        ajouterNouvelleDonneeVariable();
        refreshSelectTypeDonnee(newTypeDonnee);
      }
  });
=======
    $.post("./ajax/ajoutTypeDonnee.ajax.php", { newTypeDonnee: newTypeDonnee }, function(data) {
      //Appel de la fonction d'ajout des donnée letiables associé
      ajouterNouvelleDonneeVariable();
    });
>>>>>>> 1fbd7d880a520d7c055dd16f53f0383977199485
  }
}


//Permet de mettre à jour le liste déroulante avec le nouveau type de donnée qui vient d'être ajouté
function refreshSelectTypeDonnee(newTypeDonnee){
  let selectTypeDonnee =  document.getElementById("selectTypeDonnee");

  let option = document.createElement("option");
  option.value = "<?php echo $_SESSION['newIdTypeDonne']; ?>";
  option.text = newTypeDonnee;
  selectTypeDonnee.appendChild(option);

  alert("Un nouveau type de donnée à été ajouté à la liste !");
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

//Appel du fichier AJAX afin d'ajouter les nouvelles donnée letiable associé au nouveau type de donnée via un interval
function ajouterNouvelleDonneeVariableViaInterval(){

  //Récupérer les éléments de l'ihm nécessaire
  let borneInferieurInterval = document.getElementById("borneInferieurInterval").value;
  let borneSuperieurInterval = document.getElementById("borneSuperieurInterval").value;
  let pasInterval = document.getElementById("pasInterval").value;

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

//Appel du fichier AJAX afin d'ajouter les nouvelles donnée letiable associé au nouveau type de donnée valeur après valeur
function ajouterNouvelleDonneeVariableValeurAValeur(){

  //Récupérer les éléments de l'ihm nécessaire
  let tab = document.getElementsByTagName('input');
  let liste = [];

  for(let i=0; i<tab.length; i++) {

    //Récupérer toutes les valeurs possible de la donnée letiable
    if ( tab[i].id.substring(0, 19) == 'inputDonneeVariable' ) {
      liste.push(document.getElementById(tab[i].id).value);
    }

  }

  //Si la liste des donnée letiable à ajouter n'est pas vide
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
<<<<<<< HEAD
  let typeDonnee = document.getElementById("selectTypeDonnee");
=======
  let typeDonnee = document.getElementById("typeDonnee");
>>>>>>> 1fbd7d880a520d7c055dd16f53f0383977199485

  //Récupérer la valeur de l'item séléctionné dans la liste déroulante
  typeDonnee = typeDonnee.options[typeDonnee.selectedIndex].value;

  //Si l'item séléctionné dans la liste est le 1er ("Créer un nouveau type")
  if(typeDonnee == "0"){
    //Retourner le dernier idType inséré dans la table TypeDonnee de la base de donnée (via la letiable de session venant du TypeDonneeManager)
    return "<?php if(isset($_SESSION['newIdTypeDonne'])){ echo $_SESSION['newIdTypeDonne']; } else { echo '0'; }?>";
  } else {
    //Retourner l'id du type séléctionné dans la liste déroulante
    return typeDonnee;
  }

}


//Retourne le libellé du type de donnée séléctionné
function recupererLibelleTypeDonneeAjoute(){

  //Récupérer les éléments de l'ihm nécessaire
  let typeDonnee = document.getElementById("typeDonnee");
  let newTypeDonnee = document.getElementById("newTypeDonnee").value;

  //Récupérer le libellé du type de donnée séléctionné / inséré
  typeDonneeValue = typeDonnee.options[typeDonnee.selectedIndex].value;
  typeDonneeText = typeDonnee.options[typeDonnee.selectedIndex].text;

  //Si le typeDonneeValue est "Créer un nouveau type de donnée"
  if(typeDonneeValue == 0){
    //Retourne le nouveau type de donné saisi
    return newTypeDonnee;
  } else {
    //Retourne le nouveau type de donné séléctionné
    return typeDonneeText;
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

  //Simulation d'une letiable globale
  if( typeof numQR == 'undefined' ) { numQR = 0; } else { numQR++; }

  return numQR;
}
