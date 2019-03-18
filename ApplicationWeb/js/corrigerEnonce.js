var tableauNumParams;


var globalNumQR = getNumQR();

//Calcul du nombre de question de l'énoncé
var nbLigne = document.getElementsByClassName('ligneQuestion').length;

//Création du tableau mémorisant les id des paramètres de chaque questions
tableauNumParams = new Array(nbLigne);
for (var i = 0; i < tableauNumParams.length; i++) {
  tableauNumParams[i] = new Array(1);
  tableauNumParams[i][0] = 0;
}

//Déclanché si click sur un boutton d'ajout de paramètres
function handleClickAddParams(event) {

  //Extraction de l'id
  var idBtn = event.target.id;
  idBtn = idBtn.substr(11,1);

  //Appel de la fonction gérant l'ajout de paramètres
  ajouterParametres(idBtn);
}


//Déclanché si click sur un boutton de suppression de paramètres
function handleClickRemoveParams(event) {

  //Extraction de l'id
  var idBtn = event.target.id;
  idBtn = idBtn.substr(11,1);

  //Appel de la fonction gérant l'ajout de paramètres
  supprimerParametres(idBtn);
}

//Ajouter un paramètre de calcul de solution
function ajouterParametres(idBtn) {

  //Récupère le nombre de paramètres déjà existant pour cette question
  let newId = tableauNumParams[idBtn].length;

  //Création et paramétrage d'une nouvelle liste déroulante
	var newParam = document.createElement('select');
	newParam.id = "param" + idBtn + "_" + newId;
  newParam.classList.add("paramSection"+idBtn);

  //Ajout de la nouvelle liste déroulante
	var referenceNode = document.getElementById("param" + idBtn + "_" + (newId-1));
	referenceNode.parentNode.insertBefore(newParam, referenceNode.nextSibling);

  //Appel de la fonction d'appel ajax
	ajouterNouveauParams(newParam);

  //Ajout de l'id ajouter au tableau des id
  tableauNumParams[idBtn].push(newId);
}

//Supprimer un paramètre de calcul de solution
function supprimerParametres(idBtn) {

  //Récupère le nombre de paramètres déjà existant pour cette question
  let newId = tableauNumParams[idBtn].length;

  if(newId > 1){
    //Ajout de la nouvelle liste déroulante
  	var lastParam = document.getElementById("param" + idBtn + "_" + (newId-1));
    lastParam.parentElement.removeChild(lastParam);

    //Ajout de l'id ajouter au tableau des id
    tableauNumParams[idBtn].pop(newId);
  }
}


//Appel du fichier AJAX afin d'ajouter une nouvelle collonne de paramètre
function ajouterNouveauParams(newParam) {

  recupererLastInsertedIdEnonce(function(idEnonce){
    $.ajax({
      type: "POST",
      data: {idEnonce : idEnonce},
      url: './ajax/ajoutPamametresCorrection.ajax.php',
      dataType: "json",
      success: function(array) {
          console.log('array : ' +  array);
          //Appel à la fonction d'ajout d'option
          populateSelect(array,newParam);
      },
      error: function(data){
        console.log('data : ' +  data);
      }
    });
  })

}


function recupererLastInsertedIdEnonce(callback){

    $.ajax({
      type: "POST",
      url: './ajax/recupererLastInsertIdEnonce.ajax.php',
      dataType: "json",
      success: function(lastInsertIdEnonce) {
        callback(lastInsertIdEnonce);
      },
      error: function(data){
        console.log(data);
      }
    });

  }

function getNumQR(callback) {

			$.ajax({
        url: './ajax/recupererNumQuestionReponse.ajax.php',
        dataType: "json",
        success: function(numQR) {
            globalNumQR = numQR - 1;
        }
    });

}

//Permet d'ajouter des option à la liste déroulante à partir d'un tableau JSON
function populateSelect(array, newParam){

	for (var i = 0; i < array.length; i++) {

      //Création des différentes option de la liste déroulante selon le tableau
			var option = document.createElement("option");
			option.value = array[i].idType;
			option.text = array[i].libelle;

      //Ajout des option à la liste déroulante
			newParam.appendChild(option);
	}
}

//Appeler pour enregistrer les élémennts de correction de l'énoncé
function validerCorrection(){

  //Pour chaque question de l'énoncé
  for (var numQuestion = 0; numQuestion < nbLigne; numQuestion++) {

    //Récupérer le numero de question
    idQuestion = parseInt(globalNumQR) + parseInt(numQuestion) + 1;

    //Récupérer le nom de la fonction de correction
    var nomFormule = document.getElementById("formuleCorrection"+numQuestion);
    nomFormule = nomFormule.options[nomFormule.selectedIndex].value;

    //Récupérer les paramètres à passer à la fonction de correction
    var tableauIdParams = Array();
    var listeElementsParams = document.getElementsByClassName('paramSection'+numQuestion);

    //Pour chaque paramètres
    for (var i = 0; i < listeElementsParams.length; i++) {
      //Récupérer l'id de la donnée variable à utiliser
      var idDonneVariableParamsTemp = document.getElementById(listeElementsParams[i].id);
      idDonneVariableParamsTemp = idDonneVariableParamsTemp.options[idDonneVariableParamsTemp.selectedIndex].value;

      //Ajouter cette id au tableau des paramètres de correction de la question
      tableauIdParams.push(idDonneVariableParamsTemp);
    }

    //Récupérer du bareme de la question
    var bareme = document.getElementById("bareme"+numQuestion).value;

    ajouterCorrection(idQuestion,nomFormule,tableauIdParams,bareme);

  }

  showAlerte();
}

//Appel du fichier AJAX afin d'ajouter une nouvelle correction
function ajouterCorrection(idQuestion,nomFormule,tableauIdParams,bareme) {

  $.ajax({
    type: "POST",
    url: './ajax/ajouterCorrection.ajax.php',
    data : {idQuestion: idQuestion, nomFormule: nomFormule, tableauIdParams: tableauIdParams, bareme:bareme},
    dataType: "json"
  });

}

function showAlerte(){
    alert("La correction à cet énoncé à bien été enregistrée !");
    window.location.replace("../ApplicationWeb/index.php?page=7");
}
