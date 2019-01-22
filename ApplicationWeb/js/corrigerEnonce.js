//Calcul du nombre de question de l'énoncé
let nbLigne = document.getElementsByClassName('ligneQuestion').length;

//Création du tableau mémorisant les id des paramètres de chaque questions
var tableauNumParams = new Array(nbLigne);
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

//Ajouter un item séléctionné et paramétré à la page de création (énoncé)
function ajouterParametres(idBtn) {

	//Récupérer les éléments de l'ihm nécessaire
	var paramSection = document.getElementById("paramSection"+idBtn);

  //Récupère le nombre de paramètres déjà existant pour cette question
  let newId = tableauNumParams[idBtn].length;

  //Création et paramétrage d'une nouvelle liste déroulante
	var newParam = document.createElement('select');
	newParam.id = "param" + idBtn + "_" + newId;

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
        url: './ajax/ajoutPamametresCorrection.ajax.php',
        dataType: "json",
        success: function(array) {
            //Appel à la fonction d'ajout d'option
            populateSelect(array,newParam);
        }
    });

}

//Permet d'ajouter des option à la liste déroulante à partir d'un tableau JSON
function populateSelect(array, newParam){

	for (var i = 0; i < array.length; i++) {

      //Création des différentes option de la liste déroulante selon le tableau
			var option = document.createElement("option");
			option.value = array[i].idTypeDonnee;
			option.text = array[i].libelleTypeDonnee;

      //Ajout des option à la liste déroulante
			newParam.appendChild(option);
	}
}
