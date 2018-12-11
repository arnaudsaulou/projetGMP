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

      var url = './ajax/creerEnonce_ajoutTypeDonnee.ajax.php';
      $.post(url, function(data){ });
    };

    //Au clique sur le boutton, ajouter l'item à la zone de création
    bouttonAjouterDonneeVariable.onclick = function() { ajouterBlockDonneeVariable(); };

});

function typeDonnerClick() {
  var radioValaurParValeur =  document.getElementById("itemTypeDonneeValeurAValeur");
  var radioInterval =  document.getElementById("itemTypeDonneeInterval");

  var blockParametrageValeurAValeur = document.getElementById("blockParametrageValeurAValeur");
  var blockParametrageInterval = document.getElementById("blockParametrageInterval");

  if(radioValaurParValeur.checked){
    blockParametrageInterval.style.display  = "none";
    blockParametrageValeurAValeur.style.display  = "block";
  } else if(radioInterval.checked){
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
          newTitre.id = 'donneeVariable';
          newTitre.style.fontSize = itemPolice;
          newTitre.style.color = itemCouleur;
          newTitre.style.fontWeight = itemGras;
          newTitre.style.fontStyle = itemItalique;
          newTitre.style.textDecoration = itemSousligne;
          newTitre.appendChild(document.createTextNode('##1'));
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

  //On insère notre nouveau paragraphe juste avant
  para1.appendChild(newTitre);
}

function ajouterBlockDonneeVariable(){
  var blockParametrageValeurAValeur = document.getElementById("blockParametrageValeurAValeur");

  var newLabelDonneeVariable = document.createElement('label');
  newLabelDonneeVariable.id = 'labelDonneeVariable';
  newLabelDonneeVariable.appendChild(document.createTextNode("Valeur : "));

  var newInputDonneeVariable = document.createElement('input');
  newInputDonneeVariable.id = 'inputDonneeVariable';
  newInputDonneeVariable.appendChild(document.createTextNode(""));

  blockParametrageValeurAValeur.appendChild(newLabelDonneeVariable);
  blockParametrageValeurAValeur.appendChild(newInputDonneeVariable);

}

function validerEnonce(){
  var enonceCreer = document.getElementById('page_creation').innerHTML;
  var inputEnonceCreer = document.getElementById('enonceCreer');
  inputEnonceCreer.value = enonceCreer;
}
