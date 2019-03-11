var globalNumQR;
var tableauNumParams;

function init() {
  //Calcul du nombre de question de l'énoncé
  let nbLigne = document.getElementsByClassName('ligneQuestion').length;

  globalNumQR = getNumQR();

  //Création du tableau mémorisant les id des paramètres de chaque questions
  tableauNumParams = new Array(nbLigne);
  for (var i = 0; i < tableauNumParams.length; i++) {
    tableauNumParams[i] = new Array(1);
    tableauNumParams[i][0] = 0;
  }

  console.log("tableauNumParams : " + tableauNumParams);

  return tableauNumParams;
}


//Déclanché si click sur un boutton d'ajout de paramètres
function handleClickAddParams(event) {

  console.log("preinit");

  let tableauNumParams = init();

  console.log("postinit");

  //Extraction de l'id
  var idBtn = event.target.id;
  idBtn = idBtn.substr(11,1);

  //Appel de la fonction gérant l'ajout de paramètres
  ajouterParametres(idBtn, tableauNumParams);
}

//Ajouter un item séléctionné et paramétré à la page de création (énoncé)
function ajouterParametres(idBtn, tableauNumParams) {

  console.log("ajouterParametres");

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

//Appel du fichier AJAX afin d'ajouter une nouvelle collonne de paramètre
function ajouterNouveauParams(newParam) {

			$.ajax({
        type: "POST",
        data: {idEnonce : $_GET('idEnonce')},
        url: './ajax/ajoutPamametresCorrection.ajax.php',
        dataType: "json",
        success: function(array) {
            //Appel à la fonction d'ajout d'option
            populateSelect(array,newParam);
        }
    });

}

function getNumQR(callback) {

			$.ajax({
        url: './ajax/recupererNumQuestionReponse.ajax.php',
        dataType: "json",
        success: function(numQR) {
            globalNumQR = numQR;
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
    var idQuestion = document.getElementById("question"+(parseInt(globalNumQR)+parseInt(numQuestion))).id;
    idQuestion = idQuestion.substring(8,idQuestion.length);

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

    ajouterCorrection(idQuestion,nomFormule,tableauIdParams,bareme,showAlerte);

  }

}

//Appel du fichier AJAX afin d'ajouter une nouvelle correction
function ajouterCorrection(idQuestion,nomFormule,tableauIdParams,bareme,callback) {

  $.ajax({
    type: "POST",
    url: './ajax/ajouterCorrection.ajax.php',
    data : {idQuestion: idQuestion, nomFormule: nomFormule, tableauIdParams: tableauIdParams, bareme:bareme},
    dataType: "json",
    success: function(data) {
      console.log(data);
      callback(true);
    },
    error: function(data){
      console.log(data);
      callback(false);
    }
  });

}

function showAlerte(status){
  if(status){
    alert("La correction à cet énoncé à bien été enregistrée !");
    window.location.replace("../ApplicationWeb/index.php?page=7");
  } else {
    alert("Une erreur est survenue");
  }
}

function $_GET(param) {
	var vars = {};
	window.location.href.replace( location.hash, '' ).replace(
		/[?&]+([^=&]+)=?([^&]*)?/gi, // regexp
		function( m, key, value ) { // callback
			vars[key] = value !== undefined ? value : '';
		}
	);

	if ( param ) {
		return vars[param] ? vars[param] : null;
	}
	return vars;
}
