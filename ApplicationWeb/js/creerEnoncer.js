$(document).ready(function() {

    var textarea = document.getElementById("textarea");
    var bouttonAjouter = document.getElementById("bouttonAjouter");
    var itemEnCoursDeCration;

    //Gestion si click sur un item du menu de menu de droite
    $('.item').click(function(event){
            document.getElementById("titreParametrage").innerHTML = event.target.getAttribute("name");
            itemEnCoursDeCration = event.target;
        });

    //Au clique sur le boutton, ajouter l'item à la zone de création
    bouttonAjouter.onclick = function() {ajouterElement(itemEnCoursDeCration)};

});

function ajouterElement(typeItem) {

  var para1 = document.querySelector('.page_creation');

  var itemTitre = typeItem.getAttribute("id");
  var itemValeur = document.getElementById("itemValeur").value;

  switch (itemTitre) {
    case "itemTitre":
        var newTitre = document.createElement('h1');
        newTitre.id = 'titre';
        newTitre.appendChild(document.createTextNode(itemValeur));
      break;

    case "itemZoneTexte":
        var newTitre = document.createElement('p');
        newTitre.id = 'zonedetext';
        newTitre.appendChild(document.createTextNode(itemValeur));
      break;
    default:
      console.log("cc");
  }

  //On insère notre nouveau paragraphe juste avant
  para1.appendChild(newTitre);
}
