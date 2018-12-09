$(document).ready(function() {

    var blockParametrageText = document.getElementById("blockParametrageText");
    var blockParametrageDonneeVariable = document.getElementById("blockParametrageDonneeVariable");




    var bouttonAjouter = document.getElementById("bouttonAjouter");
    var itemEnCoursDeCration;

    //Gestion si click sur un item du menu de menu de droite
    $('.item').click(function(event){
            document.getElementById("titreParametrage").innerHTML = event.target.getAttribute("name");
            itemEnCoursDeCration = event.target;


            if(event.target.getAttribute("id") == "itemTitre" || event.target.getAttribute("id") == "itemZoneTexte"){
              blockParametrageDonneeVariable.style.display  = "none";
              blockParametrageText.style.display  = "block";
            }

            if(event.target.getAttribute("id") == "itemDonneeVariable"){
              blockParametrageText.style.display  = "none";
              blockParametrageDonneeVariable.style.display  = "block";

              typeDonnerClick();

            }
        });

    //Au clique sur le boutton, ajouter l'item à la zone de création
    bouttonAjouter.onclick = function() {ajouterElement(itemEnCoursDeCration)};

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

    default:
      console.log("cc");
  }

  //On insère notre nouveau paragraphe juste avant
  para1.appendChild(newTitre);
}
