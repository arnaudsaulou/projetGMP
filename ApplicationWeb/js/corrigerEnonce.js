function handleClickAjouterParametres(e){
  e = e || window.event;
  var src = e.target || e.srcElement;
	console.log(src.id);
}


//Ajouter un item séléctionné et paramétré à la page de création (énoncé)
function ajouterParametres(idBtn) {

	if( typeof newId == 'undefined' ) { newId = 1; } else { newId++; }

	//Récupérer les éléments de l'ihm nécessaire
	var paramSection = document.getElementById("paramSection"+idBtn);

	var newParam = document.createElement('select');
	newParam.id = "param"+newId;

	var referenceNode = document.getElementById("param"+(newId-1));
	referenceNode.parentNode.insertBefore(newParam, referenceNode.nextSibling);

	ajouterNouveauParams(newParam);

}

//Appel du fichier AJAX afin d'ajouter une nouvelle collonne de paramètre
function ajouterNouveauParams(newParam) {

			$.ajax({
        type: "POST",
        url: './ajax/ajoutPamametresCorrection.ajax.php',
        dataType: "json",
        success: function(array) {
            populateSelect(array,newParam);
        }
    });

}

function populateSelect(array, newParam){

	for (var i = 0; i < array.length; i++) {
			var option = document.createElement("option");
			option.value = array[i].idTypeDonnee;
			option.text = array[i].libelleTypeDonnee;
			newParam.appendChild(option);
	}
}
