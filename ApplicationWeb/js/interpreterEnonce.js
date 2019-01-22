function recupererTypeDonneeVariableDansEnonce(idSujet){

  //Récupérer les éléments de l'ihm nécessaire
  var tab = document.getElementsByTagName('data');
  var listeIdPure = [];
  var valeur;

  for(var i=0; i<tab.length; i++) {

    listeIdPure.push(tab[i].id.substring(2, 3));

  }

  recupererDonneeVariableViaIdSujetEtIdTypeDonne(idSujet, listeIdPure);

}

//Appel du fichier AJAX
function recupererDonneeVariableViaIdSujetEtIdTypeDonne(idSujet, listeIdTypeDonne){

  //Si le numero de sujet et le numero du type de variable n'est pa vide
  if(idSujet != "" && listeIdTypeDonne.length != 0){

    var dataGlobal;

    //Appel du fichier AJAX avec les paramètres passé grace à la méthode POST
    $.post("./ajax/recupererDonneeVariableViaIdSujetEtIdTypeDonne.ajax.php",
    {
      idSujet: idSujet,
      listeIdTypeDonne: listeIdTypeDonne
    }, function(data) {
        remplacerTagParDonneeVariableDuSujet(data);
    });

  }
}

function remplacerTagParDonneeVariableDuSujet(listeValeur){

  var tab = document.getElementsByTagName('data');

  var re = new RegExp(/(["\[\]])/g, 'g');

  listeValeur = listeValeur.replace(re, '');

  listeValeurTab = listeValeur.split(",");

  for(var i=0; i<tab.length; i++) {
    document.getElementById(tab[i].id).innerHTML = listeValeurTab[i];
  }
}
