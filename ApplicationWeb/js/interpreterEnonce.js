let sujet = new Sujet();

function Sujet(){

  this.donneVariable = null;
  this.donneeCalculee = "";

  this.setDonneeVariable = function(tabDonneVariable){
    for(let i=0; i<tabDonneVariable.length; i++){
      this.donneVariable = tabDonneVariable;
    }
  }

  this.setDonneeCalcule = function(tabDonneeCalculee){
    for(let i=0; i<tabDonneeCalculee.length; i++){
      this.donneeCalculee = tabDonneeCalculee;
    }
  }

  this.getDonneeVariable = function(indexDonneeVariable){
    return this.donneVariable[indexDonneeVariable];
  }

  this.getDonneeCalculee = function(indexDonneeCalculee){
    return this.donneeCalculee[indexDonneeCalculee];
  }

}

function DonneeVariable(idType, valeur){

  this.idType = idType;
  this.valeur = valeur;

  this.getValeur = function(){
    return this.valeur;
  }

}

function DonneeCalculee(idType, nomFormule, tableauIdParams){

  this.idType = idType;
  this.nomFormule = nomFormule;
  this.tableauIdParams = tableauIdParams;

  this.calculer = function(id, callback){

    tableauIdParams = tableauIdParams.split(",");
    listeValeurDonneeVariable=[];

    for(let i=0; i<tableauIdParams.length; i++){
      listeValeurDonneeVariable.push(sujet.getDonneeVariable(i).getValeur());
    }


    $.ajax({
      type: "POST",
      data: {listeValeurDonneeVariable : listeValeurDonneeVariable},
      url: "./formules/calcul/"+nomFormule+".php",
      dataType: "json",
      success: function(resultat) {
        callback(id, resultat);
      }
    });
  }

  this.getNomFormule = function(){
    return this.nomFormule;
  }
}

function recupererTypeDonneeVariableDansEnonce(idSujet){

  //Récupérer les éléments de l'ihm nécessaire
  var tab = document.getElementsByTagName('data');
  var listeIdPure = [];
  var valeur;

  for(var i=0; i<tab.length; i++) {
    listeIdPure.push(tab[i].id.substring(2, 3));3
  }

  recupererDonneeVariableViaIdSujetEtIdTypeDonne(idSujet, listeIdPure);
}

//Appel du fichier AJAX
function recupererDonneeVariableViaIdSujetEtIdTypeDonne(idSujet, listeIdTypeDonne){

  //Si le numero de sujet et le numero du type de variable n'est pa vide
  if(idSujet != "" && listeIdTypeDonne.length != 0){

    var dataGlobal;

    //Appel du fichier AJAX avec les paramètres passé grace à la méthode POST
    $.ajax({
      type: "POST",
      dataType: "json",
      data: {idSujet: idSujet, listeIdTypeDonne : listeIdTypeDonne},
      url: './ajax/recupererDonneeVariableViaIdSujetEtIdTypeDonne.ajax.php',
      success: function(listeDonneeVariable) {
        remplacerTagParDonneeVariableDuSujet(listeDonneeVariable);
      }
  });

  }
}

function remplacerTagParDonneeVariableDuSujet(listeDonneVariable){

  var listeValeur = [];

  for(let i = 0; i < countProps(listeDonneVariable); i++){

    listeValeur.push(
      new DonneeVariable(
        listeDonneVariable[i].idType,
        listeDonneVariable[i].valeur
      ));
  }

  sujet.setDonneeVariable(listeValeur);

  var tab = document.getElementsByTagName('data');

  for(var i=0; i<tab.length; i++) {
    document.getElementById(tab[i].id).innerHTML = sujet.getDonneeVariable(i).getValeur();
  }

  recupererTypeDonneeCalculeDansEnonce();
}

function recupererTypeDonneeCalculeDansEnonce(){

  //Récupérer les éléments de l'ihm nécessaire
  var tab = document.getElementsByTagName('calculated_data');
  var listeIdPure = [];
  var valeur;

  for(var i=0; i<tab.length; i++) {
    listeIdPure.push(tab[i].id.substring(2, 3));3
  }

  recupererDonneeCalculeViaIdSujetEtIdTypeDonne(listeIdPure);
}


//Appel du fichier AJAX
function recupererDonneeCalculeViaIdSujetEtIdTypeDonne(listeIdTypeDonne){

  //Si le numero de sujet et le numero du type de variable n'est pa vide
  if(listeIdTypeDonne.length != 0){

    $.ajax({
      type: "POST",
      dataType: "json",
      data: {listeIdTypeDonne : listeIdTypeDonne},
      url: './ajax/recupererDonneeCalculeViaListeIdDonneeCalcule.ajax.php',
      success: function(listeDonneeCalcule) {

        var listeValeur = [];
        for(let i = 0; i < countProps(listeDonneeCalcule); i++){

          listeValeur.push(
            new DonneeCalculee(
              listeDonneeCalcule[i].idType,
              listeDonneeCalcule[i].nomFormule,
              listeDonneeCalcule[i].tableauIdParams
            ));
        }

        sujet.setDonneeCalcule(listeValeur);

        remplacerTagParDonneeCalculeeDuSujet();
      }
  });

  }
}

function remplacerTagParDonneeCalculeeDuSujet(){

  var tab = document.getElementsByTagName('calculated_data');

  for(var i=0; i<tab.length; i++) {
    sujet.getDonneeCalculee(i).calculer(tab[i].id, function(id, resultat){
      document.getElementById(id).innerHTML = resultat;
    });
  }
}

function countProps(obj) {
    var count = 0;
    for (var p in obj) {
      obj.hasOwnProperty(p) && count++;
    }
    return count;
}
